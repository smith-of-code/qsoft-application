<?

use Bitrix\Catalog\ProductTable;
use \Bitrix\Main;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Error;
use \Bitrix\Main\Type\DateTime;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Iblock;
use \Bitrix\Iblock\Component\ElementList;
use QSoft\Entity\User;
use QSoft\Service\WishlistService;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global CIntranetToolbar $INTRANET_TOOLBAR
 */

Loc::loadMessages(__FILE__);

if (!\Bitrix\Main\Loader::includeModule('iblock'))
{
	ShowError(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
	return;
}

class CatalogSectionComponent extends ElementList
{
	public function __construct($component = null)
	{
		parent::__construct($component);
		$this->setExtendedMode(false)->setMultiIblockMode(false)->setPaginationMode(true);
		$this->setSeparateLoading(true);
	}

	public function onPrepareComponentParams($params)
	{
		$params = parent::onPrepareComponentParams($params);

		if (
			empty($this->globalFilter)
			&& !empty($params['EXTERNAL_PRODUCT_IDS'])
			&& is_array($params['EXTERNAL_PRODUCT_IDS'])
		)
		{
			$params['EXTERNAL_PRODUCT_MAP'] = static::getProductsMap($params['EXTERNAL_PRODUCT_IDS']);
			if (!empty($params['EXTERNAL_PRODUCT_MAP']))
			{
				$this->globalFilter = [
					'ID' => array_unique(array_values($params['EXTERNAL_PRODUCT_MAP']))
				];
			}
		}

        // Добавляем к фильтру ограничение - выводим только товары с торговыми предложениями,
        // т. к. предполагается только их использование в каталоге
        //$this->globalFilter['TYPE'] = \Bitrix\Catalog\ProductTable::TYPE_SKU; //этот вариант не работает при фильтрации
        $this->globalFilter['OFFERS']['ACTIVE'] = 'Y';

		unset($params['EXTERNAL_PRODUCT_IDS']);

		$params['IBLOCK_TYPE'] = isset($params['IBLOCK_TYPE']) ? trim($params['IBLOCK_TYPE']) : '';

		if ((int)$params['SECTION_ID'] > 0 && (int)$params['SECTION_ID'].'' != $params['SECTION_ID'] && Loader::includeModule('iblock'))
		{
			$this->errorCollection->setError(new Error(Loc::getMessage('CATALOG_SECTION_NOT_FOUND'), self::ERROR_404));
			return $params;
		}

		$params['SECTION_ID_VARIABLE'] = (isset($params['SECTION_ID_VARIABLE']) ? trim($params['SECTION_ID_VARIABLE']) : '');
		if ($params['SECTION_ID_VARIABLE'] == '' || !preg_match(self::PARAM_TITLE_MASK, $params['SECTION_ID_VARIABLE']))
			$params['SECTION_ID_VARIABLE'] = 'SECTION_ID';

		$params['SHOW_ALL_WO_SECTION'] = isset($params['SHOW_ALL_WO_SECTION']) && $params['SHOW_ALL_WO_SECTION'] === 'Y';
		$params['USE_MAIN_ELEMENT_SECTION'] = isset($params['USE_MAIN_ELEMENT_SECTION']) && $params['USE_MAIN_ELEMENT_SECTION'] === 'Y';
		$params['SECTIONS_CHAIN_START_FROM'] = isset($params['SECTIONS_CHAIN_START_FROM']) ? (int)$params['SECTIONS_CHAIN_START_FROM'] : 0;

		$params['BACKGROUND_IMAGE'] = isset($params['BACKGROUND_IMAGE']) ? trim($params['BACKGROUND_IMAGE']) : '';
		if ($params['BACKGROUND_IMAGE'] === '-')
		{
			$params['BACKGROUND_IMAGE'] = '';
		}

		// compatibility for bigData case with zero initial elements
		if ($params['PAGE_ELEMENT_COUNT'] <= 0 && !isset($params['PRODUCT_ROW_VARIANTS']))
		{
			$params['PAGE_ELEMENT_COUNT'] = 20;
		}

		$params['CUSTOM_CURRENT_PAGE'] = isset($params['CUSTOM_CURRENT_PAGE']) ? trim($params['CUSTOM_CURRENT_PAGE']) : '';

		$params['COMPATIBLE_MODE'] = (isset($params['COMPATIBLE_MODE']) && $params['COMPATIBLE_MODE'] === 'N' ? 'N' : 'Y');
		if ($params['COMPATIBLE_MODE'] === 'N')
		{
			$params['DISABLE_INIT_JS_IN_COMPONENT'] = 'Y';
			$params['OFFERS_LIMIT'] = 0;
		}

		$this->setCompatibleMode($params['COMPATIBLE_MODE'] === 'Y');

		$params['DISABLE_INIT_JS_IN_COMPONENT'] = isset($params['DISABLE_INIT_JS_IN_COMPONENT']) && $params['DISABLE_INIT_JS_IN_COMPONENT'] === 'Y' ? 'Y' : 'N';

		if ($params['DISABLE_INIT_JS_IN_COMPONENT'] !== 'Y')
		{
			CJSCore::Init(array('popup'));
		}

		return $params;
	}

	protected function processResultData()
	{
		if ($this->initSectionResult())
		{
			$this->initSectionProperties();
			parent::processResultData();
		}
	}

	protected function initSectionResult()
	{
		$success = true;
		$selectFields = array();

		if (!empty($this->arParams['SECTION_USER_FIELDS']) && is_array($this->arParams['SECTION_USER_FIELDS']))
		{
			foreach ($this->arParams['SECTION_USER_FIELDS'] as $field)
			{
				if (is_string($field) && preg_match('/^UF_/', $field))
				{
					$selectFields[] = $field;
				}
			}
		}

		if (preg_match('/^UF_/', $this->arParams['META_KEYWORDS']))
		{
			$selectFields[] = $this->arParams['META_KEYWORDS'];
		}

		if (preg_match('/^UF_/', $this->arParams['META_DESCRIPTION']))
		{
			$selectFields[] = $this->arParams['META_DESCRIPTION'];
		}

		if (preg_match('/^UF_/', $this->arParams['BROWSER_TITLE']))
		{
			$selectFields[] = $this->arParams['BROWSER_TITLE'];
		}

		if (preg_match('/^UF_/', $this->arParams['BACKGROUND_IMAGE']))
		{
			$selectFields[] = $this->arParams['BACKGROUND_IMAGE'];
		}

		$filterFields = array(
			'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
			'IBLOCK_ACTIVE' => 'Y',
			'ACTIVE' => 'Y',
			'GLOBAL_ACTIVE' => 'Y',
		);

		// Hidden tricky parameter USED to display linked
		// by default it is not set
		if (isset($this->arParams['BY_LINK']) && $this->arParams['BY_LINK'] === 'Y')
		{
			$sectionResult = array(
				'ID' => 0,
				'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
			);
		}
		elseif ($this->arParams['SECTION_ID'] > 0)
		{
			$filterFields['ID'] = $this->arParams['SECTION_ID'];
			$sectionIterator = CIBlockSection::GetList(array(), $filterFields, false, $selectFields);
			$sectionIterator->SetUrlTemplates('', $this->arParams['SECTION_URL']);
			$sectionResult = $sectionIterator->GetNext();
		}
		elseif ($this->arParams['SECTION_CODE'] <> '')
		{
			$filterFields['=CODE'] = $this->arParams['SECTION_CODE'];
			$sectionIterator = CIBlockSection::GetList(array(), $filterFields, false, $selectFields);
			$sectionIterator->SetUrlTemplates('', $this->arParams['SECTION_URL']);
			$sectionResult = $sectionIterator->GetNext();
		}
		elseif (isset($this->arParams['SECTION_CODE_PATH']) && $this->arParams['SECTION_CODE_PATH'] <> '')
		{
			$sectionId = CIBlockFindTools::GetSectionIDByCodePath($this->arParams['IBLOCK_ID'], $this->arParams['SECTION_CODE_PATH']);
			if ($sectionId)
			{
				$filterFields['ID'] = $sectionId;
				$sectionIterator = CIBlockSection::GetList(array(), $filterFields, false, $selectFields);
				$sectionIterator->SetUrlTemplates('', $this->arParams['SECTION_URL']);
				$sectionResult = $sectionIterator->GetNext();
			}
		}
		else	// Root section (no section filter)
		{
			$sectionResult = array(
				'ID' => 0,
				'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
			);
		}

		if (empty($sectionResult))
		{
			$success = false;
			$this->abortResultCache();
			$this->errorCollection->setError(new Error(Loc::getMessage('CATALOG_SECTION_NOT_FOUND'), self::ERROR_404));
		}
		else
		{
			$this->arResult = array_merge($this->arResult, $sectionResult);
			if ($this->arResult['ID'] > 0 && $this->arParams['ADD_SECTIONS_CHAIN'])
			{
				$this->arResult['PATH'] = array();
				$pathIterator = CIBlockSection::GetNavChain(
					$this->arResult['IBLOCK_ID'],
					$this->arResult['ID'],
					array(
						'ID', 'CODE', 'XML_ID', 'EXTERNAL_ID', 'IBLOCK_ID',
						'IBLOCK_SECTION_ID', 'SORT', 'NAME', 'ACTIVE',
						'DEPTH_LEVEL', 'SECTION_PAGE_URL'
					)
				);
				$pathIterator->SetUrlTemplates('', $this->arParams['SECTION_URL']);
				while ($path = $pathIterator->GetNext())
				{
					$ipropValues = new Iblock\InheritedProperty\SectionValues($this->arParams['IBLOCK_ID'], $path['ID']);
					$path['IPROPERTY_VALUES'] = $ipropValues->getValues();
					$this->arResult['PATH'][] = $path;
				}

				if ($this->arParams['SECTIONS_CHAIN_START_FROM'] > 0)
				{
					$this->arResult['PATH'] = array_slice($this->arResult['PATH'], $this->arParams['SECTIONS_CHAIN_START_FROM']);
				}
			}
		}

		return $success;
	}

	protected function initSectionProperties()
	{
		$arResult =& $this->arResult;

		$arResult['IPROPERTY_VALUES'] = array();
		if ($arResult['ID'] > 0)
		{
			$ipropValues = new Iblock\InheritedProperty\SectionValues($arResult['IBLOCK_ID'], $arResult['ID']);
			$arResult['IPROPERTY_VALUES'] = $ipropValues->getValues();
		}

		Iblock\Component\Tools::getFieldImageData(
			$arResult,
			array('PICTURE', 'DETAIL_PICTURE'),
			Iblock\Component\Tools::IPROPERTY_ENTITY_SECTION,
			'IPROPERTY_VALUES'
		);

		$arResult['BACKGROUND_IMAGE'] = false;
		if ($this->arParams['BACKGROUND_IMAGE'] != '' && !empty($arResult[$this->arParams['BACKGROUND_IMAGE']]))
		{
			$arResult['BACKGROUND_IMAGE'] = CFile::GetFileArray($arResult[$this->arParams['BACKGROUND_IMAGE']]);
		}
	}

	protected function initCatalogInfo()
	{
		parent::initCatalogInfo();
		$useCatalogButtons = array();
		if (
			!empty($this->storage['CATALOGS'][$this->arParams['IBLOCK_ID']])
			&& is_array($this->storage['CATALOGS'][$this->arParams['IBLOCK_ID']])
		)
		{
			$catalogType = $this->storage['CATALOGS'][$this->arParams['IBLOCK_ID']]['CATALOG_TYPE'];
			if ($catalogType == CCatalogSku::TYPE_CATALOG || $catalogType == CCatalogSku::TYPE_FULL)
			{
				$useCatalogButtons['add_product'] = true;
			}

			if ($catalogType == CCatalogSku::TYPE_PRODUCT || $catalogType == CCatalogSku::TYPE_FULL)
			{
				$useCatalogButtons['add_sku'] = true;
			}
			unset($catalogType);
		}

		$this->storage['USE_CATALOG_BUTTONS'] = $useCatalogButtons;
	}

	protected function getCacheKeys()
	{
		return array(
			'ID',
			'NAV_CACHED_DATA',
			'NAV_STRING',
			$this->arParams['META_KEYWORDS'],
			$this->arParams['META_DESCRIPTION'],
			$this->arParams['BROWSER_TITLE'],
			$this->arParams['BACKGROUND_IMAGE'],
			'NAME',
			'PATH',
			'IBLOCK_SECTION_ID',
			'IPROPERTY_VALUES',
			'ITEMS_TIMESTAMP_X',
			'BACKGROUND_IMAGE',
			'USE_CATALOG_BUTTONS'
		);
	}

	protected function getFilter()
	{
		$filterFields = parent::getFilter();

		if ($this->getAction() === 'bigDataLoad')
		{
			return $filterFields;
		}

		$filterFields['INCLUDE_SUBSECTIONS'] = $this->arParams['INCLUDE_SUBSECTIONS'] === 'N' ? 'N' : 'Y';

		if ($this->arParams['INCLUDE_SUBSECTIONS'] === 'A')
		{
			$filterFields['SECTION_GLOBAL_ACTIVE'] = 'Y';
		}

		if (!isset($this->arParams['BY_LINK']) || $this->arParams['BY_LINK'] !== 'Y')
		{
			if ($this->arResult['ID'])
			{
				$filterFields['SECTION_ID'] = $this->arResult['ID'];
			}
			elseif (!$this->arParams['SHOW_ALL_WO_SECTION'])
			{
				$filterFields['SECTION_ID'] = 0;
			}
			else
			{
				unset($filterFields['INCLUDE_SUBSECTIONS']);
				unset($filterFields['SECTION_GLOBAL_ACTIVE']);
			}
		}

		return $filterFields;
	}

	protected function editTemplateItems(&$items)
	{
		$items = $this->prepareItemsByExternalProductMap($items);
		parent::editTemplateItems($items);
	}

	protected function prepareItemsByExternalProductMap(array $items): array
	{
		if (!empty($this->arParams['EXTERNAL_PRODUCT_MAP']) && is_array($this->arParams['EXTERNAL_PRODUCT_MAP']))
		{
			$itemsByProductId = array_column($items, null, 'ID');
			$newItems = [];

			foreach ($this->arParams['EXTERNAL_PRODUCT_MAP'] as $offerId => $productId)
			{
				$nextItem = $itemsByProductId[$productId] ?? null;
				if ($nextItem === null)
				{
					continue;
				}

				// offer id not specified
				if ($offerId === $productId)
				{
					$found = true;
				}
				else
				{
					$found = false;
					foreach ($nextItem['OFFERS'] as $offer)
					{
						if ($offer['ID'] === $offerId)
						{
							$nextItem['OFFER_ID_SELECTED'] = $offerId;
							$found = true;
							break;
						}
					}
				}

				if ($found)
				{
					$newItems[] = $nextItem;
				}
			}

			$items = $newItems;
		}

		return $items;
	}

	protected function makeOutputResult()
	{
		parent::makeOutputResult();

        $user = new User;
        foreach ($this->arResult['ITEMS'] as &$product) {
            foreach ($product['OFFERS'] as &$offer) {
                $offer = array_merge($offer, $user->products->getOfferPrices($offer['ID']));
                $offer['BONUSES'] = $user->loyalty->calculateBonusesByPrice($offer['PRICE']);
            }
        }
		$this->arResult['USE_CATALOG_BUTTONS'] = $this->storage['USE_CATALOG_BUTTONS'];
	}

	protected function initialLoadAction()
	{
		parent::initialLoadAction();

		if (!$this->hasErrors())
		{
			$this->initAdminIconsPanel();
			$this->setTemplateCachedData($this->arResult['NAV_CACHED_DATA']);
			$this->initMetaData();
		}
	}

	protected function initAdminIconsPanel()
	{
		global $APPLICATION, $INTRANET_TOOLBAR, $USER;

		if (!$USER->IsAuthorized())
		{
			return;
		}

		$arResult =& $this->arResult;

		if (
			$APPLICATION->GetShowIncludeAreas()
			|| (is_object($INTRANET_TOOLBAR) && $this->arParams['INTRANET_TOOLBAR'] !== 'N')
			|| $this->arParams['SET_TITLE']
			|| isset($arResult[$this->arParams['BROWSER_TITLE']])
		)
		{
			if (Loader::includeModule('iblock'))
			{
				$urlDeleteSectionButton = '';

				if (isset($arResult['IBLOCK_SECTION_ID']) && $arResult['IBLOCK_SECTION_ID'] > 0)
				{
					$sectionIterator = CIBlockSection::GetList(
						array(),
						array('=ID' => $arResult['IBLOCK_SECTION_ID']),
						false,
						array('SECTION_PAGE_URL')
					);
					$sectionIterator->SetUrlTemplates('', $this->arParams['SECTION_URL']);
					$section = $sectionIterator->GetNext();
					$urlDeleteSectionButton = $section['SECTION_PAGE_URL'];
				}

				if (empty($urlDeleteSectionButton))
				{
					$urlTemplate = CIBlock::GetArrayByID($this->arParams['IBLOCK_ID'], 'LIST_PAGE_URL');
					$iblock = CIBlock::GetArrayByID($this->arParams['IBLOCK_ID']);
					$iblock['IBLOCK_CODE'] = $iblock['CODE'];
					$urlDeleteSectionButton = CIBlock::ReplaceDetailUrl($urlTemplate, $iblock, true, false);
				}

				$returnUrl = array(
					'add_section' => (
					$this->arParams['SECTION_URL'] <> ''? $this->arParams['SECTION_URL'] : CIBlock::GetArrayByID($this->arParams['IBLOCK_ID'], 'SECTION_PAGE_URL')
					),
					'delete_section' => $urlDeleteSectionButton,
				);
				$buttonParams = array(
					'RETURN_URL' => $returnUrl,
					'CATALOG' => true
				);

				if (isset($arResult['USE_CATALOG_BUTTONS']))
				{
					$buttonParams['USE_CATALOG_BUTTONS'] = $arResult['USE_CATALOG_BUTTONS'];
				}

				$buttons = CIBlock::GetPanelButtons(
					$this->arParams['IBLOCK_ID'],
					0,
					$arResult['ID'],
					$buttonParams
				);
				unset($buttonParams);

				if ($APPLICATION->GetShowIncludeAreas())
				{
					$this->addIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $buttons));
				}

				if (
					is_array($buttons['intranet'])
					&& is_object($INTRANET_TOOLBAR)
					&& $this->arParams['INTRANET_TOOLBAR'] !== 'N'
				)
				{
					Main\Page\Asset::getInstance()->addJs('/bitrix/js/main/utils.js');

					foreach ($buttons['intranet'] as $button)
					{
						$INTRANET_TOOLBAR->AddButton($button);
					}
				}

				if ($this->arParams['SET_TITLE'] || isset($arResult[$this->arParams['BROWSER_TITLE']]))
				{
					if (isset($buttons['submenu']['edit_section']))
					{
						$this->storage['TITLE_OPTIONS'] = array(
							'ADMIN_EDIT_LINK' => $buttons['submenu']['edit_section']['ACTION'],
							'PUBLIC_EDIT_LINK' => $buttons['edit']['edit_section']['ACTION'],
							'COMPONENT_NAME' => $this->getName(),
						);
					}
				}
			}
		}
	}

	protected function initMetaData()
	{
		global $APPLICATION;

		if ($this->arParams['SET_TITLE'])
		{
			if (isset($this->arResult['IPROPERTY_VALUES']['SECTION_PAGE_TITLE']) && $this->arResult['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] != '')
			{
				$APPLICATION->SetTitle($this->arResult['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'], $this->storage['TITLE_OPTIONS']);
			}
			elseif (isset($this->arResult['NAME']))
			{
				$APPLICATION->SetTitle($this->arResult['NAME'], $this->storage['TITLE_OPTIONS']);
			}
		}

		if ($this->arParams['SET_BROWSER_TITLE'] === 'Y')
		{
			$browserTitle = Main\Type\Collection::firstNotEmpty(
				$this->arResult, $this->arParams['BROWSER_TITLE'],
				$this->arResult['IPROPERTY_VALUES'], 'SECTION_META_TITLE'
			);
			if (is_array($browserTitle))
			{
				$APPLICATION->SetPageProperty('title', implode(' ', $browserTitle), $this->storage['TITLE_OPTIONS']);
			}
			elseif ($browserTitle != '')
			{
				$APPLICATION->SetPageProperty('title', $browserTitle, $this->storage['TITLE_OPTIONS']);
			}
		}

		if ($this->arParams['SET_META_KEYWORDS'] === 'Y')
		{
			$metaKeywords = Main\Type\Collection::firstNotEmpty(
				$this->arResult, $this->arParams['META_KEYWORDS'],
				$this->arResult['IPROPERTY_VALUES'], 'SECTION_META_KEYWORDS'
			);
			if (is_array($metaKeywords))
			{
				$APPLICATION->SetPageProperty('keywords', implode(' ', $metaKeywords), $this->storage['TITLE_OPTIONS']);
			}
			elseif ($metaKeywords != '')
			{
				$APPLICATION->SetPageProperty('keywords', $metaKeywords, $this->storage['TITLE_OPTIONS']);
			}
		}

		if ($this->arParams['SET_META_DESCRIPTION'] === 'Y')
		{
			$metaDescription = Main\Type\Collection::firstNotEmpty(
				$this->arResult, $this->arParams['META_DESCRIPTION'],
				$this->arResult['IPROPERTY_VALUES'], 'SECTION_META_DESCRIPTION'
			);
			if (is_array($metaDescription))
			{
				$APPLICATION->SetPageProperty('description', implode(' ', $metaDescription), $this->storage['TITLE_OPTIONS']);
			}
			elseif ($metaDescription != '')
			{
				$APPLICATION->SetPageProperty('description', $metaDescription, $this->storage['TITLE_OPTIONS']);
			}
		}

		if (!empty($this->arResult['BACKGROUND_IMAGE']) && is_array($this->arResult['BACKGROUND_IMAGE']))
		{
			$APPLICATION->SetPageProperty(
				'backgroundImage',
				'style="background-image: url(\''.\CHTTP::urnEncode($this->arResult['BACKGROUND_IMAGE']['SRC'], 'UTF-8').'\')"'
			);
		}

		if ($this->arParams['ADD_SECTIONS_CHAIN'] && is_array($this->arResult['PATH']))
		{
			foreach ($this->arResult['PATH'] as $path)
			{
				if ($path['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] != '')
				{
					$APPLICATION->AddChainItem($path['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'], $path['~SECTION_PAGE_URL']);
				}
				else
				{
					$APPLICATION->AddChainItem($path['NAME'], $path['~SECTION_PAGE_URL']);
				}
			}
		}

		if ($this->arParams['SET_LAST_MODIFIED'] && $this->arResult['ITEMS_TIMESTAMP_X'])
		{
			Main\Context::getCurrent()->getResponse()->setLastModified($this->arResult['ITEMS_TIMESTAMP_X']);
		}
	}

	protected function getElementList($iblockId, $products)
	{
		$elementIterator = parent::getElementList($iblockId, $products);

		if (
			!empty($elementIterator)
			&& (!isset($this->arParams['BY_LINK']) || $this->arParams['BY_LINK'] !== 'Y')
			&& !$this->arParams['SHOW_ALL_WO_SECTION']
			&& !$this->arParams['USE_MAIN_ELEMENT_SECTION']
		)
		{
			$elementIterator->SetSectionContext($this->arResult);
		}

		return $elementIterator;
	}

	protected function processElement(array &$element)
	{
		if ($this->arResult['ID'])
		{
			$element['IBLOCK_SECTION_ID'] = $this->arResult['ID'];
		}

		parent::processElement($element);
		$this->checkLastModified($element);
	}

	protected function checkLastModified($element)
	{
		if ($this->arParams['SET_LAST_MODIFIED'])
		{
			$time = DateTime::createFromUserTime($element['TIMESTAMP_X']);
			if (
				!isset($this->arResult['ITEMS_TIMESTAMP_X'])
				|| $time->getTimestamp() > $this->arResult['ITEMS_TIMESTAMP_X']->getTimestamp()
			)
			{
				$this->arResult['ITEMS_TIMESTAMP_X'] = $time;
			}
		}
	}

	protected function initElementList()
	{
		parent::initElementList();

		// Подсчитываем количество элементов через дополнительный запрос к БД
        $this->arResult['TOTAL_PRODUCTS_COUNT'] = \CIBlockElement::GetList(
            array(),
            array_merge($this->globalFilter, $this->filterFields + array('IBLOCK_ID' => $this->arParams['IBLOCK_ID'])),
            [],
            false,
            array('ID')
        );

		// compatibility for old components
		if ($this->isEnableCompatible() && empty($this->arResult['NAV_RESULT']))
		{
			$this->initNavString(\CIBlockElement::GetList(
				array(),
				array_merge($this->globalFilter, $this->filterFields + array('IBLOCK_ID' => $this->arParams['IBLOCK_ID'])),
				false,
				array('nTopCount' => 1),
				array('ID')
			));
			$this->arResult['NAV_RESULT']->NavNum = Main\Security\Random::getString(6);
		}

		$this->storage['sections'] = array();

		if (!empty($this->elements) && is_array($this->elements))
		{
			foreach ($this->elements as &$element)
			{
				$this->modifyItemPath($element);
			}
		}
	}

	protected function modifyItemPath(&$element)
	{
		$sections =& $this->storage['sections'];

		if (isset($this->arParams['BY_LINK']) && $this->arParams['BY_LINK'] === 'Y')
		{
			if (!isset($sections[$element['IBLOCK_SECTION_ID']]))
			{
				$sections[$element['IBLOCK_SECTION_ID']] = array();
				$pathIterator = CIBlockSection::GetNavChain(
					$element['IBLOCK_ID'],
					$element['IBLOCK_SECTION_ID'],
					array(
						'ID', 'CODE', 'XML_ID', 'EXTERNAL_ID', 'IBLOCK_ID',
						'IBLOCK_SECTION_ID', 'SORT', 'NAME', 'ACTIVE',
						'DEPTH_LEVEL', 'SECTION_PAGE_URL'
					)
				);
				$pathIterator->SetUrlTemplates('', $this->arParams['SECTION_URL']);
				while ($path = $pathIterator->GetNext())
				{
					$sections[$element['IBLOCK_SECTION_ID']][] = $path;
				}
			}

			$element['SECTION']['PATH'] = $sections[$element['IBLOCK_SECTION_ID']];
		}
		else
		{
			$element['SECTION']['PATH'] = array();
		}
	}

    protected function getIblockElements($elementIterator)
    {
        $iblockElements = array();

        if (!empty($elementIterator) && is_countable($elementIterator->arResult))
        {
            for ($i = 0; $i < count($elementIterator->arResult); $i++)
            {
                if (!empty($elementIterator->arSectionContext))
                {
                    $elementIterator->arSectionContext["ID"] = $elementIterator->arResult[$i]["IBLOCK_SECTION_ID"];
                }
                $element = $elementIterator->GetNext();
                if (empty($element))
                    break;
                $this->processElement($element);
                $iblockElements[$element['ID']] = $element;
            }
        }

        return $iblockElements;
    }

    protected function calculateItemPrices(array &$items)
    {
        if (empty($items))
            return;

        $enableCompatible = $this->isEnableCompatible();

        if ($enableCompatible)
            $this->initCompatibleFields($items);

        foreach (array_keys($items) as $index)
        {
            $id = $items[$index]['ID'];
            if (!isset($this->calculatePrices[$id]))
                continue;
            if (empty($this->prices[$id]))
                continue;
            $productPrices = $this->prices[$id];
            $result = array(
                'ITEM_PRICE_MODE' => null,
                'ITEM_PRICES' => array(),
                'ITEM_PRICES_CAN_BUY' => false
            );
            if ($this->arParams['FILL_ITEM_ALL_PRICES'])
                $result['ITEM_ALL_PRICES'] = array();
            $priceBlockIndex = 0;
            if (!empty($productPrices['QUANTITY']))
            {
                $result['ITEM_PRICE_MODE'] = ProductTable::PRICE_MODE_QUANTITY;
                $ratio = current($this->ratios[$id]);
                foreach ($this->quantityRanges[$id] as $range)
                {
                    $priceBlock = $this->calculatePriceBlock(
                        $items[$index],
                        $productPrices['QUANTITY'][$range['HASH']],
                        $ratio['RATIO'],
                        $this->arParams['USE_PRICE_COUNT'] || $this->checkQuantityRange($range)
                    );
                    if ($this->globalFilter['WITH_DISCOUNT'] == 'Y' && !$priceBlock['DISCOUNT'])
                    {
                        unset($this->elements[$id]);
                        unset($items[$index]);
                        continue;
                    }
                    if (!empty($priceBlock))
                    {
                        $minimalPrice = ($this->arParams['FILL_ITEM_ALL_PRICES']
                            ? $priceBlock['MINIMAL_PRICE']
                            : $priceBlock
                        );
                        if ($minimalPrice['QUANTITY_FROM'] === null)
                        {
                            $minimalPrice['MIN_QUANTITY'] = $ratio['RATIO'];
                        }
                        else
                        {
                            $minimalPrice['MIN_QUANTITY'] = $ratio['RATIO'] * ((int)($minimalPrice['QUANTITY_FROM']/$ratio['RATIO']));
                            if ($minimalPrice['MIN_QUANTITY'] < $minimalPrice['QUANTITY_FROM'])
                                $minimalPrice['MIN_QUANTITY'] += $ratio['RATIO'];
                        }
                        $result['ITEM_PRICES'][$priceBlockIndex] = $minimalPrice;
                        if (isset($this->storage['PRICES_CAN_BUY'][$minimalPrice['PRICE_TYPE_ID']]))
                            $result['ITEM_PRICES_CAN_BUY'] = true;
                        if ($this->arParams['FILL_ITEM_ALL_PRICES'])
                        {
                            $priceBlock['ALL_PRICES']['MIN_QUANTITY'] = $minimalPrice['MIN_QUANTITY'];
                            $result['ITEM_ALL_PRICES'][$priceBlockIndex] = $priceBlock['ALL_PRICES'];
                        }
                        unset($minimalPrice);
                        $priceBlockIndex++;
                    }
                    unset($priceBlock);
                }
                unset($range);
                unset($ratio);
            }
            if (!empty($productPrices['SIMPLE']))
            {
                $result['ITEM_PRICE_MODE'] = ProductTable::PRICE_MODE_SIMPLE;
                $ratio = current($this->ratios[$id]);
                $priceBlock = $this->calculatePriceBlock(
                    $items[$index],
                    $productPrices['SIMPLE'],
                    $ratio['RATIO'],
                    true
                );
                if ($this->globalFilter['WITH_DISCOUNT'] == 'Y' && !$priceBlock['DISCOUNT'])
                {
                    unset($this->elementLinks[$id - 2]);
                    $this->elements = array_filter($this->elements, function ($element) use ($id) {
                        return $element['ID'] !== $id - 2;
                    });
                    unset($items[$index]);
                    continue;
                }
                if (!empty($priceBlock))
                {
                    $minimalPrice = ($this->arParams['FILL_ITEM_ALL_PRICES']
                        ? $priceBlock['MINIMAL_PRICE']
                        : $priceBlock
                    );
                    $minimalPrice['MIN_QUANTITY'] = $ratio['RATIO'];
                    $result['ITEM_PRICES'][$priceBlockIndex] = $minimalPrice;
                    if (isset($this->storage['PRICES_CAN_BUY'][$minimalPrice['PRICE_TYPE_ID']]))
                        $result['ITEM_PRICES_CAN_BUY'] = true;
                    if ($this->arParams['FILL_ITEM_ALL_PRICES'])
                    {
                        $priceBlock['ALL_PRICES']['MIN_QUANTITY'] = $minimalPrice['MIN_QUANTITY'];
                        $result['ITEM_ALL_PRICES'][$priceBlockIndex] = $priceBlock['ALL_PRICES'];
                    }
                    unset($minimalPrice);
                    $priceBlockIndex++;
                }
                unset($priceBlock);
                unset($ratio);
            }
            $this->prices[$id] = $result;

            if (isset($items[$index]['ACTIVE']) && $items[$index]['ACTIVE'] === 'N')
            {
                $items[$index]['CAN_BUY'] = false;
            }
            else
            {
                $items[$index]['CAN_BUY'] = $result['ITEM_PRICES_CAN_BUY'] && $items[$index]['PRODUCT']['AVAILABLE'] === 'Y';
            }

            unset($priceBlockIndex, $result);
            unset($productPrices);

            if ($enableCompatible)
                $this->resortOldPrices($id);
        }
        unset($index);
    }

    private function resortOldPrices($id)
    {
        if (empty($this->oldData[$id]['PRICES'])  || !is_countable($this->oldData[$id]['PRICES']) || count($this->oldData[$id]['PRICES']) < 2)
            return;
        foreach (array_keys($this->oldData[$id]['PRICES']) as $priceCode)
            $this->oldData[$id]['PRICES'][$priceCode]['_SORT'] = $this->storage['PRICES'][$priceCode]['SORT'];
        unset($priceCode);
        Main\Type\Collection::sortByColumn(
            $this->oldData[$id]['PRICES'],
            array('_SORT' => SORT_ASC, 'PRICE_ID' => SORT_ASC),
            '', null, true
        );
        foreach (array_keys($this->oldData[$id]['PRICES']) as $priceCode)
            unset($this->oldData[$id]['PRICES'][$priceCode]['_SORT']);
        unset($priceCode);
    }
}