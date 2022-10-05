<?php

namespace QSoft\Migrate;

use Bitrix\Main\DB\Connection;
use Bitrix\Main\GroupTable;
use Bitrix\Main\Loader;
use CCatalogGroup;

class BaseCreatePriceMigration extends AbstractMigration
{
    protected array $userGroups = [];
    protected array $prices = [];

    public function __construct()
    {
        parent::__construct();
        $this->includeModules();
    }

    protected function onUp(Connection $connection): void
    {
        $userGroups = GroupTable::getList([
            'filter' => [
                '=STRING_ID' => $this->userGroups,
            ],
            'select' => ['ID'],
        ])->fetchAll();
        $userGroupsIds = array_column($userGroups, 'ID');

        foreach ($this->prices as $price) {
            CCatalogGroup::Add($price + [
                'USER_GROUP' => $userGroupsIds,
                'USER_GROUP_BUY' => $userGroupsIds,
            ]);
        }
    }

    protected function onDown(Connection $connection): void
    {
        $prices = CCatalogGroup::GetList([], [
            'XML_ID' => array_column($this->prices, 'XML_ID'),
        ]);

        while ($price = $prices->Fetch()) {
            CCatalogGroup::Delete($price['ID']);
        }
    }

    protected function includeModules()
    {
        if (!Loader::includeModule('catalog')) {
            throw new \RuntimeException('Не удалось загрузить модуль highloadblock');
        }
    }
}
