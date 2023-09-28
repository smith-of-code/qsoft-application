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

class UserTypeMigrationCreator extends MigrationCreator
{
    public function getBuilder($method)
    {
        $class = '\\QSoft\\Migration\\Builder\\'.ucfirst($method).'UserTypeBuilder';
        return new $class();
    }

    protected function generate(BuilderInterface $builder, $data)
    {


        if (empty($data['consolidatedUserTypeId']))
            $data['consolidatedUserTypeId'] = $this->identityRepository->generateId();

        return parent::generate($builder, $data);
    }


}