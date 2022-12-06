<?php
use QSoft\Foundation\Disposer;

Disposer::addLaravel(new \QSoft\Commands\TestCommand());
Disposer::addLaravel(new \QSoft\Commands\SeedCommand());

Disposer::addLaravel(new \QSoft\Commands\ReInitBeneficiaries());
Disposer::addLaravel(new \QSoft\Commands\OfferCommand());
