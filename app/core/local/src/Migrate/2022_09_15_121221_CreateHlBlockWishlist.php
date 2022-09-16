<?php

use QSoft\Migrate\BaseCreateHighloadMigration;
use QSoft\Seeder\WishlistSeeder;

final class CreateHlBlockWishlist extends BaseCreateHighloadMigration
{
    protected ?string $seeder = WishlistSeeder::class;

    protected array $blockInfo = [
        'NAME'       => 'HlWishlist',
        'TABLE_NAME' => 'wishlist',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок избранных товаров',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_USER_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_USER_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Идентификатор пользователя'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Идентификатор пользователя'],
            'LIST_FILTER_LABEL' => ['ru' => 'Идентификатор пользователя'],
        ],
        [
            'FIELD_NAME' => 'UF_PRODUCT_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_PRODUCT_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Идентификатор товара'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Идентификатор товара'],
            'LIST_FILTER_LABEL' => ['ru' => 'Идентификатор товара'],
        ],
    ];
}
