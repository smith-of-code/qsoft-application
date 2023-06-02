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
        $session = Application::getInstance()->getSession();
        try {
            if ($session->get('arrival_place')){
                $this->addAction($session->get('arrival_place'));
            }
        }catch ( \Bitrix\Main\DB\SqlQueryException $e){

        }
        $session->remove('arrival_place');

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

    public function addAction($place = null)
    {
//            var_dump('dddddddddddd');
//            exit();
        $userId = $this->getCurrentUser()->getId();

        $insertedId = 0;

        if ($userId){
            $place = $place ?? $this->getRequest()['place'];

            $queryField = "";
            $queryValue = "";

            foreach ( $place as $field => $value){
                if ($field !== 'id'){
                    $queryField .= ",$field ";
                    $queryValue .= ",'$value'";
                }

            }

        $conn = Application::getConnection();
        $conn->query("INSERT INTO arrival_place (user_id $queryField) VALUES ( $userId $queryValue )");
        $insertedId = $conn->getInsertedId();

        }else{
            $session = Application::getInstance()->getSession();
            $session->set('arrival_place',$this->getRequest()['place']);
            $session->save();

        }

        return [
            'response' => 'success',
            'id' => (string) $insertedId
            ];
    }

    public function deleteAction()
    {

        $userId = $this->getCurrentUser()->getId();
        $placeId = $this->getRequest()['place_id'];

        Application::getConnection()->query("DELETE FROM arrival_place WHERE id = $placeId AND user_id = $userId");

        return ['response' => 'success'];
    }


}