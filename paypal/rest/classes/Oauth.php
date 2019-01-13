<?php

require_once 'Config.php';
require_once 'CurlCommand.php';

//$token = new Oauth();
// $_SESSION['bearer'] = $token->getToken();

//echo $token->getToken();

class Oauth{
    public function getToken(){

        $config = new Config();
        $url = "https://api.sandbox.paypal.com/v1/oauth2/token";
        $headers = array("Accept: " => "application/json", "Accept-Language" => "en_US");
        $fields = array("grant_type"=>"client_credentials");
        $client = $config->getClient();
        $secret = $config->getSecret();
        
        $run = new CurlCommand();
        $response = $run->Bearer($url, $headers, $fields, $client, $secret);

        return $response;
    }
}


?>