<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use QSoft\ORM\FaqTable;

class FaqComponent extends CBitrixComponent
{

    public function executeComponent()
    {
        try {
            $this->checkModules();
            $this->arResult['GROUPS'] = $this->getGroupedQuestions();
            $this->includeComponentTemplate();
        } catch (Exception $e) {
            ShowError($e->getMessage());
        }
    }

    /**
     * @throws LoaderException
     * @throws SystemException
     */
    public function checkModules()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new SystemException(Loc::GetMessage('PSETTINGS_HLBLOCK_NOT_INCLUDED'));
        }
    }

    public function getGroupedQuestions(): array
    {
        $groups = $this->getGroups();
        $questions = $this->getQuestions();

        $questionsByGroups = [];
        foreach ($questions as $question) {
            if (isset($questionsByGroups[$question['UF_GROUP']])) {
                $questionsByGroups[$question['UF_GROUP']]['questions'][] = $question;
            } else {
                $questionsByGroups[$question['UF_GROUP']] = array_merge($groups[$question['UF_GROUP']], ['questions' => [$question]]);
            }
        }

        return $questionsByGroups;
    }

    protected function getGroups(): array
    {
        $groupPropertyValues = FaqTable::getFieldValues(['UF_GROUP'])['UF_GROUP'];

        $groups = [];
        foreach ($groupPropertyValues as $groupPropertyValue) {
            $groups[$groupPropertyValue['ID']] = $groupPropertyValue;
        }

        uasort($groups, fn($groupA, $groupB) => $groupA['SORT'] <=> $groupB['SORT']);

        return $groups;
    }

    protected function getQuestions(): array
    {
        return FaqTable::getList([
            'order' => ['ID' => 'ASC'],
            'select' => ['ID', 'UF_GROUP', 'UF_QUESTION', 'UF_ANSWER'],
        ])->fetchAll();
    }
}
