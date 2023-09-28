<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 10.08.15
 * Time: 16:45
 */

namespace QSoft\Migration\Creators;

use QSoft\Migration\MigrationCreator;
use TwigGenerator\Builder\BuilderInterface;

class IblockPropertyMigrationCreator extends MigrationCreator
{
    public function getBuilder($method)
    {
        $class = '\\QSoft\\Migration\\Builder\\'.ucfirst($method).'IblockPropertyBuilder';
        return new $class();
    }

    protected function generate(BuilderInterface $builder, $data)
    {
        $data['additional'] = $data['additional_last'] = '';

        if (empty($data['consolidatedIblockPropertyId']))
            $data['consolidatedIblockPropertyId'] = $this->identityRepository->generateId();

        if (isset($data['fields']['IBLOCK_ID']))
            $data['additional'] .= '$fields[\'IBLOCK_ID\'] = '.$this->addConsolidationWrapper($data['fields']['IBLOCK_ID'], 'iblock').";\r\n";

        if (isset($data['fields']['LINK_IBLOCK_ID']))
            $data['additional'] .= '$fields[\'LINK_IBLOCK_ID\'] = '.$this->addConsolidationWrapper($data['fields']['LINK_IBLOCK_ID'], 'iblock').";\r\n";

        if (isset($data['lastFields']['IBLOCK_ID']))
            $data['additional_last'] .= '$lastFields[\'IBLOCK_ID\'] = '.$this->addConsolidationWrapper($data['lastFields']['IBLOCK_ID'], 'iblock').";\r\n";

        if (isset($data['lastFields']['LINK_IBLOCK_ID']))
            $data['additional_last'] .= '$lastFields[\'LINK_IBLOCK_ID\'] = '.$this->addConsolidationWrapper($data['lastFields']['LINK_IBLOCK_ID'], 'iblock').";\r\n";


        return parent::generate($builder, $data);
    }


}