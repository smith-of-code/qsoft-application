<?php

namespace QSoft\Common;

class Recaptcha
{
    const SECRET_KEY = '6LcVge8jAAAAAEQIUY3zefNzioTAAphH_wJxHd4Q';
    const URL = 'https://www.google.com/recaptcha/api/siteverify';

    protected $response;

    public function __construct($secretKey = SECRET_KEY)
    {
        $this->secretKey = $secretKey;
    }

    public function isValidResponse($recaptchaResponse)
    {
        $request = curl_init();
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_POST, 1);
        curl_setopt($request, CURLOPT_POSTFIELDS, [
            'secret' => $this->secretKey,
            'response' => $recaptchaResponse,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ]);
        $this->response = curl_exec($request);
        $this->response = json_decode($this->response, true);
        curl_close($request);

        return true;
    }

    public function getResponse()
    {
        return $this->response;
    }
}