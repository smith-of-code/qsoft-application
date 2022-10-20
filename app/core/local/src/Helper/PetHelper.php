<?php

namespace QSoft\Helper;

use QSoft\ORM\BaseTable;
use QSoft\ORM\PetTable;

class PetHelper
{
    public function getBreeds(): array
    {
        $result = [];
        foreach ($this->getKinds() as $code => $kind) {
            $kindName = ucfirst(str_replace('kind_', '', strtolower($code)));
            /** @var BaseTable $class */
            $class = "\\QSoft\\ORM\\{$kindName}BreedTable";
            $breedValues = $class::getList()->fetchAll();
                $result[$code] = array_combine(
                    array_column($breedValues, 'ID'),
                    array_column($breedValues, 'UF_BREED_' . strtoupper($kindName)),
                );
        }
        return $result;
    }

    public function getKinds(): array
    {
        $kinds = HlBlockHelper::getEnumFieldValues(PetTable::getTableName(), 'UF_KIND');

        return array_combine(array_column($kinds, 'XML_ID'), array_column($kinds, 'VALUE'));
    }
}