<?php

namespace QSoft\Entity;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Loader;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\Date;
use Bitrix\Main\Security\Password;
use Bitrix\Sale\Fuser;
use Carbon\Carbon;
use CCatalogGroup;
use CFile;
use CMain;
use CUser;
use CUserFieldEnum;
use Psr\Log\LogLevel;
use QSoft\Service\BeneficiariesService;
use QSoft\Service\ConfirmationService;
use QSoft\Entity\Mutators\UserPropertiesMutator;
use QSoft\Logger\Logger;
use QSoft\Service\BonusAccountService;
use QSoft\Service\LegalEntityService;
use QSoft\Service\LoyaltyService;
use QSoft\Service\NotificationService;
use QSoft\Service\OrderAmountService;
use QSoft\Service\ProductService;
use QSoft\Service\UserDiscountsService;
use QSoft\Service\PetService;
use QSoft\Service\UserGroupsService;
use QSoft\Service\WishlistService;
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
     * @var ConfirmationService Объект для работы с подтверждениями
     */
    public ConfirmationService $confirmation;
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
    public ProductService $products;
    public WishlistService $wishlist;
    public BeneficiariesService $beneficiariesService;
    public BonusAccountService $bonusAccount;

    /**
     * @var int ID пользователя
     */
    public int $id;

    public int $fUserID;
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
     * @var string Город
     */
    public string $city;
    /**
     * @var int
     */
    public int $pickupPointId;
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
     * @var string Дата регистрации
     */
    public string $dateRegister;
    /**
     * @var string Номер телефона
     */
    public string $phone;
    /**
     * @var string Уровень в программе лояльности
     */
    public string $loyaltyLevel;

    public bool $emailConfirmed;
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
     * @var bool Согласен на получение информации о продуктах, спец. предложениях и акциях
     */
    public bool $agreeToReceiveInformationAboutPromotions;
    /**
     * @var int $mentorId
     */
    public int $mentorId;
    /**
     * @var User|null Наставник
     */
    private ?User $mentor;
    /**
     * @var int Бонусные баллы
     */
    public int $bonusPoints = 0;
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

    protected static array $bitrixFieldsToObjectPropertiesMapping = [
        'ID' => 'id',
        'LOGIN' => 'login',
        'ACTIVE' => 'active',
        'NAME' => 'name',
        'LAST_NAME' => 'lastName',
        'SECOND_NAME' => 'secondName',
        'PERSONAL_CITY' => 'city',
        'UF_PICKUP_POINT_ID' => 'pickupPointId',
        'EMAIL' => 'email',
        'PERSONAL_GENDER' => 'gender',
        'PERSONAL_BIRTHDAY' => 'birthday',
        'PERSONAL_PHOTO' => 'photo',
        'DATE_REGISTER' => 'dateRegister',
        'PERSONAL_PHONE' => 'phone',
        'UF_LOYALTY_LEVEL' => 'loyaltyLevel',
        'UF_EMAIL_CONFIRMED' => 'emailConfirmed',
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
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function __construct(?int $userId = null)
    {
        $this->initModules();
        $this->initServices();

        if ($userId === null) {
            global $USER;
            $userId = $USER->GetID();
        }
        $this->fUserID = $userId ? Fuser::getIdByUserId($userId) : Fuser::getId();
        $this->isAuthorized = $userId !== null;

        if ($userId === null) {
            return;
        }

        $user = CUser::GetByID($userId);
        if (!$user || !$user = $user->fetch()) {
            $error = new RuntimeException('Пользователь с ID = ' . $userId . ' не найден');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $error->getMessage());

            throw $error;
        }

        // Для пользовательских полей типа "Список" получаем установленное значение
        foreach (self::ENUM_PROPERTIES as $enumProperty) {
            if ($user[$enumProperty]) {
                $user[$enumProperty] = CUserFieldEnum::GetList([], ['ID' => $user[$enumProperty]])->fetch()['VALUE'];
            }
        }

        $this->setObjectProperties($user);

        if ($this->groups->isConsultant()) {
            $this->catalogGroupId = CCatalogGroup::GetList([], ['NAME' => $this->loyaltyLevel])->Fetch()['ID'];
        }
    }

    private function initModules(): void
    {
        Loader::includeModule('sale');
        Loader::includeModule('catalog');
    }

    private function initServices(): void
    {
        $this->cUser = new CUser;
        $this->legalEntity = new LegalEntityService($this);
        $this->beneficiariesService = new BeneficiariesService($this);
        $this->groups = new UserGroupsService($this);
        $this->loyalty = new LoyaltyService($this);
        $this->notification = new NotificationService($this);
        $this->confirmation = new ConfirmationService($this);
        $this->orderAmount = new OrderAmountService($this);
        $this->discounts = new UserDiscountsService($this);
        $this->pets = new PetService($this);
        $this->products = new ProductService($this);
        $this->wishlist = new WishlistService($this);
        $this->bonusAccount = new BonusAccountService($this);
    }

    /**
     * Активирует и авторизует пользователя
     * @return bool
     */
    public function activate(): bool
    {
        if ($this->update(['ACTIVE' => 'Y', 'UF_EMAIL_CONFIRMED' => 'Y'])) {
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

    public function getFullName(): string
    {
        return "$this->lastName $this->name $this->secondName";
    }

    public function getPersonalData(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->name,
            'last_name' => $this->lastName,
            'second_name' => $this->secondName,
            'name_initials' => $this->lastName . ' ' . mb_strtoupper(mb_substr($this->name, 0, 1)) . '.' . ($this->secondName ? (mb_strtoupper(mb_substr($this->secondName, 0, 1)) . '.') : ''),
            'full_name' => $this->getFullName(),
            'gender' => $this->gender,
            'photo' => $this->getPhotoUrl(),
            'loyalty_level' => $this->loyaltyLevel,
            'birthdate' => $this->birthday->format('d.m.Y'),
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'pickup_point_id' => $this->pickupPointId,
            'is_consultant' => $this->groups->isConsultant(),
            'date_register' => new Date($this->dateRegister),
        ];
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
                        $objectPropertyValue = $objectPropertyValue === true || $objectPropertyValue === 'Y';
                        break;
                    case 'string':
                        $objectPropertyValue = (string)$objectPropertyValue;
                }
            }

            $mutationMethod = 'read' . ucfirst($objectPropertyName);

            if (method_exists($mutator, $mutationMethod)) {
                $objectPropertyValue = call_user_func([$mutator, $mutationMethod], $objectPropertyValue);
            }

            $this->$objectPropertyName = $objectPropertyValue;
        }
    }

    public function changePassword(string $password, string $confirmPassword): bool
    {
        $checkWord = md5(uniqid() . CMain::GetServerUniqID());
        $checkWordHash = Password::hash($checkWord);

        global $DB;
        $DB->Query(<<<SQL
            update b_user set 
              CHECKWORD = '$checkWordHash',
              CHECKWORD_TIME = now(),
              TIMESTAMP_X = TIMESTAMP_X
            where ID = '$this->id'
        SQL);

        $result = $this->cUser->ChangePassword($this->login, $checkWord, $password, $confirmPassword);

        return $result['TYPE'] === 'OK';
    }

    public function logout(): void
    {
        $this->cUser->Logout();
    }
}