<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)  die();

use QSoft\Entity\User;
use QSoft\Helper\FileHelper;
use QSoft\Helper\HlBlockHelper;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\DocumentsTable;

class AboutHowbecomeComponent extends CBitrixComponent
{
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

        $documents = DocumentsTable::getList([
            'filter' => [
                '=UF_NAME' => [
                    EnumDecorator::prepareField('UF_NAME', DocumentsTable::NAMES['market_plan']),
                    EnumDecorator::prepareField('UF_NAME', DocumentsTable::NAMES['consultants_list']),
                ],
            ],
        ]);

        $this->arResult['is_authorized'] = $this->user->isAuthorized;

        $names = HlBlockHelper::getPreparedEnumFieldValues(DocumentsTable::getTableName(), 'UF_NAME');
        foreach ($documents as $document) {
            if ($document['UF_DOCUMENT']) {
                $this->arResult['documents'][] = [
                    'title' => $names[$document['UF_NAME']]['name'],
                    'document' => FileHelper::getFileArray(unserialize($document['UF_DOCUMENT'])[0]),
                ];
            }
        }

        if ($this->arResult['documents']) {
            $this->includeComponentTemplate();
        }
    }
}
