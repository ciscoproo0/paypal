<?php

require_once 'Oauth.php';
require_once 'CurlCommand.php';
header('Content-type: application/json'); 
 
$Execute = new Capture();
$Execute->ExecutePay();

class Capture{
    public function CaptureAuth(){
        $bearer = new Oauth();
        $callAPI = new CurlCommand();
        $AuthID = $_POST['authid'];
        $headers = array("Content-Type: application/json", "Authorization: ".$bearer->getToken());
        $url = "https://api.sandbox.paypal.com/v1/payments/authorization/".$AuthID."/capture";
        $fields = json_encode(array(
                        'amount' => 
                            array (
                                'currency' => 'BRL',
                                'total' => '120',
                                ),
                        'is_final_capture' => true,
                        ));

        $response = $callAPI->RunCurl($url, $headers, $fields);
        
        $_SESSION['executepayment'] = $response;
        $_SESSION['requestexecute'] = json_decode($fields, true);
        
        echo $response;
    }
}