<?php

class createpayment{
    public function create(){
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