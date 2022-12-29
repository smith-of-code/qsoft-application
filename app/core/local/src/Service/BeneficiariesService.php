<?php

namespace QSoft\Service;

use QSoft\Entity\User;
use QSoft\ORM\BeneficiariesTable;

class BeneficiariesService
{
    private const TEAM_DEPTH = 2;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Возвращает ID всех участников команды консультанта
     * @param bool $onlyInvited - вернуть только напрямую приглашенных участников
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function getTeamIds($onlyInvited = false): array
    {
        if (!$this->user->groups->isConsultant()) {
            return [];
        }

        $result = [];
        $wardsIds = null;
        $depth = $onlyInvited ? 1 : self::TEAM_DEPTH;
        for ($i = 0; $i < $depth; $i++) {
            if (isset($wardsIds) && !count($wardsIds)) {
                continue;
            }
            $wardsIds = BeneficiariesTable::getWardsIds($wardsIds ?? $this->user->id);
            $result = array_merge($result, $wardsIds);
        }

        return $result;
    }

    /**
     * Возвращает ID всех получателей выгоды (вышестоящих наставников пользователя)
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function getBeneficiariesIds(): array
    {
        $result = [];
        $beneficiaryId = $this->user->mentorId;

        if (!$beneficiaryId) {
            return [];
        }

        for ($i = 0; $i < self::TEAM_DEPTH; $i++) {
            // Записываем текущего наставника, после чего получаем вышестоящего наставника
            $result[] = $beneficiaryId;
            $beneficiaryId = BeneficiariesTable::getBeneficiaryId($beneficiaryId);
        }

        return $result;
    }
}