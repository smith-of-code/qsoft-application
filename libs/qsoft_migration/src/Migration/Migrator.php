<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 10.08.15
 * Time: 17:48
 */

namespace QSoft\Migration;

use Illuminate\Database\ConnectionResolverInterface as Resolver;
use Illuminate\Database\Migrations\MigrationRepositoryInterface;
use Illuminate\Filesystem\Filesystem;

class Migrator extends \Illuminate\Database\Migrations\Migrator
{
    protected $identifyRepository;

    /**
     * Create a new migrator instance.
     *
     * @param  \Illuminate\Database\Migrations\MigrationRepositoryInterface $repository
     * @param DatabaseIdentifyRepository $identifyRepository
     * @param  \Illuminate\Database\ConnectionResolverInterface $resolver
     * @param  \Illuminate\Filesystem\Filesystem $files
     */
    public function __construct(MigrationRepositoryInterface $repository,
                                DatabaseIdentifyRepository $identifyRepository,
                                Resolver $resolver,
                                Filesystem $files)
    {
        $this->identifyRepository = $identifyRepository;
        parent::__construct($repository, $resolver, $files); // TODO: Change the autogenerated stub
    }

    /**
     * Determine if the migration repository exists.
     *
     * @return bool
     */
    public function repositoryExists()
    {
        return $this->identifyRepository->repositoryExists() && parent::repositoryExists();
    }


}