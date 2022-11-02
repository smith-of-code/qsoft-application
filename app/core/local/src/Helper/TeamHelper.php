<?php

namespace QSoft\Helper;

use Bitrix\Main\Type\DateTime;
use Bitrix\Highloadblock\HighloadBlockTable;
use QSoft\Entity\User;
use QSoft\Helper\UserFieldHelper;
use QSoft\ORM\TeamTable;
use QSoft\ORM\TransactionTable;
use RuntimeException;

class TeamHelper
{

    public function getUserTeam(int $userId): array
    {
        $team = TeamTable::getList([]);
    }
}