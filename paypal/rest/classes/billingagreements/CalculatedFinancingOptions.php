<?php

require_once '../Oauth.php';
require_once '../CurlCommand.php';
header('Content-type: application/json'); 

$cfo = new CalculatedFinancingOptions();
$cfo->Execute();

class CalculatedFinancingOptions{
    public function Execute(){
        $bearer = new Oauth();
        $callAPI = new CurlCommand();
        $url = "https://api.sandbox.paypal.com/v1/credit/calculated-financing-options";
        $headers = array("Content-Type: application/json", "Authorization: " .$bearer->getToken());
        $fields = json_encode(array (
            'financing_country_code' => 'BR',
            'transaction_amount' => 
            array (
              'value' => '40.00',
              'currency_code' => 'BRL',
            ),
            'funding_instrument' => 
            array (
              'type' => 'BILLING_AGREEMENT',
              'billing_agreement' => 
              array (
                'billing_agreement_id' => 'B-34F52062K6982543Y',
              ),
            ),
          ));
          $response = $callAPI->RunCurl($url, $headers, $fields);
          echo $response;

    }
}

?>