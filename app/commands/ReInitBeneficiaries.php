<?php

namespace QSoft\Commands;

use Bitrix\Main\Application;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\UserTable;
use Illuminate\Console\Command;
use QSoft\ORM\BeneficiariesTable;
use QSoft\ORM\UserPropertiesTable;

class ReInitBeneficiaries extends Command
{
    private const USERS_SELECT_BATCH_SIZE = 50;

    protected $description = 'Очищает и заново заполняет таблицу beneficiary. Использовать только в крайних случаях';
    protected $signature = 'beneficiaries:recollect';

    public function handle()
    {
        $this->clearBeneficiaries();
        while ($users = $this->batchUsers()) {
            $this->saveBeneficiaries($users);
        }
    }

    protected function clearBeneficiaries()
    {
        Application::getConnection()->truncateTable(BeneficiariesTable::getTableName());
    }

    protected function batchUsers(): array
    {
        static $offset = 0;

        $users = UserTable::getList([
            'filter' => [
                '=ACTIVE' => true,
                '=BLOCKED' => false,
                '!=PROPERTIES.UF_MENTOR_ID' => false,
            ],
            'select' => ['UF_USER_ID' => 'ID', 'UF_BENEFICIARY_ID' => 'PROPERTIES.UF_MENTOR_ID'],
            'limit' => self::USERS_SELECT_BATCH_SIZE,
            'offset' => $offset,
            'runtime' => [
                new Reference(
                    'PROPERTIES',
                    UserPropertiesTable::class,
                    ['=this.ID' => 'ref.VALUE_ID']
                ),
            ]
        ])->fetchAll();

        $offset += self::USERS_SELECT_BATCH_SIZE;

        return $users;
    }

    protected function saveBeneficiaries(array $beneficiaries): void
    {
        BeneficiariesTable::addMulti($beneficiaries);
    }
}