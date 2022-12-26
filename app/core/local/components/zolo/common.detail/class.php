<? use QSoft\ORM\MarkerTable;

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

class CommonDetailPageComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        $commonItem = CIBlockElement::GetList(
            [],
            ['ID' => $this->arParams['ID'], 'IBLOCK_ID' => $this->arParams['IBLOCK_ID']],
            false,
            false,
            ['NAME', 'DETAIL_TEXT', 'DETAIL_PICTURE', 'PROPERTY_PUBLISHED_AT', 'PROPERTY_HL_MARKER']
        )->Fetch();

        $marker = MarkerTable::getRow([
            'filter' => [
                '=UF_XML_ID' => $commonItem['PROPERTY_HL_MARKER_VALUE'],
            ],
            'select' => [
                'NAME' => 'UF_NAME',
                'COLOR' => 'UF_COLOR_NAME.UF_XML_ID',
            ],
        ]);

        $this->arResult['ITEM'] = [
            'NAME' => $commonItem['NAME'],
            'DETAIL_TEXT' => $commonItem['DETAIL_TEXT'],
            'PUBLISHED_AT' => date_format(date_create($commonItem['PROPERTY_PUBLISHED_AT_VALUE']),'d.m.Y'),
            'DETAIL_PICTURE' => CFile::GetPath($commonItem['DETAIL_PICTURE']),
            'MARKER_NAME' => $marker['NAME'],
            'MARKER_COLOR' => $marker['COLOR'],
        ];

        $this->includeComponentTemplate();
    }

    private static function getMarkers(): array
    {
        $markers = MarkerTable::getList([
            'select' => [
                'NAME' => 'UF_NAME',
                'XML_ID' => 'UF_XML_ID',
                'COLOR' => 'UF_COLOR_NAME.UF_XML_ID',
            ],
        ])->fetchAll();
        foreach ($markers as $marker) {
            $markers[$marker['XML_ID']] = $marker;
        }
        return $markers ?? [];
    }
}?>