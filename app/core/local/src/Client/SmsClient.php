<?php

namespace QSoft\Client;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class SmsClient
{
    private const BRAND_NAME = 'Zolo';

    private ClientInterface $httpClient;

    private string $apiKey;
    private string $requestUrl;

    public function __construct()
    {
        $this->httpClient = new Client;
        $this->apiKey = getenv('SMS_SERVICE_API_KEY');
        $this->requestUrl = getenv('SMS_SERVICE_REQUEST_URL');
    }

    public function sendMessage(string $message, string $phoneNumber): array
    {
        $response = $this->httpClient->request('POST', $this->requestUrl, [
            'query' => [
                'method' => 'push_msg',
                'format' => 'json',
                'key' => $this->apiKey,
                'sender_name' => self::BRAND_NAME,
                'text' => $message,
                'phone' => $phoneNumber,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }
}