<?php

namespace Wizandr\Geolocation\Controller;

use Bitrix\Main\Engine\Controller;

use Bitrix\Main\Application;

use \Bitrix\Main\Service\GeoIp;

\Bitrix\Main\Loader::includeModule('sale');

class Usercity extends Controller
{


    public function configureActions(): array
    {
        return [
            'savecity' => [
                'prefilters' => [
                    new \Bitrix\Main\Engine\ActionFilter\Csrf(),
                ]
            ],
            'getcity' => [
                'prefilters' => [
                    new \Bitrix\Main\Engine\ActionFilter\Csrf(),
                ]
            ],
            'getcitylist' => [
                'prefilters' => [
                    new \Bitrix\Main\Engine\ActionFilter\Csrf(),
                ]
            ],
            'getgeoipinfo' => [
                'prefilters' => [
                    new \Bitrix\Main\Engine\ActionFilter\Csrf(),
                ]
            ],
        ];
    }


    public function getcitylistAction(){


        $db_vars = \CSaleLocation::GetList(
            array(
                "SORT" => "ASC",
                "COUNTRY_NAME_LANG" => "ASC",
                "CITY_NAME_LANG" => "ASC"
            ),
            array("LID" => LANGUAGE_ID),
            false,
            false,
            array()
        );

        $cities = [];

        while ($vars = $db_vars->Fetch()) {
            if ($vars["CITY_NAME"]) {
                $cities[] = $vars;
            }
        }

        return $cities;

    }


    public function getgeoipinfoAction(){

        //$ip = '95.31.209.94';
        $ip ='62.133.135.129';
        $lang = 'ru';

        $geolocationId = \Bitrix\Sale\Location\GeoIp::getLocationId($ip, $lang);

        if ($geolocationId === 0){
            $ip ='85.26.146.169';
        }


        $geolocation = GeoIp\Manager::getDataResult($ip, $lang);


        $geolocationId = \Bitrix\Sale\Location\GeoIp::getLocationId($ip, $lang);

        $geolocationName = $geolocation->getGeoData()->cityName;

        $geolocationKladrId = $geolocation->getGeoData()->daData['city_kladr_id'];

        $session = \Bitrix\Main\Application::getInstance()->getSession();

        if ($session->has('current_city')){
            $geolocationId = $session->get('current_city')['CITY_ID'];
            $geolocationKladrId = $session->get('current_city')['city_kladr_id'];
            $geolocationName = $session->get('current_city')['CITY_NAME'];
        }



        return [
            'CITY_ID'=>$geolocationId,
            'city_kladr_id'=>$geolocationKladrId,
            'CITY_NAME'=>$geolocationName
        ];

    }


    public function getcityAction(){

        $session = \Bitrix\Main\Application::getInstance()->getSession();
        $session->get('current_city');

        return $session->get('current_city');

    }


    public function savecityAction(){

        $session = \Bitrix\Main\Application::getInstance()->getSession();
        $session->set('current_city', $this->getRequest()['city']);

        return true;

    }

}