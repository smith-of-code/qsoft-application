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

class IblockMigrationCreator extends MigrationCreator
{
    public function getBuilder($method)
    {
        $class = '\\QSoft\\Migration\\Builder\\'.ucfirst($method).'IblockBuilder';
        return new $class();
    }

    protected function generate(BuilderInterface $builder, $data)
    {
        if (empty($data['consolidatedIblockId']))
            $data['consolidatedIblockId'] = $this->identityRepository->generateId();

        return parent::generate($builder, $data);
    }


}