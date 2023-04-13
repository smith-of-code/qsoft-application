<?php

use QSoft\Migrate\BaseCreateHighloadMigration;
use QSoft\Seeder\PetSeeder;

final class CreateHlBlockBreedDog extends BaseCreateHighloadMigration
{
    protected ?string $seeder = PetSeeder::class;

    protected array $blockInfo = [
        'NAME'       => 'HLBreedDog',
        'TABLE_NAME' => 'breed_dog',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок пород собак',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_BREED_DOG',
            'USER_TYPE_ID' => 'string',
            'MULTIPLE' => 'N',
            'XML_ID' => 'UF_BREED_DOG',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Порода питомца'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Порода питомца'],
            'LIST_FILTER_LABEL' => ['ru' => 'Порода питомца'],
        ]
    ];
}
