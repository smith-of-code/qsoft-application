<?php
namespace QSoft\Common;
\Bitrix\Main\Loader::includeModule('iblock');
use \Bitrix\Iblock\Iblock;

class DataSource
{   
    private $iblock;
    private $parameters;

    public function __construct($iblock_id, $limit = 15)
    {
        $this->iblock = Iblock
            ::wakeUp($iblock_id)
            ->getEntityDataClass();
        $this->parameters['limit'] = $limit;
    }

    public function __call($name, $opt)
    {
        $this->parameters[$name] = $opt[0];
        return $this;
    }

    public function getElements($offset = 0)
    {   
        $this->parameters['offset'] = $offset;
        return $this->getData();
    }

    private function getData()
    {
        return $this
            ->iblock
            ::getList($this->parameters)
            ->fetchAll();
    }
}