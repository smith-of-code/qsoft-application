<?php
namespace Wizandr\Geolocation\Controller;

use \Bitrix\Main\Error;

class Item extends \Bitrix\Main\Engine\Controller
{
    public function addAction(array $fields)
    {
        return 'fffff333';
//        $item = Item::add($fields);
//
//        if (!$item)
//        {
//            $this->addError(new Error('Could not create item.', 333));
//
//            return null;
//        }
//
//        return $item->toArray();
    }

    public function viewAction($id)
    {
        return 'ffff3332445563';
//        $item = Item::getById($id);
//        if (!$item)
//        {
//            $this->addError(new Error('Could not find item.', 4444}));
//
//            return null;
//        }
//
//        return $item->toArray();
    }
}