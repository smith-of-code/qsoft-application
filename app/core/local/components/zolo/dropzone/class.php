<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Context;
use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\HttpRequest;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;

class DropzoneComponent extends CBitrixComponent implements Controllerable
{
    private HttpRequest $myRequest;
    private array $arRequest;

    public function onPrepareComponentParams($arParams): array
    {
        $arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
        if (!$arParams['NAME']) {
            $arParams['NAME'] = 'file';
        }
        if (!$arParams['FILES']) {
            $arParams['FILES'] = [];
        }
        return $arParams;
    }

    public function __construct($component = null)
    {
        $this->myRequest = Context::getCurrent()->getRequest();
        $this->arRequest = $this->myRequest->getPostList()->toArray();

        parent::__construct($component);
    }

    public function executeComponent()
    {
        try {
            $this->checkModules();

            if (is_numeric($this->arParams['IBLOCK_ID']) && !empty($this->arParams['PROPERTY_CODE'])) {
                $this->getIBProperty();
                if (!empty($this->arResult['FIELD_TYPES']['FILE_TYPE'])) {
                    $this->getImageFileTypes();
                }
            }

            if ($this->myRequest->isAjaxRequest() && !empty($this->myRequest->getFileList())) {
                $this->getUploadFileID();
            }

            if (!empty($this->arRequest['DEL_FILE_ID']) && intval($this->arRequest['DEL_FILE_ID']) > 0) {
                $this->deleteFile($this->arRequest['DEL_FILE_ID']);
            }

            $this->IncludeComponentTemplate();
        } catch (SystemException|\Throwable $e) {
            global $APPLICATION;
            $APPLICATION->RestartBuffer();
            echo json_encode(['test' => $e->getMessage()]);
            die();
            ShowError($e->getMessage());
        }
    }

    public function checkModules()
    {
        if (!Loader::includeModule('iblock')) {
            throw new SystemException(Loc::getMessage('CPS_MODULE_NOT_INSTALLED', ['#NAME#' => 'iblock']));
        }
        if (!Loader::includeModule('im')) {
            throw new SystemException(Loc::getMessage('CPS_MODULE_NOT_INSTALLED', ['#NAME#' => 'im']));
        }
    }

    public function getUploadFileID($path = null)
    {
        global $APPLICATION;

        $arFile = $this->myRequest->getFile($this->arParams['NAME']);

        if (!empty($arFile)) {
            $fid = CFile::SaveFile($arFile, 'dropzone');

            $APPLICATION->RestartBuffer();
            echo json_encode(['FILE_ID' => $fid, 'FILE_SRC' => CFile::GetPath($fid)]);
            die();
        }
    }

    public function deleteFile($fileID)
    {
        global $APPLICATION;

        $fileID = intval($fileID);
        CFile::Delete($fileID);

        $APPLICATION->RestartBuffer();
        echo json_encode(['FILE_DELETED' => $fileID]);
        die();
    }

    public function getIBProperty()
    {
        $code = $this->arParams['PROPERTY_CODE'];
        $property = CIBlockProperty::GetList(['sort' => 'asc'], [
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'CODE' => $code,
        ]);
        $this->arResult['FIELD_TYPES'] = $property->GetNext();
    }

    public function getImageFileTypes()
    {
        $ar = explode(',', $this->arResult['FIELD_TYPES']['FILE_TYPE']);
        $types = [];
        foreach ($ar as $item) {
            $types[] = '.' . trim($item);
        }
        $types = implode(', ', $types);
        $this->arResult['DROPZONE_JS_TYPES'] = $types;
    }

    public function configureActions(): array
    {
        return [
            'upload' => [
                '-prefilters' => [
                    Csrf::class,
                ],
            ],
            'delete' => [
                '-prefilters' => [
                    Csrf::class,
                ],
            ],
        ];
    }

    public function uploadAction(): array
    {
        $result = [];
        $files = Context::getCurrent()->getRequest()->getFileList()->toArray();
        foreach ($files as $file) {
            $fileId = CFile::SaveFile($file, 'dropzone');
            $result[] = [
                'id' => $fileId,
                'name' => $file['name'],
                'format' => explode('/', strtoupper($file['type']))[1],
                'size' => filesizeFormat($file['size']),
                'src' => CFile::GetPath($fileId),
            ];
        }
        return $result;
    }

    public function deleteAction(int $id): void
    {
        CFile::Delete($id);
    }
}
