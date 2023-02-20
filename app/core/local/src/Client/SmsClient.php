<?php

namespace QSoft\Client;

use Psr\Log\LogLevel;
use QSoft\Environment;
use QSoft\Logger\Logger;

class SmsClient
{
    protected $login;
    protected $apiKey;
    private $apiUrl;

    public function __construct()
    {
        $this->login = getenv('SMS_SERVICE_API_LOGIN');
        $this->apiKey = getenv('SMS_SERVICE_API_KEY');
        $this->apiUrl = getenv('SMS_SERVICE_REQUEST_URL');
    }

    public function sendMessage(string $message, string $phoneNumber)
    {
        if (! Environment::isProd()) {
            return [];
        }

        $data = [
            'to' => $phoneNumber,
            'text' => $message,
            'route' => 'sms',
        ];

        $curlResource = curl_init();
        curl_setopt($curlResource, CURLOPT_URL, $this->apiUrl . '/message');
        curl_setopt($curlResource, CURLOPT_POST, 1);
        curl_setopt($curlResource, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlResource, CURLOPT_HTTPHEADER, $this->getHeaders($data));
        curl_setopt($curlResource, CURLOPT_RETURNTRANSFER, 1);

        return $this->getCurlResult($curlResource);
    }


    protected function getCurlResult($curlResource)
    {
        $response = curl_exec($curlResource);
        $info = curl_getinfo($curlResource);
        curl_close($curlResource);
        $responseArray = json_decode($response, true);

        if (json_last_error() != JSON_ERROR_NONE) {
            $error = new \Exception('Error response format', $info['http_code']);
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);

            throw $error;
        }

        if ($info['http_code'] != 200) {
            $error = new \Exception($responseArray['error_message'], $info['http_code']);
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);

            throw $error;
        }

        return $responseArray;
    }

    protected function getHeaders($data = [])
    {
        ksort($data);
        reset($data);
        $ts = microtime() . rand(0, 10000);

        return [
            'login: ' . $this->login,
            'ts: ' . $ts,
            'sig: '. md5(implode('', $data) . $ts . $this->apiKey),
        ];
    }
}