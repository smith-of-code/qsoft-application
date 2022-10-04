<?php

namespace QSoft\Entity;

use CFile;
use CUser;
use CUserFieldEnum;
use QSoft\Service\BonusAccountService;
use QSoft\Service\LoyaltyService;
use QSoft\Service\UserGroupsService;
use RuntimeException;

class User
{
    /**
     * @var CUser Объект пользователя Битрикса
     */
    private CUser $c_user;
    /**
     * @var BonusAccountService Объект для работы с бонусным счетом пользователя
     */
    public BonusAccountService $bonusAccountService;
    /**
     * @var LoyaltyService Объект для работы с программой лояльности
     */
    public LoyaltyService $loyaltyService;
    /**
     * @var UserGroupsService Объект для работы с бонусным счетом пользователя
     */
    public UserGroupsService $userGroupsService;

    /**
     * @var int ID пользователя
     */
    public $id;
    /**
     * @var string Логин (он же номер телефона)
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
     * @var int Бонусные баллы
     */
    public $bonus_points;
    /**
     * @var string Дата проверки условий поддержания уровня программы лояльности
     */
    public $loyalty_check_date;

    /**
     * Коды пользовательских полей типа "Список"
     */
    private const ENUM_PROPERTIES = [];

    /**
     * User constructor.
     * @param int $userId ID пользователя
     * @throws RuntimeException
     */
    public function __construct(int $userId)
    {
        $this->c_user = new CUser;
        
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
            $this->gender = $user['PERSONAL_GENDER'];
            $this->birthday = $user['PERSONAL_BIRTHDAY'];
            $this->photo = CFile::GetPath($user['PERSONAL_PHOTO']);
            // Пользовательские поля
            $this->agree_with_personal_data_processing = $user['UF_AGREE_WITH_PERSONAL_DATA_PROCESSING'];
            $this->agree_with_terms_of_use = $user['UF_AGREE_WITH_TERMS_OF_USE'];
            $this->agree_with_company_rules = $user['UF_AGREE_WITH_COMPANY_RULES'];
            $this->agree_to_receive_information_about_promotions = $user['UF_AGREE_TO_RECEIVE_INFORMATION_ABOUT_PROMOTIONS'];
            $this->mentor_id = (int) $user['UF_MENTOR_ID'];
            $this->bonus_points = (int) $user['UF_BONUS_POINTS'];
            $this->loyalty_check_date = $user['UF_LOYALTY_CHECK_DATE'];
        }

        //Задаем необходимые связанные объекты
        $this->bonusAccountService = new BonusAccountService($this);
        $this->loyaltyService = new LoyaltyService($this);
        $this->userGroupsService = new UserGroupsService($this);
    }

    /**
     * Является ли аккаунт пользователя активным (не отключен)
     * @return CUser|null
     */
    public function isActive(): ?bool
    {
        if ($this->active === 'Y') {
            return true;
        }
        return false;
    }

    /**
     * Является ли пользователь Консультантом
     * @return bool
     */
    public function isConsultant(): ?bool
    {
        return $this->userGroupsService->isConsultant();
    }

    /**
     * Является ли пользователь Конечным покупателем
     * @return bool
     */
    public function isBuyer(): ?bool
    {
        return $this->userGroupsService->isBuyer();
    }

    /**
     * Активирует и авторизует пользователя
     * @return bool
     */
    public function activate(): bool
    {
        if ($this->update(['ACTIVE' => 'Y'])) {
            return $this->c_user->Authorize($this->id);
        }
        return false;
    }

    /**
     * Обновляет поля пользователя
     * @param array $fields
     * @return bool
     */
    public function update(array $fields): bool
    {
        return $this->c_user->Update($this->id, $fields);
    }
}