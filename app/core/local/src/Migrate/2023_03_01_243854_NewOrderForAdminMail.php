<?php

use Bitrix\Main\SystemException;
use QSoft\Migration\Migration;

class NewOrderForAdminMail extends Migration
{
    private const EVENT_NAME = 'NEW_ORDER_FOR_ADMIN';

    /**
     * @return void
     * @throws SystemException
     */
    public function up(): void
    {
        $eventType = [
                'LID' => 'ru',
                'EVENT_NAME' => self::EVENT_NAME,
                'NAME' => 'На сайте размещен новый заказ',
                // Предотвращаем пробелы в инпуте в начале строк
                'DESCRIPTION' => '
#ORDER_ID# - ID заказа',
        ];

        $eventTypeObject = new \CEventType;
        $res = $eventTypeObject->Add($eventType); 

        if(!$res){
            throw new SystemException($eventTypeObject->LAST_ERROR);
        }

        $eventMailTemplate = [
            'ACTIVE'=> 'Y',
            'EVENT_NAME' => self::EVENT_NAME,
            'LID' => SITE_ID,
            'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
            'EMAIL_TO' => '#DEFAULT_EMAIL_FROM#',
            'SUBJECT' => 'На сайте размещен новый заказ',
            'BODY_TYPE' => 'html',
            'MESSAGE' => '
                <!doctype html>
                <html lang="ru">
                    <head>
                        <meta charset="utf-8">
                        <title>На сайте размещен новый заказ</title>
                    </head>
                    <body>
                        <h2>Здравствуйте.</h2>
                        <p>
                             На сайте размещен новый заказ: <a href="https://#SERVER_NAME#/bitrix/admin/sale_order_view.php?ID=#ORDER_ID#">#ORDER_ID#</a>
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

        $evenMessage = $eventMessageObject->GetList([], [], ['EVENT_NAME' => self::EVENT_NAME]);

        if(!$evenMessage){
            throw new SystemException($eventMessageObject->LAST_ERROR);
        } else {
            while ($mes = $evenMessage->GetNext()) {
                $eventMessageObject->Delete($mes['ID']);
            }
        }

        $eventTypeObject = new CEventType();

        // Не стандартный getList
        $evenTypeName = $eventTypeObject->GetList(['EVENT_NAME' => self::EVENT_NAME])->GetNext();

        if(!$evenTypeName){
            throw new SystemException($eventTypeObject->LAST_ERROR);
        } else {
            $eventTypeObject->Delete($evenTypeName);
        }
    }
}
