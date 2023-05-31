<?php
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use QSoft\Entity\User;


if (!$GLOBALS['USER']->GetID()) {
    LocalRedirect('/');
}

$user = new User($GLOBALS['USER']->GetID());
$refid = $user->referal->getReferalId();

$rsSites = CSite::GetByID('s1');
$arSite = $rsSites->Fetch();
$site= 'http://'.$arSite['DOMAINS'];


$this->arResult['ref_links']=[
    [
      'title'=>'Регистрация нового покупателя',
      'link'=>$site.'/login/?refid='.$refid.'&register=yes&type=buyer',
    ],
    [
        'title'=>'Регистрация нового консультанта',
        'link'=>$site.'/login/?refid='.$refid.'&register=yes&type=consultant',
    ],
    [
    'title'=>'Главная страница интернет-магазина',
    'link'=>$site.'/?refid='.$refid,
    ]
];

$this->includeComponentTemplate();
