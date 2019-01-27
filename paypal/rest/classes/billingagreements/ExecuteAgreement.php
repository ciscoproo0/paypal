<?php

require_once '../Oauth.php';
require_once '../CurlCommand.php';
require_once '../STC.php';
header('Content-type: application/json'); 

$agreementToken = new ExecuteAgreement();
$agreementToken->Execute();

class ExecuteAgreement{
    public function Execute(){
        $bearer = new Oauth();
        $callAPI = new CurlCommand();
        $stc = new STC();
        $url = "https://api.sandbox.paypal.com/v1/payments/payment";
        $headers = array("Content-Type: application/json", "Authorization: " .$bearer->getToken());
        $fields = json_encode(array (
            'intent' => 'sale',
            'payer' => 
            array (
              'payment_method' => 'paypal',
              'funding_instruments' => 
              array (
                0 => 
                array (
                  'billing' => 
                  array (
                    'billing_agreement_id' => 'B-34F52062K6982543Y',
                  ),
                ),
              ),
            ),
            'transactions' => 
            array (
              0 => 
              array (
                'amount' => 
                array (
                  'total' => '40.00',
                  'currency' => 'BRL',
                ),
                'description' => 'Pagamento Tokenizado',
                'payment_options' => 
                array (
                  'allowed_payment_method' => 'IMMEDIATE_PAY',
                ),
                'item_list' => 
                array (
                  'items' => 
                  array (
                    0 => 
                    array (
                      'name' => 'Camiseta preta',
                      'description' => 'Ac/DC',
                      'quantity' => '1',
                      'price' => '20.00',
                      'currency' => 'BRL',
                    ),
                    1 => 
                    array (
                      'name' => 'Camiseta Azul',
                      'description' => 'Jimmy Hendrix',
                      'quantity' => '1',
                      'price' => '20.00',
                      'currency' => 'BRL',
                    ),
                  ),
                ),
              ),
            ),
            'note_to_payer' => 'Amostra de Referece Transactions',
            'application_context' => 
            array (
              'shipping_preference' => 'NO_SHIPPING',
            ),
            'redirect_urls' => 
            array (
              'return_url' => 'https://retornecoxinha.com',
              'cancel_url' => 'https://cancelepizza.com',
            ),
          ));
        
        $response = $callAPI->RunCurl($url, $headers, $fields);
        //$stc->Execute();
        echo $response;
    }
}

?>