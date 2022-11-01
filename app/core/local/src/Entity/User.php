<?php

namespace QSoft\Entity;

use Carbon\Carbon;
use CCatalogGroup;
use CFile;
use CModule;
use CUser;
use CUserFieldEnum;

use QSoft\Entity\Mutators\UserPropertiesMutator;
use QSoft\Service\BonusAccountService;
use QSoft\Service\LegalEntityService;
use QSoft\Service\LoyaltyService;
use QSoft\Service\NotificationService;
use QSoft\Service\OrderAmountService;
use QSoft\Service\UserDiscountsService;
use QSoft\Service\PetService;
use QSoft\Service\UserGroupsService;
use ReflectionProperty;
use RuntimeException;

class User
{
    /**
     * @var CUser Объект пользователя Битрикса
     */
    private CUser $cUser;
    /**
     * @var LegalEntityService Объект для работы с документами пользователя
     */
    public LegalEntityService $legalEntity;
    /**
     * @var LoyaltyService Объект для работы с программой лояльности
     */
    public LoyaltyService $loyalty;
    /**
     * @var UserGroupsService Объект для работы с группами (ролями) пользователя
     */
    public UserGroupsService $groups;
    /**
     * @var NotificationService Объект для работы с уведомлениями
     */
    public NotificationService $notification;
    /**
     * @var OrderAmountService Объект для подсчета статистики по заказам пользователя
     */
    public OrderAmountService $orderAmount;
    /**
     * @var UserDiscountsService Объект для работы со скидками и акциями пользователя
     */
    public UserDiscountsService $discounts;
    /**
     * @var PetService Объект для работы с питомцами пользователя
     */
    public PetService $pets;
    public BonusAccountService $bonusAccount;

    /**
     * @var int ID пользователя
     */
    public int $id;
    /**
     * @var string Логин (он же номер телефона)
     */
    public string $login;
    /**
     * @var int|null ID цены бонусов для товаров по уровню лояльности
     */
    public ?int $catalogGroupId = null;
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
     * @var string|null Отчество
     */
    public ?string $secondName;
    /**
     * @var string E-mail
     */
    public string $email;
    /**
     * @var string Пол
     */
    public string $gender;
    /**
     * @var string Город
     */
    public string $city;
    /**
     * @var Carbon Дата рождения
     */
    public Carbon $birthday;
    /**
     * @var int Фотография (ID файла)
     */
    public int $photo;
    /**
     * @var string Уровень в программе лояльности
     */
    public string $loyaltyLevel;


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
     * @var int $mentorId
     */
    public int $mentorId;
    /**
     * @var User|null Наставник
     */
    public ?User $mentor;
    /**
     * @var int Бонусные баллы
     */
    public int $bonusPoints;
    /**
     * @var Carbon Дата проверки условий поддержания уровня программы лояльности
     */
    public Carbon $loyaltyCheckDate;

    /**
     * @var bool Этот флаг говорит об авторизованности пользователя только в том, случае, если не был передан $userId (то есть когда пользователь текущий)
     */
    public bool $isAuthorized;

    /**
     * Коды пользовательских полей типа "Список"
     */
    private const ENUM_PROPERTIES = [
        'UF_LOYALTY_LEVEL',
        'UF_PERSONAL_DISCOUNT_LEVEL',
    ];

    protected static array $protectedFields = [
        'id', 'login'
    ];

    protected static array $bitrixFieldsToObjectPropertiesMapping = [
        'ID' => 'id',
        'LOGIN' => 'login',
        'ACTIVE' => 'active',
        'NAME' => 'name',
        'LAST_NAME' => 'lastName',
        'SECOND_NAME' => 'secondName',
        'EMAIL' => 'email',
        'PERSONAL_GENDER' => 'gender',
        'PERSONAL_BIRTHDAY' => 'birthday',
        'PERSONAL_CITY' => 'city',
        'PERSONAL_PHOTO' => 'photo',
        'UF_LOYALTY_LEVEL' => 'loyaltyLevel',
        'UF_AGREE_WITH_PERSONAL_DATA_PROCESSING' => 'agreeWithPersonalDataProcessing',
        'UF_AGREE_WITH_TERMS_OF_USE' => 'agreeWithTermsOfUse',
        'UF_AGREE_WITH_COMPANY_RULES' => 'agreeWithCompanyRules',
        'UF_AGREE_TO_RECEIVE_INFORMATION_ABOUT_PROMOTIONS' => 'agreeToReceiveInformationAboutPromotions',
        'UF_MENTOR_ID' => 'mentorId',
        'UF_BONUS_POINTS' => 'bonusPoints',
        'UF_LOYALTY_CHECK_DATE' => 'loyaltyCheckDate'
    ];

    /**
     * User constructor.
     * @param int|null $userId ID пользователя
     */
    public function __construct(?int $userId = null)
    {
        $this->cUser = new CUser;

        // Получаем поля и свойства пользователя
        if ($userId === null) {
            global $USER;

            $userId = $USER->GetID();

            $this->isAuthorized = $userId !== null;

            if ($userId === null) {
                return;
            }
        }

        $user = CUser::GetByID($userId);
        if (!$user || !$user = $user->fetch()) {
            throw new RuntimeException('Пользователь с ID = ' . $userId . ' не найден');
        }

        // Для пользовательских полей типа "Список" получаем установленное значение
        foreach (self::ENUM_PROPERTIES as $enumProperty) {
            if ($user[$enumProperty]) {
                $user[$enumProperty] = CUserFieldEnum::GetList([], ['ID' => $user[$enumProperty]])->fetch()['VALUE'];
            }
        }

        $this->setObjectProperties($user);

        //Задаем необходимые связанные объекты
        $this->legalEntity = new LegalEntityService($this);
        $this->groups = new UserGroupsService($this);

        //Задаем уровень в программе лояльности в зависимости от группы пользователя
        $this->loyalty = new LoyaltyService($this);
        
        $this->notification = new NotificationService($this);
        $this->orderAmount = new OrderAmountService($this);
        $this->discounts = new UserDiscountsService($this);
        $this->pets = new PetService($this);
        $this->bonusAccount = new BonusAccountService($this);

        if ($this->groups->isConsultant() && CModule::IncludeModule('catalog')) {
            $this->catalogGroupId = CCatalogGroup::GetList([], ['NAME' => $this->loyaltyLevel])->Fetch()['ID'];
        }
    }

    /**
     * Активирует и авторизует пользователя
     * @return bool
     */
    public function activate(): bool
    {
        if ($this->update(['ACTIVE' => true])) {
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

    public function getMentor(): ?User
    {
        if (!isset($this->mentor)) {
            if (empty($this->mentorId)) {
                return null;
            }

            $this->mentor = new User($this->mentorId);
        }

        return $this->mentor;
    }

    /**
     * Обновляет поля пользователя
     * @param array $fields
     * @return bool
     */
    public function update(array $bitrixFields): bool
    {
        $this->setObjectProperties($bitrixFields);

        return $this->cUser->Update($this->id, $bitrixFields);
    }

    public function getPersonalData(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->name,
            'last_name' => $this->lastName,
            'second_name' => $this->secondName,
            'gender' => $this->gender,
            'photo' => $this->getPhotoUrl(),
            'loyalty_level' => $this->loyaltyLevel,
            'birthdate' => $this->birthday->format('d.m.Y'),
            'email' => $this->email,
            'phone' => $this->login,
            'city' => $this->city,
        ];
    }

    protected function setObjectProperties(array $bitrixFields): void
    {
        $mutator = UserPropertiesMutator::class;

        foreach ($bitrixFields as $bitrixFieldName => $bitrixFieldValue) {
            $objectPropertyName = self::$bitrixFieldsToObjectPropertiesMapping[$bitrixFieldName];

            $objectPropertyValue = $bitrixFieldValue;

            if (property_exists(self::class, $objectPropertyName)) {
                switch ((new ReflectionProperty(self::class, $objectPropertyName))->getType()->getName()) {
                    case 'int':
                        $objectPropertyValue = (int)$objectPropertyValue;
                        break;
                    case 'bool':
                        $objectPropertyValue = (bool)$objectPropertyValue;
                }
            }

            $mutationMethod = 'read' . ucfirst($objectPropertyName);
            if (method_exists($mutator, $mutationMethod)) {
                $objectPropertyValue = call_user_func([$mutator, $mutationMethod], $objectPropertyValue);
            }

            $this->$objectPropertyName = $objectPropertyValue;
        }
    }
}