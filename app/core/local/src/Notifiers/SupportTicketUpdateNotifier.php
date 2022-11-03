<?php

namespace QSoft\Notifiers;

class SupportTicketUpdateNotifier extends NotificationContent
{
    private string $categorySid;
    private string $acceptRequest;

    public function __construct(array $ticket)
    {
        parent::__construct();
        $this->categorySid = $ticket['CATEGORY_SID'];
        $this->acceptRequest = \CUserFieldEnum::GetList([],['ID'=> $ticket['UF_ACCEPT_REQUEST']])->Fetch()['XML_ID'];
    }

    public function getTitle(): string
    {
        return $this->notificationContent['title'];
    }

    public function getMessage(): string
    {
        return $this->notificationContent[$this->acceptRequest][$this->categorySid]['message'];
    }


    public function getLink(): string
    {
        //TODO Реализовать метод согласно ссылкам в файле config/notification_content.php
        return '';
    }

    protected function getNotificationType(): string
    {
        return 'UPDATE_SUPPORT_TICKET';
    }
}