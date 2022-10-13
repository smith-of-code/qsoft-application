<?php

includeModuleLangFile(__FILE__);
if (class_exists('additionalsupport'))
	return;

class additionalsupport extends CModule
{
	var $MODULE_ID = 'additionalsupport';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_GROUP_RIGHTS = 'Y';

	public function __construct()
	{
		$arModuleVersion = [];

		include(__DIR__.'/version.php');

		if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
		{
			$this->MODULE_VERSION = $arModuleVersion['VERSION'];
			$this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
		}

		$this->MODULE_NAME = getMessage('SUPPORT_ADD_MODULE_NAME');
		$this->MODULE_DESCRIPTION = getMessage('SUPPORT_ADD_MODULE_DESCRIPTION');
	}

	function doInstall()
	{
		$this->installFiles();
		$this->installDB();
		$this->installEvents();
	}

	function installDB()
	{
		registerModule($this->MODULE_ID);
		return true;
	}

	function installEvents()
	{
		return true;
	}

	function installFiles()
	{
		return true;
	}

	function doUninstall()
	{
		$this->uninstallDB();
		$this->uninstallFiles();
		$this->uninstallEvents();
	}

	function uninstallDB($arParams = [])
	{
		unregisterModule($this->MODULE_ID);
		
		return true;
	}

	function uninstallEvents()
	{
		return true;
	}

	function uninstallFiles()
	{
		return true;
	}

}
