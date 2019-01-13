<?php

require_once 'Oauth.php';
require_once 'CurlCommand.php';

$payment = new CreatePayment();
$payment->PayPalCheckout();

class CreatePayment{

    public  function PayPalCheckout(){
        $bearer = new Oauth();
        $callAPI = new CurlCommand();
        $url = "https://api.sandbox.paypal.com/v1/payments/payment";
        $headers = array("Content-Type: application/json", "Authorization: " .$bearer->getToken());
        $fields = json_encode(array(
          'intent' => 'sale',
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
                'total' => '180.00',
                'currency' => 'BRL',
              ),
              'description' => 'Pagamento server side',
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
                    'price' => '90.00',
                    'currency' => 'BRL',
                  ),
                  1 => 
                  array (
                    'name' => 'Bolsa',
                    'description' => 'Bolsa Azul',
                    'quantity' => '1',
                    'price' => '90.00',
                    'currency' => 'BRL',
                  ),
                ),
              ),
            ),
          ),
          'note_to_payer' => 'Se estiver lendo isso. Problema seu!',
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
  
        if(isset($_GET['action'])) {
          $action = $_GET['action'];
        
        if ($action == "PayPalCheckout") {
          echo $response;
        
          }
        }else{
          $approval = json_decode($response);
          $_SESSION['createpayment'] = $approval;
          $_SESSION['approval'] = $approval->links[1]->href;
          $_SESSION['execute'] = $approval->id;
          $_SESSION['requestpayment'] = json_decode($fields, true);
          return $approval->links[1]->href;
        }
  }
}