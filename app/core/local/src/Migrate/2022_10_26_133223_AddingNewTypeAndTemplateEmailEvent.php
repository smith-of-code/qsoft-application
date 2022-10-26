<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 07.08.15
 * Time: 19:41
 */

use Bitrix\Main\SystemException;
use QSoft\Migration\Migration;

class AddingNewTypeAndTemplateEmailEvent extends Migration
{
    private const TICKET_CREATION_EVENT = 'TICKET_CREATION_EVENT';
    private const TICKET_NEW_FOR_TECHSUPPORT = 'TICKET_NEW_FOR_TECHSUPPORT';

    /**
     * @return void
     * @throws SystemException
     */
    public function up(): void
    {
        $eventType = [
                'LID' => SITE_ID,
                'EVENT_NAME' => self::TICKET_CREATION_EVENT,
                'NAME' => 'Отправка данных о заказе',
                // Предотвращаем пробелы в инпуте в начале строк
                'DESCRIPTION' => '
#TIME_SEND# - дата отправки
#MESSAGE_SENDER# - почта поддержки
#MESSAGE_TAKER# - почта получателя
#TICKET_STATUS# - Статус обращения Принято/Отклонено
#TICKET_CATEGORY# - Категория обращения в родительном падеже
#TICKET_NUMBER# - номер обращения
#OWNER_NAME# - ФИО клиента
#RESPONSIBLE_NAME# - имя сотрудника техподдержки',
        ];

        $eventTypeObject = new \CEventType;
        $res = $eventTypeObject->Add($eventType); 

        if(!$res){
            throw new SystemException($eventTypeObject->LAST_ERROR);
        }

        $eventMailTemplae = [
            'ACTIVE'=> 'Y',
            'EVENT_NAME' => self::TICKET_CREATION_EVENT,
            'LID' => SITE_ID,
            'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
            'EMAIL_TO' => '#DEFAULT_EMAIL_FROM#',
            'SUBJECT' => 'Статус вашей заявки.',
            'BODY_TYPE' => 'html',
            'MESSAGE' => '
                <!doctype html>
                <html lang="ru">
                    <head>
                        <meta charset="utf-8">
                        <title>Создана заявка</title>
                    </head>
                    <body>
                        <p>
                            Создана новая заявка на #TICKET_CATEGORY# № #TICKET_NUMBER#
                        </p>
                    </body>
                </html>',
        ];

        $eventMessageObject = new CEventMessage;
        $dbRes = $eventMessageObject->Add($eventMailTemplae);
         
        if(!$dbRes){
            throw new SystemException($eventMessageObject->LAST_ERROR);
        }

        $id = $this->getMessageTemplateId(self::TICKET_CREATION_EVENT);

        $eventMessageObject->Update($id, ['ACTIVE' => 'N']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * @throws SystemException
     */
    public function down(): void
    {
        $eventMessageObject = new CEventMessage();

        $id = $this->getMessageTemplateId(self::TICKET_CREATION_EVENT);

        if(!$id){
            throw new SystemException($eventMessageObject->LAST_ERROR);
        } else {
            $eventMessageObject->Delete($id);
        }

        $eventTypeObject = new CEventType();

        // Не стандартный getList
        $evenTypeName = $eventTypeObject->GetList(['EVENT_NAME' => self::TICKET_CREATION_EVENT])->GetNext();

        if(!$evenTypeName){
            throw new SystemException($eventTypeObject->LAST_ERROR);
        } else {
            $eventTypeObject->Delete($$evenTypeName);
            $id = $this->getMessageTemplateId(self::TICKET_CREATION_EVENT);
    
            $eventMessageObject->Update($id, ['ACTIVE' => 'Y']);
        }
    }

    private function getMessageTemplateId(string $eventName)
    {
        $eventMessageObject = new CEventMessage();

        $evenMessage 
            = $eventMessageObject->GetList([], [], ['EVENT_NAME' => $eventName])->GetNext();

        return $evenMessage['ID'];
    }
}
