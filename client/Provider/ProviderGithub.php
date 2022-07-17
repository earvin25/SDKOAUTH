<?php
namespace App\Provider;

class ProviderGithub extends Provider
{

    protected $clientId;
    protected $clientSecret;
    protected $state;
    protected $urlUser = "https://api.github.com/user";
    protected $url = "https://github.com/login/oauth/access_token";
    protected $redirectUri = "http://localhost:8081/github_callback";

    private $scope = ["user"];

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
        echo "<a href='https://github.com/login/oauth/authorize?response_type=code"
            . "&client_id=" . $this->clientId
            . "&scope=" . implode(",",$this->scope)
            . "&state=" . $this->state
            . "&redirect_uri=http://localhost:8081/github_callback"
            . "&prompt=consent'>Se connecter avec Github</a>";
    }


    public function handleGithubSuccess()
    {
        $getToken = $this->getToken();

        $array = [
            'Authorization: Bearer ' .  $getToken->access_token,
            'User-Agent: PHP'
        ];

        var_dump($this->getInfos($this->urlUser,$array));
    }


}