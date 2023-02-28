<?php

use Bitrix\Main\SystemException;
use QSoft\Migration\Migration;

class AdminEditMail extends Migration
{
    private const ADMIN_EDIT_EVENT = 'ADMIN_EDIT_EVENT';

    /**
     * @return void
     * @throws SystemException
     */
    public function up(): void
    {
        $eventType = [
                'LID' => 'ru',
                'EVENT_NAME' => self::ADMIN_EDIT_EVENT,
                'NAME' => 'Изменения в профиле',
                // Предотвращаем пробелы в инпуте в начале строк
                'DESCRIPTION' => '
#MESSAGE_TEXT# - текст письма
#MESSAGE_TAKER# - почта получателя
#OWNER_NAME# - ФИО клиента',
        ];

        $eventTypeObject = new \CEventType;
        $res = $eventTypeObject->Add($eventType); 

        if(!$res){
            throw new SystemException($eventTypeObject->LAST_ERROR);
        }

        $eventMailTemplate = [
            'ACTIVE'=> 'Y',
            'EVENT_NAME' => self::ADMIN_EDIT_EVENT,
            'LID' => SITE_ID,
            'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
            'EMAIL_TO' => '#MESSAGE_TAKER#',
            'SUBJECT' => 'Изменения в профиле',
            'BODY_TYPE' => 'html',
            'MESSAGE' => '
                <!doctype html>
                <html lang="ru">
                    <head>
                        <meta charset="utf-8">
                        <title>Изменения в профиле</title>
                    </head>
                    <body>
                        <h2>Здравствуйте, #OWNER_NAME#.</h2>
                        <p>
                             #MESSAGE_TEXT#.
                        </p>
                        <p>
                             С уважением, служба техподдержки #SITE_NAME#.
                        </p>
                        <p>
                             Письмо сформировано автоматически.
                        </p>
                    </body>
                </html>',
        ];

        $eventMessageObject = new CEventMessage;
        $dbRes = $eventMessageObject->Add($eventMailTemplate);
         
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
    public function down(): void
    {
        $eventMessageObject = new CEventMessage();

        $evenMessage = $eventMessageObject->GetList([], [], ['EVENT_NAME' => self::ADMIN_EDIT_EVENT]);

        if(!$evenMessage){
            throw new SystemException($eventMessageObject->LAST_ERROR);
        } else {
            while ($mes = $evenMessage->GetNext()) {
                $eventMessageObject->Delete($mes['ID']);
            }
        }

        $eventTypeObject = new CEventType();

        // Не стандартный getList
        $evenTypeName = $eventTypeObject->GetList(['EVENT_NAME' => self::ADMIN_EDIT_EVENT])->GetNext();

        if(!$evenTypeName){
            throw new SystemException($eventTypeObject->LAST_ERROR);
        } else {
            $eventTypeObject->Delete($evenTypeName);
        }
    }
}
