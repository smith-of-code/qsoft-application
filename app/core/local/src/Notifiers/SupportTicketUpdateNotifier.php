<?php

namespace QSoft\Notifiers;

use Bitrix\Main\Type\Date;
use QSoft\Helper\TicketHelper;

class SupportTicketUpdateNotifier extends NotificationContent
{
    private string $categorySid;
    private string $acceptRequest;
    private array $ticket;

    public function __construct(array $ticket, $category = null)
    {
        parent::__construct();

        if (!$ticket['CATEGORY_SID']) {
            $ticket['CATEGORY_SID'] = (new TicketHelper)->getCategorySid($ticket['CATEGORY_ID']);
        }

        $this->ticket = $ticket;
        $this->categorySid = $category ?? $ticket['CATEGORY_SID'];
        $this->acceptRequest = $this->ticket['IS_NEW'] ? 'NEW' : \CUserFieldEnum::GetList([], ['ID' => $ticket['UF_ACCEPT_REQUEST']])->Fetch()['XML_ID'];
    }

    public function getTitle(): string
    {
        return $this->notificationContent[$this->acceptRequest][$this->categorySid]['title_template'] ?? $this->notificationContent['title'];
    }

    public function getMessage(): string
    {
        $date = new Date();
        $replacement = [
            '#app_id#' => $this->ticket['ID'],
            '#date#' => $date->add('3D')->format('d.m.Y'),
            '#FIO#' => $this->ticket['MENTOR']['LAST_NAME'] . ' ' . $this->ticket['MENTOR']['NAME'] . ' ' . $this->ticket['MENTOR']['SECOND_NAME'],
            '#phone#' => $this->ticket['MENTOR']['PERSONAL_PHONE'],
            '#email#' => $this->ticket['MENTOR']['EMAIL'],
            '#city#' => $this->ticket['MENTOR']['PERSONAL_CITY'],
        ];

        if ($this->categorySid == 'CHANGE_MENTOR' && empty($this->ticket['MENTOR'])) {
            return $this->notificationContent[$this->acceptRequest][$this->categorySid . '_SEARCH']['message'];
        }

        return str_replace(array_keys($replacement), array_values($replacement), $this->notificationContent[$this->acceptRequest][$this->categorySid]['message']);
    }


    public function getLink(): string
    {
        return $this->notificationContent[$this->acceptRequest][$this->categorySid]['link_template'] ?? $this->notificationContent['link'];
    }

    protected function getNotificationType(): string
    {
        return 'UPDATE_SUPPORT_TICKET';
    }
}