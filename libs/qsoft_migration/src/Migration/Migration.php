<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 10.08.15
 * Time: 17:24
 */

namespace QSoft\Migration;

use QSoft\Database\ConnectionResolver;

class Migration extends \Illuminate\Database\Migrations\Migration
{
    function __construct()
    {
        $this->identityRepository = new DatabaseIdentifyRepository(new ConnectionResolver(), env('MIGRATION_IDENTIFY_TABLE', 'migration_identify'));
    }

    protected function consolidateIdentity($consolidatedId, $realId, $type) {
        $this->identityRepository->registerIdentity($consolidatedId, $realId, $type);
    }

    protected function getRealIdOrDefault($consolidatedId, $realId, $type)
    {
        return $this->identityRepository->getRealIdOrDefault($consolidatedId, $realId, $type);
    }

    protected function getRealId($consolidatedId, $type) {
        $realId = $this->identityRepository->getRealId($consolidatedId, $type);
        if (!$realId) throw new \RuntimeException('Consolidation break!');
        return $realId;
    }

    protected function getConsolidatedIdentity($realId, $type) {
        return $this->identityRepository->getConsolidatedIdentity($realId, $type) ?: $realId;
    }

}