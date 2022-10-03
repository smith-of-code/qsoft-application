<?php

namespace QSoft\Entity;

use Bitrix\Main\UserFieldTable;
use CFile;
use CSite;
use CUser;
use CUserFieldEnum;

class User
{
    /**
     * @var int ID ������������
     */
    public $id;
    /**
     * @var string �����
     */
    public $login;
    /**
     * @var string ���� ���������� (Y|N)
     */
    public $active;
    /**
     * @var string ���
     */
    public $name;
    /**
     * @var string �������
     */
    public $last_name;
    /**
     * @var string ��������
     */
    public $second_name;
    /**
     * @var string E-mail
     */
    public $email;
    /**
     * @var string ����� ��������
     */
    public $phone;
    /**
     * @var string ���
     */
    public $gender;
    /**
     * @var string ���� ��������
     */
    public $birthday;
    /**
     * @var int ���������� (URL)
     */
    public $photo;


    /**
     * @var string �������� �� ������������� ������������ ������ (Y|N)
     */
    public $agree_with_personal_data_processing;
    /**
     * @var string �������� � ��������� ����������� ������ (Y|N)
     */
    public $agree_with_terms_of_use;
    /**
     * @var string �������� � ��������� �������� (Y|N)
     */
    public $agree_with_company_rules;
    /**
     * @var string �������� �� ��������� ���������� � ���������, ���������������� � ������ (Y|N)
     */
    public $agree_to_receive_information_about_promotions;
    /**
     * @var int ID ����������
     */
    public $mentor_id;
    /**
     * @var string ������� � ��������� ����������
     */
    public $loyalty_level;
    /**
     * @var int �������� �����
     */
    public $bonus_points;
    /**
     * @var string ���� �������� ������� ����������� ������ ��������� ����������
     */
    public $loyalty_check_date;

    /**
     * @var array ������ ID �����, � ������� ������� ������������
     */
    private $user_groups;

    /**
     * ���� ���������������� ����� ���� "������"
     */
    private const ENUM_PROPERTIES = [
        'UF_LOYALTY_LEVEL',
    ];
    private const USER_GROUP_ID_CONSULTANT = 9;
    private const USER_GROUP_ID_CUSTOMER = 10;

    /**
     * User constructor.
     * @param int $userId ID ������������
     */
    public function __construct(int $userId)
    {
        // �������� ���� � �������� ������������
        $user = CUser::GetByID($userId);
        if (!$user || !$user = $user->fetch()) {
            throw new RuntimeException('User not found');
        }

        // ��� ���������������� ����� ���� "������" �������� ������������� ��������
        foreach (self::ENUM_PROPERTIES as $enumProperty) {
            if ($user[$enumProperty]) {
                $user[$enumProperty] = CUserFieldEnum::GetList([], ['ID' => $user[$enumProperty]])->fetch()['VALUE'];
            }
        }

        // ������ ��������� ������� ������������
        foreach ($user as $key => $value) {
            // ����������� ����
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
            // ���������������� ����
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
     * @return array ������ ��������������� �����, � ������� ����������� ������������
     */
    private function getUserGroups($forceUpdate = false): array
    {
        if (! isset($this->user_groups) || $forceUpdate) {
            $this->user_groups = CUser::GetUserGroup($this->id);
        }
        return $this->user_groups;
    }

    /**
     * �������� �� ������������ �������������
     * @return bool
     */
    public function isConsultant(): bool
    {
        return in_array(self::USER_GROUP_ID_CONSULTANT, $this->getUserGroups());
    }

    /**
     * �������� �� ������������ �����������
     * @return bool
     */
    public function isCustomer(): bool
    {
        return in_array(self::USER_GROUP_ID_CUSTOMER, $this->getUserGroups());
    }
}