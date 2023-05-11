<?php

namespace Wizandr\Geolocation\Controller;

use Bitrix\Main\Engine\Controller;

use Bitrix\Main\Application;

class Usercity extends Controller
{
    public function addAction()
    {

        $userId = $this->getCurrentUser()->getId();
        $place = $this->getRequest()['place'];
        Application::getConnection()->query("INSERT INTO arrival_place (user_id, arrival) VALUES (150, ' $place ')");
        return $this->getCurrentUser()->getId();
        $request = $this->getRequest();

        return ['response' => 'success'];
    }

    public function deleteAction()
    {

        return $this->getCurrentUser()->getId();
        $request = $this->getRequest();

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
            'to_bound'=>['value'=>'house']

        ]);
        return $response;

    }
}