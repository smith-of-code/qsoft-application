<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)  die();

use QSoft\Helper\FileHelper;
use QSoft\Helper\HlBlockHelper;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\DocumentsTable;

class AboutCertComponent extends CBitrixComponent
{
    public function executeComponent(): void
    {
        $document = DocumentsTable::getRow([
            'filter' => [
                '=UF_NAME' => EnumDecorator::prepareField('UF_NAME', DocumentsTable::NAMES['cert']),
            ],
        ]);

        $names = HlBlockHelper::getPreparedEnumFieldValues(DocumentsTable::getTableName(), 'UF_NAME');
        if ($document['UF_DOCUMENT']) {
            $this->arResult = [
                'title' => $names[$document['UF_NAME']]['name'],
                'documents' => array_map(
                    static fn(int $fileId): array => FileHelper::getFileArray($fileId),
                    unserialize($document['UF_DOCUMENT'])
                ),
            ];
            $this->includeComponentTemplate();
        }
    }
}