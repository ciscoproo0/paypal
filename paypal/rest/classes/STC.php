<?php

require_once 'Oauth.php';
require_once 'CurlCommand.php';
header('Content-type: application/json'); 

$stc = new STC();
$stc->Execute();

class STC{
    public function Execute(){
        $bearer = new Oauth();
        $callAPI = new CurlCommand();
        $url = "https://api.sandbox.paypal.com/v1/risk/transaction-contexts/INVOICE1/B-34F52062K6982543Y";
        $method = "PUT";
        $headers = array("Content-Type: application/json", "Authorization: " .$bearer->getToken());
        $fields = json_encode(array (
            'additional_data' => 
            array (
              0 => 
              array (
                'key' => 'sender_account_id',
                'value' => '10000600',
              ),
              1 => 
              array (
                'key' => 'sender_first_name',
                'value' => 'Francisco',
              ),
              2 => 
              array (
                'key' => 'sender_last_name',
                'value' => 'Silva',
              ),
              3 => 
              array (
                'key' => 'sender_email',
                'value' => 'francisco@teste.com',
              ),
              4 => 
              array (
                'key' => 'sender_phone',
                'value' => '11999998999',
              ),
              5 => 
              array (
                'key' => 'sender_country_code',
                'value' => 'BR',
              ),
              6 => 
              array (
                'key' => 'sender_address_state',
                'value' => 'SP',
              ),
              7 => 
              array (
                'key' => 'sender_address_city',
                'value' => 'São Paulo',
              ),
              8 => 
              array (
                'key' => 'sender_address_zip',
                'value' => '01310100',
              ),
              9 => 
              array (
                'key' => 'sender_address_line1',
                'value' => 'Avenida Paulista, 1048',
              ),
              10 => 
              array (
                'key' => 'sender_address_line2',
                'value' => 'Bela Vista',
              ),
              11 => 
              array (
                'key' => 'sender_create_date',
                'value' => '15/06/2017',
              ),
              12 => 
              array (
                'key' => 'sender_signup_ip',
                'value' => '200.155.10.50',
              ),
              13 => 
              array (
                'key' => 'cd_string_one',
                'value' => 'Vestuario',
              ),
            ),
          ));

        $response = $callAPI->CustomCurl($url, $headers, $fields, $method);
        echo $response;
    }
}

?>