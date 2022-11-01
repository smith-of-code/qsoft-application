<?php

namespace QSoft\Entity\Mutators;

use Carbon\Carbon;

class UserPropertiesMutator
{
    public function readBirthday(?string $fieldValue): Carbon
    {
        return Carbon::createFromTimestamp(MakeTimeStamp($fieldValue));
    }

    public function readPhoto(?string $fieldValue)
    {
        return $fieldValue ?? 0;
    }

    public function readLoyaltyLevel(?string $fieldValue): string
    {
        return $fieldValue ?? '';
    }

    public function readLoyaltyCheckDate(string $fieldValue): Carbon
    {
        return Carbon::createFromTimestamp(MakeTimeStamp($fieldValue));
    }
}