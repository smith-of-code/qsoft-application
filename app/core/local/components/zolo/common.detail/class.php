<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

class CommonDetailPageComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        $commonItem = CIBlockElement::GetList(
            [],
            ['ID' => $this->arParams['ID'], 'IBLOCK_ID' => $this->arParams['IBLOCK_ID']],
            false,
            false,
            ['NAME', 'DETAIL_TEXT', 'DETAIL_PICTURE', 'PROPERTY_PUBLISHED_AT']
        )->Fetch();

        $this->arResult['ITEM'] = [
            'NAME' => $commonItem['NAME'],
            'DETAIL_TEXT' => $commonItem['DETAIL_TEXT'],
            'PUBLISHED_AT' => $commonItem['PUBLISHED_AT_VALUE'],
            'DETAIL_PICTURE' => CFile::GetPath($commonItem['DETAIL_PICTURE']),
        ];

        $this->includeComponentTemplate();
    }
}?>