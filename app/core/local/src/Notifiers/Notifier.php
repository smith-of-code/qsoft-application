<?php

namespace QSoft\Notifiers;

interface Notifier
{
    public function getTitle(): string;

    public function getMessage(): string;

    public function getLink(): string;
}
