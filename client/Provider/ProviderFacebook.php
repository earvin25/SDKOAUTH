<?php
namespace App\Provider;

use App\Core\FunctionRequest;

class ProviderFacebook extends Provider
{

    protected $clientId;
    protected $clientSecret;
    protected $state;
    protected $urlUser = "https://graph.facebook.com/v2.10/me";
    protected $url = "https://graph.facebook.com/v2.10/oauth/access_token";
    protected $redirectUri = "http://localhost:8081/fb_callback";

    private $scope = ["email"];

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
        echo "<a href='https://www.facebook.com/v2.10/dialog/oauth?response_type=code"
            . "&client_id=" . $this->clientId
            . "&scope=" . implode(",",$this->scope)
            . "&state=" . $this->state
            . "&redirect_uri=http://localhost:8081/fb_callback'>Se connecter avec Facebook</a>";
    }


    public function handleFacebookSuccess()
    {
        $getToken = $this->getToken();
        $array = [
            'Authorization: Bearer ' .  $getToken->access_token
        ];

        var_dump($this->getInfos($this->urlUser,$array));
    }

}