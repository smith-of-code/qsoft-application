<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<!-- НАЧАЛО СПИСКА РАЗДЕЛОВ КАТАЛОГА -->
<?
$TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
$CURRENT_DEPTH = $TOP_DEPTH;

// Открывающий участок блока списка разделов
if (! empty($arResult["SECTIONS"])):
    if ($TOP_DEPTH == 0): ?>
        <div class="filter__accordeon accordeon accordeon--simple accordeon--small">
    <?php else: ?>
        <div class="filter__header">
            <p class="filter__heading heading heading--small">Категории</p>
        </div>

        <div class="category">
            <ul class="category__list">
    <?php endif;
endif;

$openLevel1 = "";
$closeLevel1 = "";
$openLevel2 = "";
$closeLevel2 = "";
$link = "";

foreach($arResult["SECTIONS"] as $key => $arSection) {
    $count = $arParams["COUNT_ELEMENTS"] && $arSection["ELEMENT_CNT"] ? "&nbsp;(".$arSection["ELEMENT_CNT"].")" : "";
    $name = $arSection["NAME"] . $count;
    $url = $arSection["SECTION_PAGE_URL"];
    $openExpandable = false;
    $closeExpandable = false;

    if ($TOP_DEPTH == 0) { // Верстка для корневого раздела

        $openLevel1 = <<<OPEN_LEVEL_1
        <div class="accordeon__item box box--rounded-sm" data-accordeon>
            <div class="accordeon__header" data-accordeon-toggle>
                <h5 class="accordeon__title accordeon__title--dark">$name</h5>
                <button type="button" class="accordeon__toggle button button--circular button--mini button--mixed button--gray-red">
                    <span class="accordeon__toggle-icon button__icon">
                        <svg class="icon icon--arrow-down">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                        </svg>
                    </span>
                </button>
            </div>

            <div class="filter__accordeon-body accordeon__body" data-accordeon-content>
                <div class="category">
                    <ul class="category__list">
OPEN_LEVEL_1;

        $closeLevel1 = <<<CLOSE_LEVEL_1
                    </ul>
                </div>
            </div>
        </div>
CLOSE_LEVEL_1;

        $openLevel2 = <<<OPEN_LEVEL_2
                        <li class="category__item">
OPEN_LEVEL_2;

        $closeLevel2 = <<<CLOSE_LEVEL_2
                        </li>
CLOSE_LEVEL_2;

        $link = <<<LINK
                            <a href="$url" class="category__item-link button button--simple button--red">$name</a>
LINK;

    } else { // Верстка для вложенного раздела

        // Если следующий уровень будет вложенный - открываем блок с учетом функционала сворачивания списка
        if (isset($arResult["SECTIONS"][$key+1]) && $arResult["SECTIONS"][$key+1]["DEPTH_LEVEL"] > $arSection["DEPTH_LEVEL"]) {
            $openExpandable = true;
        }
        // Если предыдущий уровень был вложенный - закрываем блок с учетом функционала сворачивания списка
        if (isset($arResult["SECTIONS"][$key-1]) && $arResult["SECTIONS"][$key-1]["DEPTH_LEVEL"] > $arSection["DEPTH_LEVEL"]) {
            $closeExpandable = true;
        }

        $openLevel1 = <<<OPEN_LEVEL_1
        <li class="category__item">
OPEN_LEVEL_1;

        $closeLevel1 = <<<CLOSE_LEVEL_1
        </li>
CLOSE_LEVEL_1;

        if ($openExpandable) {
            $openLevel1 = <<<OPEN_LEVEL_1
            <!-- ОТКРЫТИЕ ВЛОЖЕННОГО СПИСКА -->
            <li class="category__item">
                <div class="accordeon accordeon--small" data-accordeon>
                    <div class="accordeon__header" data-accordeon-toggle>
                        <a href="$url" class="accordeon__title category__item-link button button--simple button--red">$name</a>
                        <button type="button" class="accordeon__toggle button button--circular button--mini button--mixed button--gray-red">
                            <span class="accordeon__toggle-icon button__icon">
                                <svg class="icon icon--arrow-down">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                </svg>
                            </span>
                        </button>
                    </div>
        
                    <div class="filter__accordeon-body accordeon__body" data-accordeon-content>
                        <div class="category">
                            <ul class="category__list">
OPEN_LEVEL_1;
        }

        if ($closeExpandable) {
            $closeLevel1 = <<<CLOSE_LEVEL_1
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <!-- ЗАКРЫТИЕ ВЛОЖЕННОГО СПИСКА -->
CLOSE_LEVEL_1;
        }

        $openLevel2 = <<<OPEN_LEVEL_2
        <li class="category__item">
OPEN_LEVEL_2;

        $closeLevel2 = <<<CLOSE_LEVEL_2
        </li>
CLOSE_LEVEL_2;

        $link = <<<LINK
        <a href="$url" class="category__item-link button button--simple button--red">$name</a>
LINK;

    }

    /* Построение списка разделов */

    if ($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"]) { // Если уровень раздела выше текущего
        if ($CURRENT_DEPTH == $TOP_DEPTH) {
            echo $openLevel1;
            if ($TOP_DEPTH != 0 && !$openExpandable) echo $link;
        } else {
            echo $openLevel2;
            echo $link;
        }
    } elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"]) { // Если уровень тот же
        if ($CURRENT_DEPTH == $TOP_DEPTH + 1) {
            echo $closeLevel1;
            echo $openLevel1;
            if ($TOP_DEPTH != 0 && !$openExpandable) echo $link;
        } else {
            echo $closeLevel2;
            echo $openLevel2;
            echo $link;
        }
    } else { // Если уровень раздела меньше текущего
        echo $closeLevel2;
        echo $closeLevel1;
        echo $openLevel1;
        if ($TOP_DEPTH != 0 && !$openExpandable) echo $link;
    }
    $CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
}

// Закрытие блоков списка разделов
$wasExpandable = false;
while($CURRENT_DEPTH > $TOP_DEPTH) {
    if ($CURRENT_DEPTH > $TOP_DEPTH + 1) {
        echo $closeLevel2;
        if ($TOP_DEPTH != 0) {
            // Индикатор того, что нужно закрыть разворачиваемый список
            $wasExpandable = true;
        }
    } else {
        if ($TOP_DEPTH != 0) {
            if ($wasExpandable) {
                $closeLevel1 = <<<CLOSE_LEVEL_1
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <!-- ЗАКРЫТИЕ ВЛОЖЕННОГО СПИСКА -->
CLOSE_LEVEL_1;
            } else {
                $closeLevel1 = <<<CLOSE_LEVEL_1
        </li>
CLOSE_LEVEL_1;
            }
        }
        echo $closeLevel1;

    }
    $CURRENT_DEPTH--;
}

// Закрывающий участок блока списка разделов
if (! empty($arResult["SECTIONS"])):
    if ($TOP_DEPTH == 0): ?>
        </div>
    <?php else: ?>
            </ul>
        </div>
    <?php endif;
endif;
?>
<!-- КОНЕЦ СПИСКА РАЗДЕЛОВ КАТАЛОГА -->

