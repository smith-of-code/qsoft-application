<?php

namespace QSoft\Entity\Mutators;

use Carbon\Carbon;

class UserPropertiesMutator
{
    public static function readBirthday(?string $fieldValue): Carbon
    {
        return Carbon::createFromTimestamp(MakeTimeStamp($fieldValue));
    }

    public static function readPhoto(?string $fieldValue)
    {
        return $fieldValue ?? 0;
    }

    public static function readLoyaltyLevel(?string $fieldValue): string
    {
        return $fieldValue ?? '';
    }

    public static function readLoyaltyCheckDate(string $fieldValue): Carbon
    {
        return Carbon::createFromTimestamp(MakeTimeStamp($fieldValue));
    }
}