<?php

namespace QSoft\Events;

interface Notifier
{
    public function getTitle(): string;

    public function getMessage(): string;

    public function getLink(): string;
}
