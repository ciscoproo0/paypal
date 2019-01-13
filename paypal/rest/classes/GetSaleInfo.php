<?php

require_once 'Oauth.php';
require_once 'CurlCommand.php';
header('Content-type: application/json'); 


class GetSaleInfo{
    public function getInfo(){
        $callAPI = new CurlCommand();
        $bearer = new Oauth();
        $url = "https://api.sandbox.paypal.com/v1/payments/payment?count=5&start_index=0";
        $headers = array("Content-Type: application/json", "Authorization: ".$bearer->getToken());
        
        $response = $callAPI->getDetails($url, $headers);

        return $response;
    }
}