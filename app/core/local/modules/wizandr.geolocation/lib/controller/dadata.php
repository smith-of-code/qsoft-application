<?php

namespace Wizandr\Geolocation\Controller;

use Bitrix\Main\Engine\Controller;

use Bitrix\Main\Application;

class Dadata extends Controller
{


    public function configureActions(): array
    {
        return [
            'suggest' => [
                'prefilters' => [
                    new \Bitrix\Main\Engine\ActionFilter\Csrf(),
                ]
            ],
        ];
    }





    public function suggestAction(){
        $token = "b714c8a4d4ca56388036421eba8705054660b17b";
        $secret = "24f241f126e828907e21a452b295184874d6b3b2";
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

}