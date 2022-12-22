<?php

namespace QSoft\Queue\Jobs;

use QSoft\ORM\BeneficiariesTable;

class BeneficiaryChangeJob extends BaseJob
{
    public function __construct()
    {
    }

    protected function getQueueName(): string
    {
        return 'beneficiary-change';
    }

    protected function process($data)
    {
        // Нужные подчиненные, то есть подчиненные пользователя и сам пользователь
        $wards = array_merge(BeneficiariesTable::getUserWards($data['userId']), [$data['userId']]);
        // Старые бенефициары пользователя, то есть старый наставник и бенефициары старого наставника
        $oldUserBeneficiaries = array_merge(BeneficiariesTable::getUserBeneficiaries($data['oldMentorId']), [$data['oldMentorId']]);
        // Новые бенефициары пользователя, то есть новый наставник и бенефициары нового наставника
        $newUserBeneficiaries = array_merge(BeneficiariesTable::getUserBeneficiaries($data['newMentorId']), [$data['newMentorId']]);

        // Двойной фильтр, чтобы не стереть связи между друг другом у $wards
        $oldRelations = BeneficiariesTable::getList([
            'filter' => [
                '=UF_USER_ID' => $wards,
                '=UF_BENEFICIARY_ID' => $oldUserBeneficiaries,
            ],
            'select' => ['ID'],
        ]);

        foreach ($oldRelations as $oldRelation) {
            BeneficiariesTable::delete($oldRelation['ID']);
        }

        $newRelations = [];
        foreach ($newUserBeneficiaries as $newUserBeneficiary) {
            foreach ($wards as $ward) {
                $newRelations[] = [
                    'UF_USER_ID' => $ward,
                    'UF_BENEFICIARY_ID' => $newUserBeneficiary,
                ];
            }
        }
        BeneficiariesTable::addMulti($newRelations);
    }

    protected function validateInputData($data): bool
    {
        return is_array($data) && !empty($data['userId']) && !empty($data['newMentorId']);
    }
}
