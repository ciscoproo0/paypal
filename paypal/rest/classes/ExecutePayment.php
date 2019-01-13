<?php

require_once 'Oauth.php';
require_once 'CurlCommand.php';
header('Content-type: application/json'); 
 
$Execute = new ExecutePayment();
$Execute->ExecutePay();

class ExecutePayment{
    public function ExecutePay(){
        $bearer = new Oauth();
        $callAPI = new CurlCommand();
        $PayerID = $_POST['payerID'];
        $PaymentID = $_POST['paymentID'];
        $headers = array("Content-Type: application/json", "Authorization: ".$bearer->getToken());
        $fields = json_encode(array("payer_id"=>"".$PayerID));
        $url = "https://api.sandbox.paypal.com/v1/payments/payment/".$PaymentID."/execute";

        $response = $callAPI->RunCurl($url, $headers, $fields);
        
        $_SESSION['executepayment'] = $response;
        $_SESSION['requestexecute'] = json_decode($fields, true);
        echo $response;
    }
}