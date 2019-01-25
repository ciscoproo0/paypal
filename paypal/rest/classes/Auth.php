<?php

require_once 'Oauth.php';
require_once 'CurlCommand.php';

$payment = new Auth();
$payment->Authorize();

class Auth{

    public  function Authorize(){
        $bearer = new Oauth();
        $callAPI = new CurlCommand();
        $url = "https://api.sandbox.paypal.com/v1/payments/payment";
        $headers = array("Content-Type: application/json", "Authorization: " .$bearer->getToken());
        $fields = json_encode(array(
          'intent' => 'authorize',
          'payer' => 
          array (
            'payment_method' => 'paypal',
          ),
          'transactions' => 
          array (
            0 => 
            array (
              'amount' => 
              array (
                'total' => '120.00',
                'currency' => 'BRL',
              ),
              'description' => 'Pagamento com autorização',
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
                    'name' => 'Chapéu',
                    'description' => 'Chapéu azul',
                    'quantity' => '1',
                    'price' => '60.00',
                    'currency' => 'BRL',
                  ),
                  1 => 
                  array (
                    'name' => 'Bolsa',
                    'description' => 'Bolsa Azul',
                    'quantity' => '1',
                    'price' => '60.00',
                    'currency' => 'BRL',
                  ),
                ),
              ),
            ),
          ),
          'note_to_payer' => 'Amostra de autorização',
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

        if(isset($_GET['action']) && !empty($_GET['action'])) {
          $action = $_GET['action'];

          if($action = 'requestCreate'){
            header('Content-type: application/json');
            echo $fields;            
          }
        }else{
        $execute = $callAPI->RunCurl($url, $headers, $fields);
        
        echo $execute;
        }
  }
}