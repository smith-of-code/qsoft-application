<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)  die();

use Bitrix\Main\Engine\Contract\Controllerable;
use QSoft\Entity\User;
use QSoft\Helper\LoyaltyProgramHelper;

class PersonalCalculatorComponent extends CBitrixComponent implements Controllerable
{
    private User $user;

    private LoyaltyProgramHelper $loyaltyProgramHelper;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->user = new User;

        $this->loyaltyProgramHelper = new LoyaltyProgramHelper;
    }

    public function executeComponent(): void
    {
        try {
            $this->getResult();
            $this->includeComponentTemplate();
        } catch (Exception $e) {
            ShowError($e->getMessage());
        }
    }

    public function getResult(): void
    {
        $currentAccountingPeriod = $this->loyaltyProgramHelper->getCurrentAccountingPeriod();

        $this->arResult = [
            'levels' => $this->loyaltyProgramHelper->getLoyaltyLevels(),
            'current_level' => $this->loyaltyProgramHelper->getLoyaltyLevelInfo($this->user->loyaltyLevel),
            'loyalty_status' => $this->loyaltyProgramHelper->getLoyaltyStatusByPeriod(
                $this->user->id,
                $currentAccountingPeriod['from'],
                $currentAccountingPeriod['to'],
            ),
            'next_level' => $this->loyaltyProgramHelper->getNextLoyaltyLevelInfo($this->user->loyaltyLevel),
        ];
    }

    public function configureActions(): array
    {
        return [
        ];
    }
}
