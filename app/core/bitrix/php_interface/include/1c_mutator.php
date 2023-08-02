<?
// Создадим функцию, которая будет добавлять или обновлять свойство
// "Оригинальный номер", которого нет в CommerceML файле
function catalog_property_mutator_1c()
{
    global $IBLOCK_ID, $tmpid, $strError, $STT_PROP_ERROR, $STT_PROP_ADD, $STT_PROP_UPDATE, $arProperties;
    $ibp = new CIBlockProperty;
    $PROP_XML_ID = "ORIGINOMER";
    $PROP_NAME = "Оригинальный номер";
    $PROP_MULTIPLE = "N";
    $PROP_DEF = "";
    $res = CIBlock::GetProperties($IBLOCK_ID, Array(), Array("XML_ID"=>$PROP_XML_ID, "IBLOCK_ID"=>$IBLOCK_ID));
    $bNewRecord_tmp = False;
    if ($res_arr = $res->Fetch())
    {
        $PROP_ID = $res_arr["ID"];
        $res = $ibp->Update($PROP_ID,
            Array(
                "NAME" => $PROP_NAME,
                "MULTIPLE" => $PROP_MULTIPLE,
                "DEFAULT_VALUE" => $PROP_DEF,
                "TMP_ID" => $tmpid
            )
        );
    }
    else
    {
        $bNewRecord_tmp = True;
        $arFields = Array(
            "NAME" => $PROP_NAME,
            "ACTIVE" => "Y",
            "SORT" => "501",
            "DEFAULT_VALUE" => $PROP_DEF,
            "XML_ID" => $PROP_XML_ID,
            "TMP_ID" => $tmpid,
            "MULTIPLE" => $PROP_MULTIPLE,
            "IBLOCK_ID" => $IBLOCK_ID
        );
        $PROP_ID = $ibp->Add($arFields);
        $res = (IntVal($PROP_ID)>0);
    }
    if (!$res)
    {
        $strError .= "Ошибка загрузки свойства [".$PROP_ID."] \"".$PROP_NAME."\" (".$PROP_XML_ID."): ".$ibp->LAST_ERROR.".<br>";
        $STT_PROP_ERROR++;
    }
    else
    {
        if ($bNewRecord_tmp) $STT_PROP_ADD++;
        else $STT_PROP_UPDATE++;
        $arProperties[$PROP_XML_ID] = $PROP_ID;
    }
}
?>
