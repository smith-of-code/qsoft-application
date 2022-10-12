<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

class CommonPageComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        $dbItems = CIBlockElement::GetList(
            [],
            ['IBLOCK_ID' => $this->arParams['IBLOCK_ID']],
            false,
            false,
            ['ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_TEXT', 'DETAIL_PICTURE', 'PROPERTY_MARKER', 'PROPERTY_PUBLISHED_AT']
        );

        while($item = $dbItems->GetNext(true, false)) {
            $this->arResult['ITEMS'][] = [
                'NAME' => $item['NAME'],
                'PREVIEW_TEXT' => $item['PREVIEW_TEXT'],
                'MARKER' => $item['PROPERTY_MARKER_VALUE'],
                'PUBLISHED_AT' => $item['PUBLISHED_AT_VALUE'],
                'DETAIL_PICTURE' => CFile::GetPath($item['DETAIL_PICTURE']),
            ];
        }
        $this->includeComponentTemplate();
    }
}?>