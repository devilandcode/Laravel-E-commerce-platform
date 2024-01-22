<?php

namespace App\Services\Sms;

class ArraySender implements SmsSenderInterface
{

    public function send($number, $text): void
    {
        private $messages = [];

        public function send($number, $text): void
    {
        $this->messages[] = [
            'to' => '+' . trim($number, '+'),
            'text' => $text
        ];
    }

        public function getMessages(): array
    {
        return $this->messages;
    }
    }
}
