<?php

namespace QSoft\Entity;

use Bitrix\Main\Security\Password;
use Carbon\Carbon;
use CFile;
use CUser;
use CUserFieldEnum;

use QSoft\Service\ConfirmationService;
use QSoft\Service\LegalEntityService;
use QSoft\Service\LoyaltyService;
use QSoft\Service\NotificationService;
use QSoft\Service\OrderAmountService;
use QSoft\Service\UserDiscountsService;
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
        $this->city = $user['PERSONAL_CITY'];
        $this->pickupPointId = $user['UF_PICKUP_POINT_ID'];
        $this->email = $user['EMAIL'];
        $this->gender = $user['PERSONAL_GENDER'];
        $this->birthday = Carbon::createFromTimestamp(MakeTimeStamp($user['PERSONAL_BIRTHDAY']));
        $this->photo = $user['PERSONAL_PHOTO'] ?? 0;
        $this->loyaltyLevel = $user['UF_LOYALTY_LEVEL'] ?? '';

        // Пользовательские поля
        $this->agreeWithPersonalDataProcessing = $user['UF_AGREE_WITH_PERSONAL_DATA_PROCESSING'] === 'Y';
        $this->agreeWithTermsOfUse = $user['UF_AGREE_WITH_TERMS_OF_USE'] === 'Y';
        $this->agreeWithCompanyRules = $user['UF_AGREE_WITH_COMPANY_RULES'] === 'Y';
        $this->agreeToReceiveInformationAboutPromotions = $user['UF_AGREE_TO_RECEIVE_INFORMATION_ABOUT_PROMOTIONS'] === 'Y';
        $this->mentor = $user['UF_MENTOR_ID'] ? new self((int) $user['UF_MENTOR_ID']) : null;
        $this->bonusPoints = (int) $user['UF_BONUS_POINTS'];
        $this->loyaltyCheckDate = Carbon::createFromTimestamp(MakeTimeStamp($user['UF_LOYALTY_CHECK_DATE']));

        //Задаем необходимые связанные объекты
        $this->legalEntity = new LegalEntityService($this);
        $this->loyalty = new LoyaltyService($this);
        $this->groups = new UserGroupsService($this);
        $this->notification = new NotificationService($this);
        $this->confirmation = new ConfirmationService($this);
        $this->orderAmount = new OrderAmountService($this);
        $this->discounts = new UserDiscountsService($this);
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
            'pickup_point_id' => $this->pickupPointId,
        ];
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

    public function changePassword(string $password, string $confirmPassword): bool
    {
        $checkWord = md5(uniqid().\CMain::GetServerUniqID());
        $checkWordHash = Password::hash($checkWord);

        global $DB;
        $DB->Query(<<<SQL
            update b_user set 
              CHECKWORD = '$checkWordHash',
              CHECKWORD_TIME = now(),
              TIMESTAMP_X = TIMESTAMP_X
            where ID = '$this->id'
        SQL);

        $result = (new CUser)->ChangePassword($this->login, $checkWord, $password, $confirmPassword);

        return $result['TYPE'] === 'OK';
    }
}