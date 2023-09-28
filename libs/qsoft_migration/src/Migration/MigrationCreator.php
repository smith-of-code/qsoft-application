<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 07.08.15
 * Time: 18:17
 */

namespace QSoft\Migration;

use QSoft\Database\ConnectionResolver;
use TwigGenerator\Builder\BuilderInterface;
use TwigGenerator\Builder\Generator;

abstract class MigrationCreator
{

    protected $identityRepository;

    public function __construct() {
        $this->identityRepository = new DatabaseIdentifyRepository(new ConnectionResolver(), env('MIGRATION_IDENTIFY_TABLE', 'migration_identify'));
        $this->useDefaultGenerator();
    }

    protected $generator;

    protected $useDefaultGenerator = false;

    protected $path;

    protected $entity;

    protected $preset = false;

    protected $fileName;

    public function create($data = []) {
        return $this->generate($this->getBuilder('create'), $data);
    }

    public function update($data = []) {
        return $this->generate($this->getBuilder('update'), $data);
    }

    public function remove($data = []) {
        return $this->generate($this->getBuilder('remove'), $data);
    }

    abstract function getBuilder($method);

    protected function addConsolidationWrapper($realId, $type) {

        $id = $this->identityRepository->getConsolidatedIdentity($realId, $type);
        if (!$id) return $realId;

        return '$this->getRealId(\''.$id.'\', \''.$type.'\')';

    }

    protected function generate(BuilderInterface $builder, $data) {

        $data['class_name'] = $this->fileName;

        $builder->setOutputName($this->getDatePrefix().'_'.$this->fileName.'.php');

        $generator = $this->getGenerator();

        $generator->setMustOverwriteIfExists(true);
        $generator->setVariables($data);
        $generator->addBuilder($builder);
        $generator->writeOnDisk($this->getPath());

        return $builder->getOutputName();
    }

    public function getGenerator()
    {
        if (is_null($this->generator) && $this->useDefaultGenerator) {
            $this->getDefaultGenerator();
        }

        return $this->generator;
    }

    /**
     * @param mixed $generator
     */
    public function setGenerator($generator)
    {
        $this->generator = $generator;
        return $this;
    }

    public function useDefaultGenerator() {
        $this->useDefaultGenerator = true;
        return $this;
    }

    private function getDefaultGenerator()
    {
        $this->generator = new Generator();
        $this->generator->setTemplateDirs([
            __DIR__.'/templates'
        ]);
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path ?: $this->getDefaultMigrationPath();
    }

    /**
     * Get the date prefix for the migration.
     *
     * @return string
     */
    protected function getDatePrefix()
    {
        return date('Y_m_d_His');
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param boolean $preset
     */
    public function setPreset($preset)
    {
        $this->preset = $preset;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    protected function getDefaultMigrationPath() {
        return QSOFT_CORE_ROOT .'/local/src/Migrate';
    }

    /**
     * @param mixed $name
     */
    public function setFileName($name)
    {
        $this->fileName = $name;
    }
}