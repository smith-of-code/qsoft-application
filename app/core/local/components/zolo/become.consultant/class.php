<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)  die();

use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Contract\Controllerable;
use QSoft\Entity\User;
use QSoft\Helper\HlBlockHelper;
use QSoft\Helper\TicketHelper;
use QSoft\ORM\LegalEntityTable;

class BecomeConsultantComponent extends CBitrixComponent implements Controllerable
{
    public const FILE_FIELDS = [
        'photo',
        'passport',
        'tax_registration_certificate',
        'personal_tax_registration_certificate',
        'bank_details',
        'usn_notification',
        'ip_registration_certificate',
        'llc_charter',
        'llc_members',
        'ceo_appointment',
        'llc_registration_certificate',
        'procuration',
    ];

    private User $user;
    private TicketHelper $ticketHelper;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->user = new User;

        if (!$this->user->isAuthorized) {
            LocalRedirect('/login');
        }

        if (!$this->user->groups->isBuyer()) {
            LocalRedirect('/personal');
        }

        $this->ticketHelper = new TicketHelper;
    }

    public function executeComponent(): void
    {
        $this->includeComponentTemplate();
    }

    public function configureActions(): array
    {
        return [
            'submit' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ],
            ],
        ];
    }

    public function submitAction(array $data): array
    {
        foreach ($data as $field => &$value) {
            if (in_array($field, self::FILE_FIELDS) && !$value['src'] && !empty($value['files'])) {
                foreach ($value['files'] as &$file) {
                    $file['src'] = CFile::GetPath($file['id']);
                }
                $value = $value['files'];
            }
        }

        $documents = [
            'nationality' => $data['nationality'],
            'passport_series' => $data['passport_series'],
            'passport_number' => $data['passport_number'],
            'who_got' => $data['who_got'],
            'getting_date' => $data['getting_date'],
            'passport' => $data['passport'],
            'register_locality' => $data['register_locality'],
            'register_street' => $data['register_street'],
            'register_house' => $data['register_house'],
            'register_apartment' => $data['register_apartment'],
            'register_postal_code' => $data['register_postal_code'],
            'living_locality' => $data['living_locality'] ?? $data['register_locality'],
            'living_street' => $data['living_street'] ?? $data['register_street'],
            'living_house' => $data['living_house'] ?? $data['register_house'],
            'living_apartment' => $data['living_apartment'] ?? $data['register_apartment'],
            'living_postal_code' => $data['living_postal_code'] ?? $data['register_postal_code'],
            'without_living' => (bool) $data['living_locality'],
        ];

        if ($data['status'] === 'self_employed') {
            $documents += [
                'tin' => $data['tin'],
                'tax_registration_certificate' => $data['tax_registration_certificate'],
                'bank_name' => $data['bank_name'],
                'bic' => $data['bic'],
                'checking_account' => $data['checking_account'],
                'correspondent_account' => $data['correspondent_account'],
                'bank_details' => $data['bank_details'],
                'personal_tax_registration_certificate' => $data['personal_tax_registration_certificate'],
            ];
        } else if ($data['status'] === 'ltc') {
            $documents += [
                'ltc_full_name' => $data['ltc_full_name'],
                'ltc_short_name' => $data['ltc_short_name'],
                'ogrn' => $data['ogrn'],
                'tin' => $data['tin'],
                'nds_payer' => $data['nds_payer_ltc'],
                'tax_registration_certificate' => $data['tax_registration_certificate'],
                'usn_notification' => $data['usn_notification'],
                'kpp' => $data['kpp'],
                'llc_charter' => $data['llc_charter'],
                'llc_members' => $data['llc_members'],
                'ceo_appointment' => $data['ceo_appointment'],
                'llc_registration_certificate' => $data['llc_registration_certificate'],
                'bank_name' => $data['bank_name'],
                'bic' => $data['bic'],
                'checking_account' => $data['checking_account'],
                'correspondent_account' => $data['correspondent_account'],
                'bank_details' => $data['bank_details'],
                'ltc_locality' => $data['ltc_locality'],
                'ltc_street' => $data['ltc_street'],
                'ltc_address_1' => $data['ltc_address_1'],
                'ltc_address_2' => $data['ltc_address_2'],
                'ltc_postal_code' => $data['ltc_postal_code'],
            ];

            if ($data['need_proxy'] && $data['need_proxy'] === 'true') {
                $documents['procuration'] = $data['procuration'];
            }
        } else if ($data['status'] === 'ip') {
            $documents += [
                'ip_name' => $data['ip_name'],
                'tin' => $data['tin'],
                'nds_payer' => $data['nds_payer_ip'],
                'tax_registration_certificate' => $data['tax_registration_certificate'],
                'usn_notification' => $data['usn_notification'],
                'ogrnip' => $data['ogrnip'],
                'ip_registration_certificate' => $data['ip_registration_certificate'],
                'bank_name' => $data['bank_name'],
                'bic' => $data['bic'],
                'checking_account' => $data['checking_account'],
                'correspondent_account' => $data['correspondent_account'],
                'bank_details' => $data['bank_details'],
            ];
        }

        $type = null;
        $statuses = HlBlockHelper::getPreparedEnumFieldValues(LegalEntityTable::getTableName(), 'UF_STATUS');
        foreach ($statuses as $status) {
            if ($status['code'] === LegalEntityTable::STATUSES[$data['status']]) {
                $type = $status;
            }
        }

        $ticketCreated = $this->ticketHelper->createTicket(
            $this->user->id,
            TicketHelper::BECOME_CONSULTANT_CATEGORY,
            json_encode([
                'type' => $type,
                'user_id' => $this->user->id,
                'documents' => $documents,
            ], JSON_UNESCAPED_UNICODE),
        );

        return ['status' => $ticketCreated ? 'success' : 'error'];
    }
}
