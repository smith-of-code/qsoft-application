<?php

namespace QSoft\Entity;

use CFile;
use CUser;
use CUserFieldEnum;

class User
{
    /**
     * @var int ID пользователя
     */
    public $id;
    /**
     * @var string Логин
     */
    public $login;
    /**
     * @var string Флаг активности (Y|N)
     */
    public $active;
    /**
     * @var string Имя
     */
    public $name;
    /**
     * @var string Фамилия
     */
    public $last_name;
    /**
     * @var string Отчество
     */
    public $second_name;
    /**
     * @var string E-mail
     */
    public $email;
    /**
     * @var string Номер телефона
     */
    public $phone;
    /**
     * @var string Пол
     */
    public $gender;
    /**
     * @var string Дата рождения
     */
    public $birthday;
    /**
     * @var int Фотография (URL)
     */
    public $photo;


    /**
     * @var string Согласен на использование персональных данных (Y|N)
     */
    public $agree_with_personal_data_processing;
    /**
     * @var string Согласен с условиями пользования сайтом (Y|N)
     */
    public $agree_with_terms_of_use;
    /**
     * @var string Согласен с правилами компании (Y|N)
     */
    public $agree_with_company_rules;
    /**
     * @var string Согласен на получение информации о продуктах, спецпредложениях и акциях (Y|N)
     */
    public $agree_to_receive_information_about_promotions;
    /**
     * @var int ID наставника
     */
    public $mentor_id;
    /**
     * @var string Уровень в программе лояльности
     */
    public $loyalty_level;
    /**
     * @var int Бонусные баллы
     */
    public $bonus_points;
    /**
     * @var string Дата проверки условий поддержания уровня программы лояльности
     */
    public $loyalty_check_date;

    /**
     * @var array Массив ID групп, в которых состоит пользователь
     */
    private $user_groups;

    /**
     * Коды пользовательских полей типа "Список"
     */
    private const ENUM_PROPERTIES = [
        'UF_LOYALTY_LEVEL',
    ];
    private const USER_GROUP_ID_CONSULTANT = 9;
    private const USER_GROUP_ID_CUSTOMER = 10;

    /**
     * User constructor.
     * @param int $userId ID пользователя
     */
    public function __construct(int $userId)
    {
        // Получаем поля и свойства пользователя
        $user = CUser::GetByID($userId);
        if (!$user || !$user = $user->fetch()) {
            throw new RuntimeException('User not found');
        }

        // Для пользовательских полей типа "Список" получаем установленное значение
        foreach (self::ENUM_PROPERTIES as $enumProperty) {
            if ($user[$enumProperty]) {
                $user[$enumProperty] = CUserFieldEnum::GetList([], ['ID' => $user[$enumProperty]])->fetch()['VALUE'];
            }
        }

        // Задаем параметры объекта пользователя
        foreach ($user as $key => $value) {
            // Стандартные поля
            $this->id = $user['ID'];
            $this->login = $user['LOGIN'];
            $this->active = $user['ACTIVE'];
            $this->name = $user['NAME'];
            $this->last_name = $user['LAST_NAME'];
            $this->second_name = $user['SECOND_NAME'];
            $this->email = $user['EMAIL'];
            $this->phone = $user['PERSONAL_PHONE'];
            $this->gender = $user['PERSONAL_GENDER'];
            $this->birthday = $user['PERSONAL_BIRTHDAY'];
            $this->photo = CFile::GetPath($user['PERSONAL_PHOTO']);
            // Пользовательские поля
            $this->agree_with_personal_data_processing = $user['UF_AGREE_WITH_PERSONAL_DATA_PROCESSING'];
            $this->agree_with_terms_of_use = $user['UF_AGREE_WITH_TERMS_OF_USE'];
            $this->agree_with_company_rules = $user['UF_AGREE_WITH_COMPANY_RULES'];
            $this->agree_to_receive_information_about_promotions = $user['UF_AGREE_TO_RECEIVE_INFORMATION_ABOUT_PROMOTIONS'];
            $this->mentor_id = $user['UF_MENTOR_ID'];
            $this->loyalty_level = $user['UF_LOYALTY_LEVEL'];
            $this->bonus_points = $user['UF_BONUS_POINTS'];
            $this->loyalty_check_date = $user['UF_LOYALTY_CHECK_DATE'];
        }
    }

    /**
     * @return array Массив идентификаторов групп, к которым принадлежит пользователь
     */
    private function getUserGroups($forceUpdate = false): array
    {
        if (! isset($this->user_groups) || $forceUpdate) {
            $this->user_groups = CUser::GetUserGroup($this->id);
        }
        return $this->user_groups;
    }

    /**
     * Является ли пользователь Консультантом
     * @return bool
     */
    public function isConsultant(): bool
    {
        return in_array(self::USER_GROUP_ID_CONSULTANT, $this->getUserGroups());
    }

    /**
     * Является ли пользователь Покупателем
     * @return bool
     */
    public function isCustomer(): bool
    {
        return in_array(self::USER_GROUP_ID_CUSTOMER, $this->getUserGroups());
    }
}