<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule("iblock");

//zolo:common.list -"общий": из названия раздела "Сервис Общие страницы" в ВТЗ
class CommonPageComponent extends CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable
{
    private const LIMIT = 3;

    public function configureActions()
    {
        return [
            'load' => [
                '-prefilters' => [
                    \Bitrix\Main\Engine\ActionFilter\Csrf::class,
                    \Bitrix\Main\Engine\ActionFilter\Authentication::class
                ],
            ]
        ];
    }

    public function loadAction($iblock_id, $offset)
    {
        $nextItemsPack = $this->getItems($iblock_id, $offset);
        return ['ITEMS' => $nextItemsPack, 'OFFSET' => $offset + count($nextItemsPack)];
    }

    public function executeComponent()
    {
        $this->arResult['ITEMS'] = $this->getItems($this->arParams['IBLOCK_ID']);
        $this->arResult['IBLOCK_ID'] = $this->arParams['IBLOCK_ID'];
        $this->arResult['OFFSET'] = self::LIMIT;
        $this->includeComponentTemplate();
    }

    private function getItems($iblock_id, $offset = 0)
    {
        $dbItems = CIBlockElement::GetList(
            [],
            ['IBLOCK_ID' => $iblock_id],
            false,
            [
                'nTopCount' => self::LIMIT,
                'nOffset' => $offset,
            ],
            ['ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_TEXT', 'DETAIL_PICTURE', 'PROPERTY_MARKER', 'PROPERTY_PUBLISHED_AT']
        );

        while($item = $dbItems->GetNext(true, false)) {
            $result[] = [
                'NAME' => $item['NAME'],
                'PREVIEW_TEXT' => $item['PREVIEW_TEXT'],
                'MARKER' => $item['PROPERTY_MARKER_VALUE'],
                'PUBLISHED_AT' => $item['PUBLISHED_AT_VALUE'],
                'DETAIL_PICTURE' => CFile::GetPath($item['DETAIL_PICTURE']),
            ];
        }

        return $result;
    }
}?>