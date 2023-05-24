<?php

namespace Wizandr\Geolocation\Controller;

use Bitrix\Main\Engine\Controller;

use Bitrix\Main\Application;

class Useraddress extends Controller
{


    public function configureActions(): array
    {
        return [
            'list' => [
                'prefilters' => [
                    new \Bitrix\Main\Engine\ActionFilter\Csrf(),
                ]
            ],
            'add'=>[
                'prefilters' => [
                    new \Bitrix\Main\Engine\ActionFilter\Csrf(),
                ]
            ]
        ];
    }


    public function listAction()
    {

        $userId = $this->getCurrentUser()->getId();
        if ($userId){
            $result = Application::getConnection()->query("SELECT * FROM arrival_place WHERE user_id= $userId ");
            $result2 =[];
            while($row = $result->fetch()){
                $result2[] = $row;
            }
            return $result2;
        }else{
            return [];
        }

    }

    public function addAction()
    {

        $userId = $this->getCurrentUser()->getId();
        if ($userId){
            $place = $this->getRequest()['place'];

            $queryField = "";
            $queryValue = "";

            foreach ( $place as $field => $value){
                $queryField .= ",$field ";
                $queryValue .= ",'$value'";
            }
//        return "INSERT INTO arrival_place (user_id $queryField) VALUES ( $userId $queryValue )";
            Application::getConnection()->query("INSERT INTO arrival_place (user_id $queryField) VALUES ( $userId $queryValue )");
        }

        return ['response' => 'success'];
    }

    public function deleteAction()
    {

        $userId = $this->getCurrentUser()->getId();
        $placeId = $this->getRequest()['place_id'];

        Application::getConnection()->query("DELETE FROM arrival_place WHERE id = $placeId AND user_id = $userId");

        return ['response' => 'success'];
    }


}