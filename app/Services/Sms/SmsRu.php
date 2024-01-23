<?php

namespace App\Services\Sms;

use GuzzleHttp\Client;

class SmsRu implements SmsSenderInterface
{
    public function __construct(
        private Client $client,
        private string $appId,
        private string $url = 'https://sms.ru/sms/send',
    )
    {
        if (empty($this->appId)) {
            throw new \InvalidArgumentException('Sms appId must be set');
        }
    }

    public function send($number, $text): void
    {
        $response = $this->client->post($this->url, [
           'form_params' => [
               'api_id' => $this->appId,
               'to' => '+' . $number,
               'text' => $text
           ]
        ]);
    }
}
