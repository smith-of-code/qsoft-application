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

        while ($zeroLevelMentors = $this->getZeroLevelMentors()) {
            $beneficiaries = $this->getBeneficiaries(
                $zeroLevelMentors,
                array_map(static fn ($mentor) => ['ID' => $mentor, 'MENTOR_ID' => null], $zeroLevelMentors)
            );

            $this->saveBeneficiaries($beneficiaries);
        }
    }

    protected function clearBeneficiaries()
    {
        Application::getConnection()->truncateTable('beneficiary');
    }

    protected function getZeroLevelMentors(): array
    {
        static $offset = 0;

        $mentors = UserTable::getList([
            'filter' => [
                '=ACTIVE' => true,
                '=BLOCKED' => false,
                '=PROPERTIES.UF_MENTOR_ID' => false,
            ],
            'select' => ['ID'],
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

        return array_map(static fn ($mentor) => $mentor['ID'], $mentors);
    }

    protected function getBeneficiaries(array $mentors, array $usersToMentors): array
    {
        $wards = $this->getWards($mentors);

        foreach ($wards as $ward) {
            /** array_merge is used to copy array as it's modified in foreach */
            foreach (array_merge($usersToMentors, []) as $userToMentor) {
                if ($userToMentor['MENTOR_ID'] !== null && $userToMentor['ID'] == $ward['MENTOR_ID']) {
                    $usersToMentors[] = [
                        'ID' => $ward['ID'],
                        'MENTOR_ID' => $userToMentor['MENTOR_ID'],
                    ];
                }
            }

            $usersToMentors[] = $ward;
        }

        if (!empty(array_pluck($wards, 'ID'))) {
            $usersToMentors = $this->getBeneficiaries(array_pluck($wards, 'ID'), $usersToMentors);
        }

        return $usersToMentors;
    }

    protected function getWards(array $mentors): array
    {
        return UserTable::getList([
            'filter' => [
                '=ACTIVE' => true,
                '=BLOCKED' => false,
                '=PROPERTIES.UF_MENTOR_ID' => $mentors,
            ],
            'select' => ['ID', 'MENTOR_ID' => 'PROPERTIES.UF_MENTOR_ID'],
            'runtime' => [
                new Reference(
                    'PROPERTIES',
                    UserPropertiesTable::class,
                    ['=this.ID' => 'ref.VALUE_ID']
                ),
            ],
        ])->fetchAll();
    }

    protected function saveBeneficiaries(array $beneficiaries)
    {
        BeneficiariesTable::addMulti(array_map(
            fn ($element) => ['UF_USER_ID' => $element['ID'], 'UF_BENEFICIARY_ID' => $element['MENTOR_ID']],
            $beneficiaries
        ));
    }
}