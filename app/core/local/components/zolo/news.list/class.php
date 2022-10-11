<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

\Bitrix\Main\Loader::includeModule('iblock');

class NewsListComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        $targetArr = ["NAME", "PREVIEW_TEXT", "DETAIL_PICTURE"];
        $arSelect = array_merge(["ID", "IBLOCK_ID", "PROPERTY_MARKER"], $targetArr);
        $arFilter = ["IBLOCK_ID" => $this->arParams['IBLOCK_ID']];
        $dbItems = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
        $this->arResult = ['NEWS' => []];
        $targetArr[] = "PROPERTY_MARKER_VALUE";

        while($itemArr = $dbItems->GetNext(true, false)){
            $itemArr['DETAIL_PICTURE'] = CFile::GetPath($itemArr['DETAIL_PICTURE']);
            $this->arResult['NEWS'][] = array_combine($targetArr, array_map(fn($key) => $itemArr[$key], $targetArr));
        }

        $this->includeComponentTemplate("test");
    }
}?>