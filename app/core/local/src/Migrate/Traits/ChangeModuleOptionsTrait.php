<?php

namespace QSoft\Migrate\Traits;

use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\Config\Option;
use Exception;

trait ChangeModuleOptionsTrait
{
    /**
     * @return void
     * @throws ArgumentOutOfRangeException
     * @throws Exception
     */
    public function up()
    {
        $this->validateClass();

        global $DB;
        $DB->StartTransaction();

        foreach ($this->options as $name => $value) {
            Option::set($this->module, $name, $value['to']);
        }

        $DB->Commit();
    }

    /**
     * @return void
     * @throws ArgumentOutOfRangeException
     * @throws Exception
     */
    public function down()
    {
        $this->validateClass();

        global $DB;
        $DB->StartTransaction();

        foreach ($this->options as $name => $value) {
            Option::set($this->module, $name, $value['from']);
        }

        $DB->Commit();
    }

    /**
     * @throws Exception
     */
    private function validateClass(): void
    {
        if (!property_exists($this, 'module')) {
            throw new Exception('Can not find $module class property');
        }
        if (!property_exists($this, 'options')) {
            throw new Exception('Can not find $options class property');
        }
    }
}