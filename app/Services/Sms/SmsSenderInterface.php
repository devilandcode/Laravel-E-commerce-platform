<?php

namespace App\Services\Sms;

interface SmsSenderInterface
{
    public function send($number, $text): void;
}
