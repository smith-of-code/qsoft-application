<?php

namespace QSoft\Entity\Mutators;

use Carbon\Carbon;

class UserPropertiesMutator
{
    static public function readBirthday(?string $fieldValue): Carbon
    {
        return Carbon::createFromTimestamp(MakeTimeStamp($fieldValue));
    }

    static public function readPhoto(?string $fieldValue)
    {
        return $fieldValue ?? 0;
    }

    static public function readLoyaltyLevel(?string $fieldValue): string
    {
        return $fieldValue ?? '';
    }

    static public function readLoyaltyCheckDate(string $fieldValue): Carbon
    {
        return Carbon::createFromTimestamp(MakeTimeStamp($fieldValue));
    }
}