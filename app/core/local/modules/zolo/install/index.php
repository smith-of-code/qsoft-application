<?php

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;

includeModuleLangFile(__FILE__);
if (class_exists('zolo'))
	return;

class zolo extends CModule
{
	var $MODULE_ID = 'zolo';
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
        $result = CopyDirFiles(
            __DIR__ . '/admin',
            "$_SERVER[DOCUMENT_ROOT]/bitrix/admin",
            true,
            true
        );
        $result = $result && CopyDirFiles(
            __DIR__ . '/css',
            Application::getDocumentRoot() . '/bitrix/css/' . $this->MODULE_ID . '/',
            true,
            true
        );
        return $result && CopyDirFiles(
            __DIR__ . '/js',
            Application::getDocumentRoot() . '/bitrix/js/' . $this->MODULE_ID . '/',
            true,
            true
        );
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
        DeleteDirFiles(__DIR__ . '/admin', "{$_SERVER['DOCUMENT_ROOT']}/bitrix/admin");
        Directory::deleteDirectory(Application::getDocumentRoot() . '/bitrix/css/' . $this->MODULE_ID);
        Directory::deleteDirectory(Application::getDocumentRoot() . '/bitrix/js/' . $this->MODULE_ID);
        return true;
	}

}
