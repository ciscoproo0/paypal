<?php

require_once '../Oauth.php';
require_once '../CurlCommand.php';
header('Content-type: application/json'); 

$agreement = new Agreements();
$agreement->CreateAgreement();

class Agreements{
    public function CreateAgreement(){
        $bearer = new Oauth();
        $callAPI = new CurlCommand();
        $url = "https://api.sandbox.paypal.com/v1/billing-agreements/agreements";
        $headers = array("Content-Type: application/json", "Authorization: " .$bearer->getToken());
        $fields = json_encode(array("token_id" => "BA-3VA949087J892384V"));

        $response = $callAPI->RunCurl($url, $headers, $fields);
        echo $response;
    }
}

?>