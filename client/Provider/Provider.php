<?php

namespace App\Provider;

use App\Core\FunctionRequest;
use RuntimeException;

class Provider
{

    public function getToken(){

        ["state" => $state, "code" => $code] = $_GET;
        if ($state !== $this->state) {
            throw new RuntimeException("{$state} : invalid state");
        }

        $array = [

            "grant_type" => "authorization_code",
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'code' => $code
        ];

        return FunctionRequest::request($this->url,$array);

    }

    public function getInfos($urlUser,$array){

        return FunctionRequest::request($urlUser,false,$array);

    }
}