<?php

use QSoft\Migrate\Traits\AddUserFieldsTrait;
use QSoft\Migration\Migration;

class AddFieldsForUsers extends Migration
{
    use AddUserFieldsTrait;

    private string $entity = 'USER';

    private array $userFields = [
        [
            'ENTITY_ID' => 'USER',
            'FIELD_NAME' => 'UF_AGREE_WITH_PERSONAL_DATA_PROCESSING',
            'USER_TYPE_ID' => 'boolean',
            'XML_ID' => '',
            'SORT' => '500',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'Y',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => '',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' => [
                'DEFAULT_VALUE' => '1',
            ],
            'EDIT_FORM_LABEL' => [
                'ru' => 'Согласен на обработку персональных данных',
                'en' => 'Agree to the processing of personal data',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'Согласен на обработку персональных данных',
                'en' => 'Agree to the processing of personal data',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'Согласен на обработку персональных данных',
                'en' => 'Agree to the processing of personal data',
            ],
        ],
        [
            'ENTITY_ID' => 'USER',
            'FIELD_NAME' => 'UF_AGREE_WITH_TERMS_OF_USE',
            'USER_TYPE_ID' => 'boolean',
            'XML_ID' => '',
            'SORT' => '500',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'Y',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => '',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' => [
                'DEFAULT_VALUE' => '1',
            ],
            'EDIT_FORM_LABEL' => [
                'ru' => 'Согласен с условиями пользования сайтом',
                'en' => 'Agree to the terms of use of the site',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'Согласен с условиями пользования сайтом',
                'en' => 'Agree to the terms of use of the site',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'Согласен с условиями пользования сайтом',
                'en'=> 'Agree to the terms of use of the site',
            ],
        ],
        [
            'ENTITY_ID' => 'USER',
            'FIELD_NAME' => 'UF_AGREE_WITH_COMPANY_RULES',
            'USER_TYPE_ID' => 'boolean',
            'XML_ID' => '',
            'SORT' => '500',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => '',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' => [
                'DEFAULT_VALUE' => '1',
            ],
            'EDIT_FORM_LABEL' => [
                'ru' => 'Согласен с правилами компании',
                'en' => 'Agree with company rules',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'Согласен с правилами компании',
                'en' => 'Agree with company rules',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'Согласен с правилами компании',
                'en' => 'Agree with company rules',
            ],
        ],
        [
            'ENTITY_ID' => 'USER',
            'FIELD_NAME' => 'UF_AGREE_TO_RECEIVE_INFORMATION_ABOUT_PROMOTIONS',
            'USER_TYPE_ID' => 'boolean',
            'XML_ID' => '',
            'SORT' => '500',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => '',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' => [
                'DEFAULT_VALUE' => '1',
            ],
            'EDIT_FORM_LABEL' => [
                'ru' => 'Согласен на получение информации о продуктах, спецпредложениях и акциях',
                'en' => 'Agree to receive information about products, special offers and promotions',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'Согласен на получение информации о продуктах, спецпредложениях и акциях',
                'en' => 'Agree to receive information about products, special offers and promotions',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'Согласен на получение информации о продуктах, спецпредложениях и акциях',
                'en' => 'Agree to receive information about products, special offers and promotions',
            ],
        ],
        [
            'ENTITY_ID' => 'USER',
            'FIELD_NAME' => 'UF_MENTOR_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => '',
            'SORT' => '500',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'Y',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => '',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' => [
                'DEFAULT_VALUE' => 0,
            ],
            'EDIT_FORM_LABEL' => [
                'ru' => 'ID наставника',
                'en' => 'Mentor ID',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'ID наставника',
                'en' => 'Mentor ID',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'ID наставника',
                'en' => 'Mentor ID',
            ],
        ],
        [
            'ENTITY_ID' => 'USER',
            'FIELD_NAME' => 'UF_LOYALTY_CHECK_DATE',
            'USER_TYPE_ID' => 'date',
            'XML_ID' => '',
            'SORT' => '500',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => '',
            'IS_SEARCHABLE' => 'N',
            'EDIT_FORM_LABEL' => [
                'ru' => 'Дата проверки условий поддержания уровня программы лояльности',
                'en' => 'Date of checking the conditions for maintaining the level of the loyalty program',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'Дата проверки условий поддержания уровня программы лояльности',
                'en' => 'Date of checking the conditions for maintaining the level of the loyalty program',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'Дата проверки условий поддержания уровня программы лояльности',
                'en' => 'Date of checking the conditions for maintaining the level of the loyalty program',
            ],
        ],
        [
            'ENTITY_ID' => 'USER',
            'FIELD_NAME' => 'UF_BONUS_POINTS',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => '',
            'SORT' => '500',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => '',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' => [
                'DEFAULT_VALUE' => 0,
            ],
            'EDIT_FORM_LABEL' => [
                'ru' => 'Бонусные баллы',
                'en' => 'Bonus points',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'Бонусные баллы',
                'en' => 'Bonus points',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'Бонусные баллы',
                'en' => 'Bonus points',
            ],
        ],
    ];
}