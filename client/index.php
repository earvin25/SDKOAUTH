<?php

namespace App;

use App\Provider\ProviderOAuth;
use App\Provider\ProviderFacebook;
use App\Provider\ProviderDiscord;
use App\Provider\ProviderGithub;

require 'Autoloader.php';

Autoloader::register();  

$oauth = new ProviderOAuth("621f59c71bc35","621f59c71bc36","7c87e53920649da9f70ad55dfa1b5537");
$facebook = new ProviderFacebook("514698773548279","d1cc636edd4732f455393652373708a0","82714ab233f684de9b4583977fb48e97");
$discord = new ProviderDiscord("996457276435091497", "kRLv_8K8ixoUGTYUlp-0qjRj3Eh-Sbhk", "82714ab233f684de9b4583977fb48e97");
$github = new ProviderGithub("02be84b090da249f3f51", "037ea48f88b4aa7da4c2688c0311455ab051e8f5", "82714ab233f684de9b4583977fb48e97");

$route = strtok($_SERVER["REQUEST_URI"], "?");

switch ($route) {
    case '/login':
        $oauth->handleLogin();
        echo ' '; 
        $facebook->handleLogin();
        echo ' '; 
        $discord->handleLogin();
        echo ' '; 
        $github->handleLogin();
        break;
    case '/callback':
        $oauth->handleOauthSuccess();
        break;
    case '/fb_callback':
        $facebook->handleFacebookSuccess();
        break;
    case '/discord_callback':
        $discord->handleDiscordSuccess();
        break;
    case '/github_callback':
        $github->handleGithubSuccess();
        break;
    default:
        http_response_code(404);
        break;
}