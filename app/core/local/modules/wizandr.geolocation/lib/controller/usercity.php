<?php

namespace Wizandr\Geolocation\Controller;

use Bitrix\Main\Engine\Controller;

use Bitrix\Main\Application;

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
            'dadata' => [
                'prefilters' => [
                    new \Bitrix\Main\Engine\ActionFilter\Csrf(),
                ]
            ],
        ];
    }


    public function listAction()
    {

        $userId = $this->getCurrentUser()->getId();

        $result = Application::getConnection()->query("SELECT * FROM arrival_place WHERE user_id= $userId ");
        $result2 =[];
        while($row = $result->fetch()){
            $result2[] = $row;
        }
        return $result2;
    }

    public function addAction()
    {

        $userId = $this->getCurrentUser()->getId();
        $place = $this->getRequest()['place'];

        $queryField = "";
        $queryValue = "";

        foreach ( $place as $field => $value){
            $queryField .= ",$field ";
            $queryValue .= ",'$value'";
        }
//        return "INSERT INTO arrival_place (user_id $queryField) VALUES ( $userId $queryValue )";
        Application::getConnection()->query("INSERT INTO arrival_place (user_id $queryField) VALUES ( $userId $queryValue )");

        return ['response' => 'success'];
    }

    public function deleteAction()
    {

        $userId = $this->getCurrentUser()->getId();
        $placeId = $this->getRequest()['place_id'];

        Application::getConnection()->query("DELETE FROM arrival_place WHERE id = $placeId AND user_id = $userId");

        return ['response' => 'success'];
    }


    public function dadataAction(){
        $token = "d14f5865165472e5fc9288d50700f30cc54128f8";
        $secret = "cf1faf5049c7e257a4a50e2a1ea1c436a4d0a942";
        $dadata = new \Dadata\DadataClient($token, $secret);


//        $dadata->suggest($this->getRequest());

        $response = $dadata->suggest("address", $this->getRequest()['query'], 5, [
//            "locations" => [
//                ['kladr_id'=> "2601700000000"]
//            ],
//            'locations_boost'=>[
//                ['kladr_id'=> "2601700200000"]
//            ],
            'restrict_value'=>true,
            'from_bound'=>['value'=>'city'],
            'to_bound'=>['value'=> $this->getRequest()['only_city']?'city':'house']

        ]);
        return $response;

    }


    public function savecityAction(){

        $session = \Bitrix\Main\Application::getInstance()->getSession();
        $session->set('current_city', $this->getRequest()['city']);

            return true;


    }

}