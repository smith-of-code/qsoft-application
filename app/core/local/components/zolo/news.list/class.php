<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class NewsListComponent extends CBitrixComponent
{
    private const NOIMAGE = "детальное изображение не найдено";

    public function executeComponent()
    {
        $dbNews = CIBlockElement::GetList(
            [],
            ["IBLOCK_ID" => $this->arParams['IBLOCK_ID']],
            false,
            false,
            ["ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_PICTURE", "PROPERTY_MARKER"]
        );

        while($newsItem = $dbNews->GetNext(true, false)) {
            $this->arResult["NEWS"][] = [
                "NAME" => $newsItem["NAME"],
                "PREVIEW_TEXT" => $newsItem["PREVIEW_TEXT"],
                "MARKER" => $newsItem["PROPERTY_MARKER_VALUE"],
                "DETAIL_PICTURE" => CFile::GetPath($newsItem["DETAIL_PICTURE"]) ?? self::NOIMAGE,
            ];
        }
        $this->includeComponentTemplate();
    }
}?>