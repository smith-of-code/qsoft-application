<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 07.08.15
 * Time: 19:41
 */

use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;
use QSoft\Migration\Migration;

class NewCategoriesForSupportService extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $this->initModule();

        $categories = [
		    [
                "C_TYPE" => "C",
                "SID" => "REFUND_ORDER",
                "SET_AS_DEFAULT" => "N",
                "C_SORT" => "100",
                "NAME" => "Возврат заказа",
                "DESCR" => "",
                "RESPONSIBLE_USER_ID" => "1",
                "EVENT1" => "",
                "EVENT2" => "",
                "EVENT3" => "",
                'arrSITE' => [
                    "s1"
                ]
            ],
            [
                "C_TYPE" => "C",
                "SID" => "OTHER",
                "SET_AS_DEFAULT" => "N",
                "C_SORT" => "100",
                "NAME" => "Другое",
                "DESCR" => "",
                "RESPONSIBLE_USER_ID" => "1",
                "EVENT1" => "",
                "EVENT2" => "",
                "EVENT3" => "",
                'arrSITE' => [
                    "s1"
                ]
            ],
        ];

        foreach ($categories as $categoryFields) {
           CTicketDictionary::Add($categoryFields);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $this->initModule();
        
        $arrayFilter = ['REFUND_ORDER', 'OTHER'];

        $DBResult = CTicketDictionary::GetList([],[],['SID' => implode('|',$arrayFilter)]);

        while ($catecory = $DBResult->GetNext()) {
           CTicketDictionary::delete($catecory['ID'], 'N');
        }
    }

    /**
     * @return void
     * @throw SystemException
     */
    private function initModule(): void
    {
        if (!Loader::includeModule('support')) {
            throw new SystemException('Не подключен модуль ТП');
        }
    }
}
