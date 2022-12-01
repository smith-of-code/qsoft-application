<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)  die();

use QSoft\Helper\FileHelper;
use QSoft\ORM\DocumentsTable;

class AboutCertComponent extends CBitrixComponent
{
    public const BLOCK = 'Сертификаты, подтверждающие качество нашей продукции';

    public function executeComponent(): void
    {
        $document = DocumentsTable::getRow([
            'filter' => [
                '=UF_NAME' => self::BLOCK,
            ],
        ]);

        if ($document['UF_DOCUMENT']) {
            $this->arResult = [
                'title' => $document['UF_NAME'],
                'documents' => array_map(
                    static fn(int $fileId): array => FileHelper::getFileArray($fileId),
                    unserialize($document['UF_DOCUMENT'])
                ),
            ];
            $this->includeComponentTemplate();
        }
    }
}
