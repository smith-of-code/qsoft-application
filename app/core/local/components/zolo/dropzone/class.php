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

        if (! $arParams['NAME']) {
            $arParams['NAME'] = 'file';
        }

        if (! $arParams['ALLOWABLE_FORMATS']) {
            $arParams['ALLOWABLE_FORMATS'] = 'pdf, jpg, jpeg, png';
        }
        $arParams['ALLOWABLE_FORMATS'] = explode(',', strtolower(preg_replace('/\s+/', '', $arParams['ALLOWABLE_FORMATS'])));

        if (! $arParams['MAX_FILE_SIZE']) {
            $arParams['MAX_FILE_SIZE'] = 5242880; // 5 Мб
        }
        $arParams['MAX_FILE_SIZE'] = intval($arParams['MAX_FILE_SIZE']);

        if (! $arParams['MAX_FILES']) {
            $arParams['MAX_FILES'] = 10; // не более 10 файлов
        }

        if (! $arParams['FILES']) {
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
            echo json_encode(['error' => $e->getMessage()]);
            die();
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
                    Authentication::class,
                ],
            ],
            'delete' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ],
            ],
        ];
    }

    public function uploadAction(): array
    {
        $result = [];
        $files = Context::getCurrent()->getRequest()->getFileList()->toArray();
        foreach ($files as $file) {

            if (isset($error)) {
                unset($error);
            }

            // Валидация формата файла
            $extension = $this->getFormat($file);
            if (! isset($extension) || ! in_array(strtolower($extension), $this->arParams['ALLOWABLE_FORMATS'], true)) {
                continue; // Пропускаем файл
            }

            // Валидация размера файла
            if (! isset($file['size']) || intval($file['size']) <= 0 || intval($file['size']) > $this->arParams['MAX_FILE_SIZE']) {
                $error = 'Размер вложения превышает допустимый предел';
            }

            if (! isset($error)) {
                $fileId = CFile::SaveFile($file, 'dropzone');
            }
            $resultFileProps = [
                'id' => $fileId ?? 0,
                'name' => $file['name'],
                'format' => $extension,
                'size' => filesizeFormat($file['size'])
            ];
            if (isset($fileId) && $fileId > 0) {
                $resultFileProps['src'] = CFile::GetPath($fileId) ?? '';
            }
            if (isset($error)) {
                $resultFileProps['error'] = $error;
            }
            $result[] = $resultFileProps;
        }
        return $result;
    }

    /**
     * @param $file array массив, содержащий информацию о файле (название, MIME-тип)
     * @return string|null формат файла (пример: "PDF")
     */
    public function getFormat($file) : ?string
    {
        $extension = '';
        if ($file['type']) {
            $extension = explode('/', strtoupper($file['type']))[1];
        }
        if (! $extension || empty($extension) || $extension === 'OCTET-STREAM') {
            // Получим формат по расширению в имени файла
            if (isset($file['name']) && ! empty($file['name'])) {
                $splittedName = explode('.', $file['name']);
                if (is_array($splittedName)) $extension = last($splittedName);
                else $extension = null;
            } else {
                $extension = null;
            }
        }
        return $extension;
    }

    public function deleteAction(int $id): void
    {
        CFile::Delete($id);
    }
}
