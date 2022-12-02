<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)  die();

use QSoft\Helper\FileHelper;
use QSoft\Helper\HlBlockHelper;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\DocumentsTable;

class AboutInfoComponent extends CBitrixComponent
{
    public const BLOCKS = [
        DocumentsTable::NAMES['general_rules'],
        DocumentsTable::NAMES['clients'],
        DocumentsTable::NAMES['self_employed'],
        DocumentsTable::NAMES['ip'],
        DocumentsTable::NAMES['ltc'],
    ];

    public function executeComponent(): void
    {
        $documents = DocumentsTable::getList([
            'filter' => [
                '=UF_NAME' => array_map(static fn ($block) => EnumDecorator::prepareField('UF_NAME', $block),self::BLOCKS),
            ],
        ]);

        $names = HlBlockHelper::getPreparedEnumFieldValues(DocumentsTable::getTableName(), 'UF_NAME');
        foreach ($documents as $document) {
            if ($document['UF_DOCUMENT']) {
                $this->arResult[$names[$document['UF_NAME']]['name']] = array_map(
                    static fn(int $fileId): array => FileHelper::getFileArray($fileId),
                    unserialize($document['UF_DOCUMENT'])
                );
            }
        }

        if ($this->arResult) {
            $this->includeComponentTemplate();
        }
    }
}
