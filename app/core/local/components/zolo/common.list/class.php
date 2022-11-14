<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;

//zolo:common.list -"общий": из названия раздела "Сервис Общие страницы" в ВТЗ
class CommonPageComponent extends CBitrixComponent implements Controllerable
{
    private const LIMIT = 15;

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

    public function loadAction($iblock_id, $offset = 0): array
    {
        self::includeModules();
        $nextItemsPack = $this->getItems($iblock_id, $offset,self::LIMIT + 1);
        $isLast = self::LIMIT >= count($nextItemsPack);
        $nextItemsPack = $isLast ? $nextItemsPack : array_slice($nextItemsPack, 0, -1);
        return [
            'ITEMS' => $nextItemsPack,
            'OFFSET' => $offset + count($nextItemsPack),
            'LAST' => $isLast,
        ];
    }

    public function executeComponent()
    {
        $this->arResult = $this->loadAction($this->arParams['IBLOCK_ID']);
        $this->arResult['IBLOCK_ID'] = $this->arParams['IBLOCK_ID'];
        $this->includeComponentTemplate();
    }

    private function getItems($iblock_id, $offset = 0, $limit = 0): array
    {
        $dbItems = CIBlockElement::GetList(
            [
                'PROPERTY_PUBLISHED_AT' =>'DESC'
            ],
            ['IBLOCK_ID' => $iblock_id],
            false,
            [
                'nTopCount' => $limit,
                'nOffset' => $offset,
            ],
            [
                'ID',
                'IBLOCK_ID',
                'NAME',
                'PREVIEW_TEXT',
                'DETAIL_PICTURE',
                'DETAIL_PAGE_URL',
                'PROPERTY_MARKER',
                'PROPERTY_PUBLISHED_AT',
            ]
        );

        while($item = $dbItems->GetNext(true, false)) {
            $result[] = [
                'ID' => $item['ID'],
                'NAME' => $item['NAME'],
                'PREVIEW_TEXT' => $item['PREVIEW_TEXT'],
                'MARKER' => $item['PROPERTY_MARKER_VALUE'],
                'PUBLISHED_AT' => date_format(date_create($item['PROPERTY_PUBLISHED_AT_VALUE']), 'd.m.Y'),
                'PICTURE' => CFile::GetPath($item['DETAIL_PICTURE']),
                'DETAIL_URL' => $item['DETAIL_PAGE_URL'],
            ];
        }
        return $result ?? [];
    }

    private static function includeModules()
    {
        Loader::includeModule("iblock");
    }
}
