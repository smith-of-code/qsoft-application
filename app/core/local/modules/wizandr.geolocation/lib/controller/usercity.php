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
        ];
    }



    public function savecityAction(){

        $session = \Bitrix\Main\Application::getInstance()->getSession();
        $session->set('current_city', $this->getRequest()['city']);

        return true;

    }

}