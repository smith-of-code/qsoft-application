<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 07.08.15
 * Time: 19:41
 */

use Bitrix\Main\SystemException;
use QSoft\Migration\Migration;

class newMailMessageTemplate extends Migration {

    private const TICKET_ACCEPTION_EVENT = 'TICKET_ACCEPTION_EVENT';

    /**
     * @return void
     * @throws SystemException
     */
    public function up(): void
    {
        $eventType = [
                'LID' => SITE_ID,
                'EVENT_NAME' => self::TICKET_ACCEPTION_EVENT,
                'NAME' => 'Отправка данных о заказе',
                // Предотвращаем пробелы в инпуте в начале строк
                'DESCRIPTION' => '
#TIME_SEND# - дата отправки
#MESSAGE_SENDER# - почта поддержки
#MESSAGE_TAKER# - почта получателя
#TICKED_STATUS# - Статус обращения Принято/Отклонено
#TICKED_NUMBER# - номер обращения
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
            'EVENT_NAME' => self::TICKET_ACCEPTION_EVENT,
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
                        <title>Статус вашей заявки.</title>
                    </head>
                    <body>
                        <p>
                            Ваша заявка № #TICKET_NUMBER# на #TICKET_TYPE# #TICKET_STATUS#.
                            За подробной информацией обращайтесь в техподдержку.
                        </p>
                    </body>
                </html>',
        ];

        $eventMessageObject = new CEventMessage;
        $dbRes = $eventMessageObject->Add($eventMailTemplae);
         
        if(!$dbRes){
            throw new SystemException($eventMessageObject->LAST_ERROR);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * @throws SystemException
     */
    public function down()
    {
        $eventMessageObject = new CEventMessage();

        $evenMessage = $eventMessageObject->GetList([], [], ['EVENT_NAME' => self::TICKET_ACCEPTION_EVENT]);

        if(!$evenMessage){
            throw new SystemException($eventMessageObject->LAST_ERROR);
        } else {
            while ($mes = $evenMessage->GetNext()) {
                $eventMessageObject->Delete($mes['ID']);
            }
        }

        $eventTypeObject = new CEventType();

        // Не стандартный getList
        $evenTypeName = $eventTypeObject->GetList(['EVENT_NAME' => self::TICKET_ACCEPTION_EVENT])->GetNext();

        if(!$evenTypeName){
            throw new SystemException($eventTypeObject->LAST_ERROR);
        } else {
            $eventTypeObject->Delete($$evenTypeName);
        }
    }
}
