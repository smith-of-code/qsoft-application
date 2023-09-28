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

class GroupRightMigrationCreator extends MigrationCreator
{
    public function getBuilder($method)
    {
        if (empty($data['consolidatedGroupId']))
            $data['consolidatedGroupId'] = $this->identityRepository->generateId();

        $class = '\\QSoft\\Migration\\Builder\\'.ucfirst($method).'GroupRightBuilder';
        return new $class();
    }
}