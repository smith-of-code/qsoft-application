<?php

namespace QSoft\Client;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class SmsClient
{
    private string $brandName = 'Zolo';

    private ClientInterface $httpClient;

    private string $apiKey;
    private string $requestUrl;

    public function __construct(string $brandName = null)
    {
        if ($brandName) {
            $this->brandName = $brandName;
        }

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
                'sender_name' => $this->brandName,
                'text' => $message,
                'phone' => $phoneNumber,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }
}