<?php

use Symfony\Component\Finder\Finder;

$application = getApplication();

foreach (Finder::create()->files()->name('*.php')->in(QSOFT_APPLICATION_ROOT . '/config') as $file) {
    $application['config']->set(basename($file->getRealPath(), '.php'), require $file->getRealPath());
}
