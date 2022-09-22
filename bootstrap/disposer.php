<?php
use QSoft\Foundation\Disposer;

Disposer::addLaravel(new \QSoft\Commands\TestCommand());
Disposer::addLaravel(new \QSoft\Commands\SeedCommand());
