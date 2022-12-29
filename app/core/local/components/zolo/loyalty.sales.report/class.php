<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)  die();

use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\Date;
use QSoft\Entity\User;
use QSoft\Helper\LoyaltyProgramHelper;
use QSoft\Helper\OrderHelper;
use QSoft\Helper\PetHelper;
use QSoft\ORM\BeneficiariesTable;

class LoyaltySalesReportComponent extends CBitrixComponent implements Controllerable
{
    private User $user;

    private PetHelper $petHelper;
    private OrderHelper $orderHelper;
    private LoyaltyProgramHelper $loyaltyProgramHelper;

    private array $currentAccountingPeriod;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->user = new User;

        if (!$this->user->isAuthorized) {
            LocalRedirect('/');
        }

        $this->checkModules();

        $this->petHelper = new PetHelper;
        $this->orderHelper = new OrderHelper;
        $this->loyaltyProgramHelper = new LoyaltyProgramHelper;

        $this->currentAccountingPeriod = $this->loyaltyProgramHelper->getCurrentAccountingPeriod();
    }

    /**
     * @throws LoaderException
     * @throws SystemException
     */
    public function checkModules()
    {
        if (!Loader::includeModule('iblock')) {
            throw new SystemException;
        }
        if (!Loader::includeModule('highloadblock')) {
            throw new SystemException;
        }
    }

    public function executeComponent()
    {
        try {
            $this->getResult();
            $this->includeComponentTemplate();
        } catch (Exception $e) {
            ShowError($e->getMessage());
        }
    }

    public function getResult()
    {
        $loyaltyLevels = $this->loyaltyProgramHelper->getLoyaltyLevels();

        $this->arResult['current_accounting_period'] = $this->currentAccountingPeriod;
        $this->arResult['current_user'] = $this->getUserData($this->user);

        $this->arResult['consultant_loyalty_levels'] = $loyaltyLevels['consultant'];
        $this->arResult['buyer_loyalty_levels'] = $loyaltyLevels['customer'];

        $this->arResult['user_team'] = ['consultants' => [], 'buyers' => []];
        foreach ($this->user->beneficiariesService->getTeamIds() as $teamMemberId) {
            $userData = $this->getUserData(new User($teamMemberId));

            if ($userData['user_info']['is_consultant']) {
                $this->arResult['user_team']['consultants'][] = $userData;
            } else {
                $this->arResult['user_team']['buyers'][] = $userData;
            }
        }

        $this->arResult['consultants_accounting_periods'] = $this->loyaltyProgramHelper->getAccountingPeriodsSinceDate(
            $this->getOlderRegisterDate($this->arResult['user_team']['consultants'])
        );
        $this->arResult['buyers_accounting_periods'] = $this->loyaltyProgramHelper->getAccountingPeriodsSinceDate(
            $this->getOlderRegisterDate($this->arResult['user_team']['buyers'])
        );
    }

    public function getOlderRegisterDate(array $users)
    {
        $result = new Date;
        foreach ($users as $user) {
            if ($result->getDiff($user['user_info']['date_register'])->invert) {
                $result = $user['user_info']['date_register'];
            }
        }
        return $result;
    }

    public function getUserData(User $user, ?array $accountingPeriod = null): array
    {
        if (!$accountingPeriod) {
            $accountingPeriod = $this->currentAccountingPeriod;
        }

        return [
            'user_info' => $user->groups->isConsultant() ? $user->getPersonalData() : array_merge($user->getPersonalData(), [
                'pets' => array_map(
                    static fn (string $petKindCode): string => strtolower(str_replace('KIND_', '', $petKindCode)),
                    array_column(array_column($this->petHelper->getUserPets($user->id), 'kind'), 'code'),
                ),
            ]),
            'accounting_periods' => $this->loyaltyProgramHelper->getAvailableAccountingPeriods($user->id),
            'orders_report' => $this->orderHelper->getOrdersReport(
                $user->id,
                $accountingPeriod['from'],
                $accountingPeriod['to'],
            ),
            'bonuses_income' => $this->loyaltyProgramHelper->getPersonalBonusesIncomeByPeriod(
                $user->id,
                $accountingPeriod['from'],
                $accountingPeriod['to'],
            ),
            'loyalty_status' => $this->loyaltyProgramHelper->getLoyaltyStatusByPeriod(
                $user->id,
                $accountingPeriod['from'],
                $accountingPeriod['to'],
            ),
        ];
    }

    public function configureActions(): array
    {
        return [
            'getDataByPeriod' => [
                '-prefilters' => [
                    Csrf::class
                ],
            ],
            'getTeamMembersDataByPeriod' => [
                '-prefilters' => [
                    Csrf::class
                ],
            ],
        ];

    }

    public function getDataByPeriodAction(string $from, string $to): array
    {
        $from = new Date($from);
        $to = new Date($to);

        return CUtil::JsObjectToPhp(CUtil::PhpToJSObject([
            'bonuses_income' => $this->loyaltyProgramHelper->getPersonalBonusesIncomeByPeriod($this->user->id, $from, $to),
            'loyalty_status' => $this->loyaltyProgramHelper->getLoyaltyStatusByPeriod($this->user->id, $from, $to),
            'orders_report' => $this->orderHelper->getOrdersReport($this->user->id, $from, $to),
        ]));
    }

    public function getTeamMembersDataByPeriodAction(array $ids, string $from, string $to): array
    {
        $result = [];
        foreach ($ids as $id) {
            $result[] = $this->getUserData(new User($id), ['from' => new Date($from), 'to' => new Date($to)]);
        }
        return CUtil::JsObjectToPhp(CUtil::PhpToJSObject($result));
    }
}
