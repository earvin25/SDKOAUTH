<?php

namespace App;

use App\Provider\ProviderOAuth;
use App\Provider\ProviderFacebook;

require 'Autoloader.php';

Autoloader::register();  

$oauth = new ProviderOAuth("621f59c71bc35","621f59c71bc36","7c87e53920649da9f70ad55dfa1b5537");
$facebook = new ProviderFacebook("514698773548279","d1cc636edd4732f455393652373708a0","82714ab233f684de9b4583977fb48e97");

$route = strtok($_SERVER["REQUEST_URI"], "?");

switch ($route) {
    case '/login':
        $oauth->handleLogin();
        echo ' '; 
        $facebook->handleLogin();
        break;
    case '/callback':
        $oauth->handleOauthSuccess();
        break;
    case '/fb_callback':
        $facebook->handleFacebookSuccess();
        break;
    default:
        http_response_code(404);
        break;
}