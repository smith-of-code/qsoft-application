<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)  die();

use QSoft\Helper\FileHelper;
use QSoft\ORM\DocumentsTable;

class AboutInfoComponent extends CBitrixComponent
{
    public const BLOCKS = [
        'Общие условия и правила',
        'Правила и условия для клиентов',
        'Правила и условия для самозанятых',
        'Правила и условия для ИП',
        'Правила и условия для ООО',
    ];

    public function executeComponent(): void
    {
        $documents = DocumentsTable::getList([
            'filter' => [
                '=UF_NAME' => self::BLOCKS
            ],
        ]);

        foreach ($documents as $document) {
            if ($document['UF_DOCUMENT']) {
                $this->arResult[$document['UF_NAME']] = array_map(
                    static fn(int $fileId): array => FileHelper::getFileArray($fileId),
                    unserialize($document['UF_DOCUMENT'])
                );
            }
        }

        $this->includeComponentTemplate();
    }
}
