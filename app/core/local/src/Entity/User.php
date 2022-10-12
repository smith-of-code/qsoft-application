<?php

namespace QSoft\Entity;

use Carbon\Carbon;
use CFile;
use CUser;
use CUserFieldEnum;
use QSoft\Service\BonusAccountService;
use QSoft\Service\LegalEntityService;
use QSoft\Service\LoyaltyService;
use QSoft\Service\OrderAmountService;
use QSoft\Service\PetService;
use QSoft\Service\UserGroupsService;
use RuntimeException;

class User
{
    /**
     * @var CUser Объект пользователя Битрикса
     */
    private CUser $cUser;
    /**
     * @var BonusAccountService Объект для работы с бонусным счетом пользователя
     */
    public BonusAccountService $bonusAccount;
    /**
     * @var LegalEntityService Объект для работы с питомцами пользователя
     */
    public LegalEntityService $legalEntity;
    /**
     * @var LoyaltyService Объект для работы с программой лояльности
     */
    public LoyaltyService $loyalty;
    /**
     * @var UserGroupsService Объект для работы с бонусным счетом пользователя
     */
    public UserGroupsService $groups;
    /**
     * @var OrderAmountService Объект для подсчета статистики по заказам пользователя
     */
    public OrderAmountService $orderAmount;
    /**
     * @var PetService Объект для работы с питомцами пользователя
     */
    public PetService $pets;
    /**
     * @var int ID пользователя
     */
    public int $id;
    /**
     * @var string Логин (он же номер телефона)
     */
    public string $login;
    /**
     * @var bool Флаг активности
     */
    public bool $active;
    /**
     * @var string Имя
     */
    public string $name;
    /**
     * @var string Фамилия
     */
    public string $lastName;
    /**
     * @var string Отчество
     */
    public string $secondName;
    /**
     * @var string E-mail
     */
    public string $email;
    /**
     * @var string Пол
     */
    public string $gender;
    /**
     * @var Carbon Дата рождения
     */
    public Carbon $birthday;
    /**
     * @var int Фотография (ID файла)
     */
    public int $photo;


    /**
     * @var bool Согласен на использование персональных данных
     */
    public bool $agreeWithPersonalDataProcessing;
    /**
     * @var bool Согласен с условиями пользования сайтом
     */
    public bool $agreeWithTermsOfUse;
    /**
     * @var bool Согласен с правилами компании
     */
    public bool $agreeWithCompanyRules;
    /**
     * @var bool Согласен на получение информации о продуктах, спецпредложениях и акциях
     */
    public bool $agreeToReceiveInformationAboutPromotions;
    /**
     * @var int ID наставника
     */
    public int $mentorId;
    /**
     * @var int Бонусные баллы
     */
    public int $bonusPoints;
    /**
     * @var Carbon Дата проверки условий поддержания уровня программы лояльности
     */
    public Carbon $loyaltyCheckDate;

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
        $this->cUser = new CUser;
        
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

        // Стандартные поля
        $this->id = $user['ID'];
        $this->login = $user['LOGIN'];
        $this->active = $user['ACTIVE'] === 'Y';
        $this->name = $user['NAME'];
        $this->lastName = $user['LAST_NAME'];
        $this->secondName = $user['SECOND_NAME'];
        $this->email = $user['EMAIL'];
        $this->gender = $user['PERSONAL_GENDER'];
        $this->birthday = Carbon::createFromTimestamp(MakeTimeStamp($user['PERSONAL_BIRTHDAY']));
        $this->photo = $user['PERSONAL_PHOTO'] ?? 0;

        // Пользовательские поля
        $this->agreeWithPersonalDataProcessing = $user['UF_AGREE_WITH_PERSONAL_DATA_PROCESSING'] === 'Y';
        $this->agreeWithTermsOfUse = $user['UF_AGREE_WITH_TERMS_OF_USE'] === 'Y';
        $this->agreeWithCompanyRules = $user['UF_AGREE_WITH_COMPANY_RULES'] === 'Y';
        $this->agreeToReceiveInformationAboutPromotions = $user['UF_AGREE_TO_RECEIVE_INFORMATION_ABOUT_PROMOTIONS'] === 'Y';
        $this->mentorId = (int) $user['UF_MENTOR_ID'];
        $this->bonusPoints = (int) $user['UF_BONUS_POINTS'];
        $this->loyaltyCheckDate = Carbon::createFromTimestamp(MakeTimeStamp($user['UF_LOYALTY_CHECK_DATE']));

        //Задаем необходимые связанные объекты
        $this->bonusAccount = new BonusAccountService($this);
        $this->legalEntity = new LegalEntityService($this);
        $this->loyalty = new LoyaltyService($this);
        $this->groups = new UserGroupsService($this);
        $this->orderAmount = new OrderAmountService($this);
        $this->pets = new PetService($this);
    }

    /**
     * Активирует и авторизует пользователя
     * @return bool
     */
    public function activate(): bool
    {
        if ($this->update(['ACTIVE' => 'Y'])) {
            $this->active = true;
            return $this->cUser->Authorize($this->id);
        }
        return false;
    }

    /**
     * Возвращает URL фотографии пользователя
     * @return string|null
     */
    public function getPhotoUrl(): ?string
    {
        return CFile::GetPath($this->photo);
    }

    /**
     * Обновляет поля пользователя
     * @param array $fields
     * @return bool
     */
    public function update(array $fields): bool
    {
        return $this->cUser->Update($this->id, $fields);
    }
}