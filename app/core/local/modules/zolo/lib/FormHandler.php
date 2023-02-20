<?php

namespace Bitrix\Zolo;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use QSoft\Entity\User;
use Bitrix\Report\VisualConstructor\Fields\Div;
use \CTicket;
use QSoft\Logger\Logger;
use Psr\Log\LogLevel;

class FormHandler
{
    /**
     * @param int $id
     * 
     * @return array
     */
    public function GetFormData(int $id): array
    {
        $this->initModule();

        $ticket = CTicket::GetByID($id, LANG, "Y",  "Y", "Y", ["SELECT"=>['UF_DATA']])->GetNext();

        if (!is_array(json_decode($ticket['~UF_DATA'], true))) {
            return [];
        }

        return json_decode($ticket['~UF_DATA'], true);
    }

    /**
     * @return void
     * @throws SystemException
     */
    private function initModule(): void
    {
        if (!Loader::includeModule('support')) {
            $error = new SystemException(Loc::GetMessage('SUPPORT_NOT_INCLUDED'));
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);

            throw $error;
        }

        if (!Loader::includeModule('report')) {
            $error = new SystemException(Loc::GetMessage('SUPPORT_NOT_INCLUDED'));
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);

            throw $error;
        }
    }

    /**
     * @param array $arrValues
     * 
     * @return string
     */
    public function prepareFields(array $arrValues): string
    {
        $html = new Div();
        $start = (new Div())->start()->getContent();
        $end = (new Div())->end()->getContent();
        $indent = '<br>';
        $fields = '';

        foreach ($arrValues as $key => $value) {
            if (is_array($value)) { 
                $fields 
                    .=  $indent .  $indent . $start
                    . $this->getBolderText($key) . ': '
                    . $end . $this->prepareFields($value, $key);
            } else {
                $fields .= $start . $key . ': ' . $value . $end;
            }
        }

        return $fields;
    }

    /**
     * @param array $arrValues
     * 
     * @return string
     */
    public function getOrderInfo(array $arrValues): string
    {
        $html = new Div();
        $start = (new Div())->start()->getContent();
        $end = (new Div())->end()->getContent();
        $indent = '<br>';
        $fields = $indent .  $indent . $start;

        $order = \CSaleOrder::GetByID($arrValues['ORDER_NUMBER']);
        
        $isTicketOwnerOrder = $order['USER_ID'] == $arrValues['USER_ID'];
        if ($isTicketOwnerOrder) {
            $fields .= 'Заказ пренадлежит текущему пользователю' . $end;
        } else {
            $fields .= 'Заказ не пренадлежит текущему пользователю' . $end;
        }
        $fields 
            .=  $indent .  $indent . $start
            . 'ORDER_ID' . ': '
            . $arrValues['ORDER_NUMBER'] . $end;

        foreach ($order as $key => $value) {
            if (is_array($value)) { 
                $fields 
                    .=  $indent .  $indent . $start
                    . $this->getBolderText($key) . ': '
                    . $end . $this->prepareFields($value, $key);
            } else {
                $fields .= $start . $key . ': ' . $value . $end;
            }
        }

        return $fields;
    }

    /**
     * @param array $arrValues
     * 
     * @return string
     */
    public function getMentorInfo(array $arrValues): string
    {
        $html = new Div();
        $start = (new Div())->start()->getContent();
        $end = (new Div())->end()->getContent();
        $indent = '<br>';
        $fields = '';

        $fields 
            .=  $indent .  $indent . $start
            . 'Причина смены ментора: '
            . $arrValues['COUSES'] . $end;

        $fields 
            .=  $indent .  $indent . $start
            . 'Коментарий: '
            . $arrValues['MESSAGE'] ?? 'Отсутствует' . $end;

        $user = new User($arrValues['USER_ID']);

        $oldMentor = $user->getMentor();

        if (!$oldMentor) {
            $fields 
                .=  $indent .  $indent . $start
                . 'Ментор: отсутствует' . $end;
        } else {
            $fields 
                .=  $indent .  $indent . $start
                . 'Ментор: ' . $oldMentor->id . $end;
            $oldMentorData = $oldMentor->getPersonalData();
        
            foreach ($oldMentorData as $key => $value) {
                if (is_array($value)) { 
                    $fields 
                        .=  $indent .  $indent . $start
                        . $this->getBolderText($key) . ': '
                        . $end . $this->prepareFields($value, $key);
                } else {
                    $fields .= $start . $key . ': ' . $value . $end;
                }
            }
        }

        $isUserExist = !empty((new \CUser())->GetByID($arrValues['NEW_MENTOR_ID'])->Fetch());

        $newMentor = $isUserExist ? new User($arrValues['NEW_MENTOR_ID']) : null;

        if (!$newMentor) {
            $fields 
                .=  $indent .  $indent . $start
                . 'Новый ментор: не найден, неправильно указан id' . $end;
        } else {
            $fields 
            .=  $indent .  $indent . $start
            . 'Ментор: ' . $newMentor->id . $end;
            $newMentorData = $newMentor->getPersonalData();
        
            foreach ($newMentorData as $key => $value) {
                if (is_array($value)) { 
                    $fields 
                        .=  $indent .  $indent . $start
                        . $this->getBolderText($key) . ': '
                        . $end . $this->prepareFields($value, $key);
                } else {
                    $fields .= $start . $key . ': ' . $value . $end;
                }
            }
        }
        
        $isTicketOwnerOrder = $order['USER_ID'] == $arrValues['USER_ID'];

        return $fields;
    }

    /**
     * @param mixed $content
     * 
     * @return string
     */
    private function getBolderText($content): string
    {
        return '<b>' . $content . '</b>';
    }
}
