<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)  die();

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\SystemException;
use QSoft\Entity\User;
use QSoft\Helper\LoyaltyProgramHelper;
use QSoft\Helper\OrderHelper;

class LoyaltySalesReportComponent extends CBitrixComponent implements Controllerable
{
    private User $user;

    private OrderHelper $orderHelper;
    private LoyaltyProgramHelper $loyaltyProgramHelper;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->user = new User;

        if (!$this->user->isAuthorized) {
            LocalRedirect('/');
        }

        $this->orderHelper = new OrderHelper;
        $this->loyaltyProgramHelper = new LoyaltyProgramHelper;

        $this->checkModules();
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
        $currentPeriod = $this->loyaltyProgramHelper->getCurrentAccountingPeriod();

        $this->arResult['user'] = $this->user->getPersonalData();
        $this->arResult['orders_report'] = $this->orderHelper->getOrdersReport($this->user->id);
        $this->arResult['current_accounting_period'] = $currentPeriod;
        $this->arResult['accounting_periods'] = $this->loyaltyProgramHelper->getAvailableAccountingPeriods($this->user->id);
        $this->arResult['bonuses_income'] = $this->loyaltyProgramHelper->getPersonalBonusesIncomeByPeriod(
            $this->user->id,
            $currentPeriod['from'],
            $currentPeriod['to'],
        );
        $this->arResult['loyalty_status'] = $this->loyaltyProgramHelper->getLoyaltyStatusByPeriod(
            $this->user->id,
            $currentPeriod['from'],
            $currentPeriod['to'],
        );
    }

    public function configureActions(): array
    {
        return [
            'getDataByPeriod' => [
                'prefilters' => []
            ],
        ];

    }

    public function getDataByPeriodAction(string $from, string $to): array
    {
        return [];
    }
}
