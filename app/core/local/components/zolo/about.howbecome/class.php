<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)  die();

use QSoft\Entity\User;
use QSoft\Helper\FileHelper;
use QSoft\ORM\DocumentsTable;

class AboutHowbecomeComponent extends CBitrixComponent
{
    public const BLOCK = 'Как стать консультантом';

    private User $user;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->user = new User;
    }

    public function executeComponent(): void
    {
        if ($this->user->groups->isConsultant()) {
            return;
        }

        $document = DocumentsTable::getRow([
            'filter' => [
                '=UF_NAME' => self::BLOCK,
            ],
        ]);

        $this->arResult['is_authorized'] = $this->user->isAuthorized;

        if ($document['UF_DOCUMENT']) {
            $this->arResult['title'] = $document['UF_NAME'];
            $this->arResult['documents'] = array_map(
                static fn(int $fileId): array => FileHelper::getFileArray($fileId),
                unserialize($document['UF_DOCUMENT'])
            );
            $this->includeComponentTemplate();
        }
    }
}
