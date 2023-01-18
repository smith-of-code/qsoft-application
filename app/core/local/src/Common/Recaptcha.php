<?php

namespace QSoft\Common;

class Recaptcha
{
    const URL = 'https://www.google.com/recaptcha/api/siteverify';

    protected $response;

    public function __construct()
    {
    }

    public function isValidResponse($recaptchaResponse)
    {
        $request = curl_init();
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_POST, 1);
        curl_setopt($request, CURLOPT_POSTFIELDS, [
            'secret' => getenv('CAPTCHA_PRIVATE_KEY'),
            'response' => $recaptchaResponse,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ]);
        curl_setopt($request, CURLOPT_URL, self::URL);
        $this->response = curl_exec($request);
        $this->response = json_decode($this->response, true);
        curl_close($request);

        return $this->response['success'];
    }

    public function getResponse()
    {
        return $this->response;
    }
}