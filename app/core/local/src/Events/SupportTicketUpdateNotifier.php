<?php

namespace QSoft\Events;

class SupportTicketUpdateNotifier implements Notifier
{
    private string $message;
    private string $link;

    public function __construct(array $ticketValues)
    {
        $this->init($ticketValues);
    }

    private function init(array $ticketValues): void
    {
        if ($ticketValues['UF_ACCEPT_REQUEST'] == 'ACCEPTED') {
            switch ($ticketValues['CATEGORY_SID']) {
                case "CHANGE_OF_PERSONAL_DATA":
                    $this->message = "Ваша заявка на смену персональных данных была рассмотрена и одобрена. Данные изменены.";
                    $this->link = "/personal/";
                    break;
                case "REGISTRATION":
                    $this->message = "Ваша заявка на регистрацию была рассмотрена была рассмотрена и одобрена.";
                    $this->link = "";
                    break;
                case "CHANGE_ROLE":
                    $this->message = "Ваша заявка на изменение роли была рассмотрена и одобрена";
                    $this->link = "";
                    break;
                case "SUPPORT":
                    $this->message = "Ваша заявка в техподдержку была рассмотрена и одобрена";
                    $this->link = "";
                    break;
                default:
                    $this->message = " Категория заявки: " . $ticketValues['CATEGORY_NAME'] . ". Статус заявки: Принято.";
                    $this->link = "";
                    break;
            }
        } else { //== 'REJECTED'
            switch ($ticketValues['CATEGORY_SID']) {
                case "CHANGE_OF_PERSONAL_DATA":
                    $this->message = "Ваша заявка на смену персональных данных была отклонена.";
                    $this->link = "";
                    break;
                case "REGISTRATION":
                    $this->message = "Ваша заявка на регистрацию была отклонена.";
                    $this->link = "";
                    break;
                case "CHANGE_ROLE":
                    $this->message = "Ваша заявка на изменение роли была отклонена.";
                    $this->link = "";
                    break;
                case "SUPPORT":
                    $this->message = "Ваша заявка в техподдержку была отклонена.";
                    $this->link = "";
                    break;
                default:
                    $this->message = " Категория заявки: " . $ticketValues['CATEGORY_NAME'] . ". Статус заявки: Отклонено.";
                    $this->link = "";
                    break;
            }
        }
    }

    public function getTitle(): string
    {
        return "Статус заявки изменился";
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getLink(): string
    {
        return $this->link;
    }
}