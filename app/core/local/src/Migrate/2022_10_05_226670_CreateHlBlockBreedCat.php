<?php

use QSoft\Migrate\BaseCreateHighloadMigration;
use QSoft\Seeder\PetSeeder;

final class CreateHlBlockBreedCat extends BaseCreateHighloadMigration
{
    protected ?string $seeder = PetSeeder::class;

    protected array $blockInfo = [
        'NAME'       => 'HLBreedCat',
        'TABLE_NAME' => 'breed_cat',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок пород кошек',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_BREED_CAT',
            'USER_TYPE_ID' => 'string',
            'MULTIPLE' => 'N',
            'XML_ID' => 'UF_BREED_CAT',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Порода питомца'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Порода питомца'],
            'LIST_FILTER_LABEL' => ['ru' => 'Порода питомца'],
        ]
    ];
}
