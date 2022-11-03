<?php

namespace QSoft\Helper;

use QSoft\Entity\User;
use QSoft\ORM\BaseTable;
use QSoft\ORM\PetTable;

class PetHelper
{
    public function getBreeds(): array
    {
        $result = [];
        foreach ($this->getKinds() as $id => $kind) {
            $kindName = ucfirst(str_replace('kind_', '', strtolower($kind['code'])));
            /** @var BaseTable $class */
            $class = "\\QSoft\\ORM\\{$kindName}BreedTable";
            $breedValues = $class::getList()->fetchAll();
            $result[$kind['code']] = array_combine(
                array_column($breedValues, 'ID'),
                array_map(static fn(array $value): array => [
                    'id' => $value['ID'],
                    'name' => $value['UF_BREED_' . strtoupper($kindName)],
                ], $breedValues),
            );
        }
        return $result;
    }

    public function getKinds(): array
    {
        return HlBlockHelper::getPreparedEnumFieldValues(PetTable::getTableName(), 'UF_KIND');
    }

    public function getGenders(): array
    {
        return HlBlockHelper::getPreparedEnumFieldValues(PetTable::getTableName(), 'UF_GENDER');
    }

    public function getUserPets(int $userId): array
    {
        $user = new User($userId);
        $kinds = $this->getKinds();
        $breeds = $this->getBreeds();
        $genders = $this->getGenders();

        $pets = [];
        foreach ($user->pets->getAll() as $pet) {
            $pets[$pet['ID']] = [
                'id' => $pet['ID'],
                'name' => $pet['UF_NAME'],
                'kind' => $kinds[$pet['UF_KIND']],
                'breed' => $breeds[$kinds[$pet['UF_KIND']]['code']][$pet['UF_BREED']] ?? ['name' => 'Нет породы'],
                'gender' => $genders[$pet['UF_GENDER']],
                'birthdate' => $pet['UF_BIRTHDATE'],
            ];
        }
        return $pets;
    }
}