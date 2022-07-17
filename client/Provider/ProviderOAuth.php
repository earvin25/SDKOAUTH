<?php

namespace App\Provider;


class ProviderOAuth extends Provider
{

    protected $clientId;
    protected $clientSecret;
    protected $state;
    protected $apiUrl = "http://server:8080/me";
    protected $url = "http://server:8080/token";
    protected $redirectUri = "http://localhost:8081/callback";

    private $scope = ["basic"];

    /**
     * GithubProvider constructor.
     * @param $clientId
     * @param $clientSecret
     * @param $state
     */
    public function __construct($clientId, $clientSecret, $state)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->state = $state;
    }


    public function handleLogin()
    {
        echo "<a href='http://localhost:8080/auth"
            . "?client_id=" . $this->clientId
            . "&redirect_uri=http://localhost:8081/callback"
            . "&scope=" . implode(",",$this->scope)
            . "&state=" . $this->state 
            . "'>Se connecter avec Oauth Server</a>";
    }


    public function handleOauthSuccess()
    {
        $getToken = $this->getToken();
        $array = [
            'Authorization: Bearer ' .  $getToken->access_token
        ];

        var_dump($this->getInfos($this->urlUser,$array));
    }

}