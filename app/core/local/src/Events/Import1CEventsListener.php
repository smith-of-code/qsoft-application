<?php

namespace QSoft\Events;

use CIBlockElement;
use CIBlockProperty;
use COption;

class Import1CEventsListener
{
    public function customCatalogImportStep($arParams,$arFields)
    {

        print $arParams;
        echo $arFields;

        $stepInterval = (int) COption::GetOptionString("catalog", "1C_INTERVAL", "-");
        $startTime = time();
        // Флаг импорта файла торговых предложений
        $isOffers = strpos($_REQUEST['filename'], 'offers') !== false;
        $NS = &$_SESSION["BX_CML2_IMPORT"]["NS"];

        if (!isset($NS['custom']['lastId'])) {
            // Последний отработанный элемент для пошаговости.
            $NS['custom']['lastId'] = 0;
            $NS['custom']['counter'] = 0;
        }

        // Условия выборки элементов для обработки
        $arFilter = array(
            'IBLOCK_ID' => 154,
            'ACTIVE' => 'Y',
        );

        $res = CIBlockElement::GetList(array('ID' => 'ASC'), array_merge($arFilter, array('>ID' => $NS['custom']['lastId'])));
        $errorMessage = null;

        while ($arItem = $res->Fetch()) {
            /*
            // Что-нибудь делаем
            if (updateElement($arItem['ID']) === false) {
                $error = true;
            }
            */

            if ($error === true) {
                $errorMessage = 'Что-то случилось.';
                break;
            }

            $NS['custom']['lastId'] = $arItem['ID'];
            $NS['custom']['counter']++;

            // Прерывание по времени шага
            if ($stepInterval > 0 && (time() - $startTime) > $stepInterval) {
                break;
            }
        }

        if ($arItem != false) {
            if ($errorMessage === null) {
                print "progress\n";
                print "Обработано " . $NS['custom']['counter'] . ' элементов, осталось ' . $res->SelectedRowsCount();
            } else {
                print "failure\n" . $errorMessage;
            }

            $contents = ob_get_contents();
            ob_end_clean();

            if (toUpper(LANG_CHARSET) != "WINDOWS-1251") {
                $contents = $GLOBALS['APPLICATION']->ConvertCharset($contents, LANG_CHARSET, "windows-1251");
            }

            header("Content-Type: text/html; charset=windows-1251");
            print $contents;
            exit;
        }

    }


    public function OnBeforeIBlockElementUpdate(&$arFields){
        $arFields["SORT"] = 501;
    }
}
