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

    public function getTeamIds(): array
    {
        if (!$this->user->groups->isConsultant()) {
            return [];
        }

        $result = [];
        $wardsIds = null;
        for ($i = 0; $i < self::TEAM_DEPTH; $i++) {
            if (isset($wardsIds) && !count($wardsIds)) {
                continue;
            }
            $wardsIds = BeneficiariesTable::getWardsIds($wardsIds ?? $this->user->id);
            $result = array_merge($result, $wardsIds);
        }

        return $result;
    }

    public function getBeneficiariesIds(): array
    {
        $result = [];
        $beneficiaryId = $this->user->mentorId;

        if (!$beneficiaryId) {
            return [];
        }

        for ($i = 0; $i < self::TEAM_DEPTH; $i++) {
            if (!$beneficiaryId) {
                continue;
            }
            $result[] = $beneficiaryId;
            $beneficiaryId = BeneficiariesTable::getBeneficiaryId($beneficiaryId);
        }

        return $result;
    }
}