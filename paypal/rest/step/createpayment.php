<?php

$payment = new createpayment();
$payment->create();
class createpayment{
    public function create(){

        $bearer = $_POST['bearertoken'];
        $url = "https://api.sandbox.paypal.com/v1/payments/payment";
        $headers = array("Content-Type: application/json", "Authorization: " .$bearer);
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
                'total' => $_POST['amounttotal'],
                'currency' => $_POST['amountcurrency'],
              ),
              'description' => $_POST['description'],
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
                    'name' => $_POST['name'],
                    'description' => $_POST['itemsdescription'],
                    'quantity' => $_POST['quantity'],
                    'price' => $_POST['price'],
                    'currency' => $_POST['currency'],
                  ),
                ),
              ),
            ),
          ),
          'note_to_payer' => $_POST['note_to_payer'],
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

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
    
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $response = curl_exec($curl);

        curl_close($curl); 

        echo $response;
    }
}

?>