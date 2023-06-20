<?php

namespace Wizandr\Geolocation\Controller;

use Bitrix\Main\Engine\Controller;

use Bitrix\Main\Application;

class Dadata extends Controller
{
    private $token = "b714c8a4d4ca56388036421eba8705054660b17b";
    private $secret = "24f241f126e828907e21a452b295184874d6b3b2";

    public function configureActions(): array
    {
        return [
            'suggest' => [
                'prefilters' => [
                    new \Bitrix\Main\Engine\ActionFilter\Csrf(),
                ]
            ],
            'address' => [
                'prefilters' => [
                    new \Bitrix\Main\Engine\ActionFilter\Csrf(),
                ]
            ],
        ];
    }





    public function suggestAction(){

        // Создаем экземпляр класса CPHPCache
        $cache = \Bitrix\Main\Data\Cache::createInstance();

        $cache_key = 'dadata_suggest_'.md5(json_encode($this->getRequest()->toArray()));

        // Устанавливаем время жизни кэша в 3600 секунд (1 час) и уникальный ключ "my_unique_cache_key"
        if ($cache->initCache(3600, $cache_key)) {
            // Если данные есть в кэше, то извлекаем их
            $arResult = $cache->getVars();
        } else {
            // Если данных нет в кэше, то получаем их из какого-либо источника

            $dadata = new \Dadata\DadataClient($this->token, $this->secret);

            $arResult =  $dadata->suggest("address", $this->getRequest()['query'], 50, [
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

            // Сохраняем данные в кэше
            if($cache->startDataCache()) {
                // Кэшируем данные с помощью метода endDataCache
                $cache->endDataCache($arResult);
            }
        }

        return $arResult;





    }

    public function addressAction(){

        // Создаем экземпляр класса CPHPCache
        $cache = \Bitrix\Main\Data\Cache::createInstance();

        $cache_key = 'dadata_adress_'.md5(json_encode($this->getRequest()->toArray()));

        // Устанавливаем время жизни кэша в 3600 секунд (1 час) и уникальный ключ "my_unique_cache_key"
        if ($cache->initCache(180000, $cache_key)) {
            // Если данные есть в кэше, то извлекаем их
            $arResult = $cache->getVars();
        } else {
            // Если данных нет в кэше, то получаем их из какого-либо источника

            $dadata = new \Dadata\DadataClient($this->token, $this->secret);

            $arResult = $dadata->geolocate("address", $this->getRequest()['lat'],$this->getRequest()['lon'],100, $this->getRequest()['count']);

            // Сохраняем данные в кэше
            if($cache->startDataCache()) {
                // Кэшируем данные с помощью метода endDataCache
                $cache->endDataCache($arResult);
            }
        }

        return $arResult;
    }



}