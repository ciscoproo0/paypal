<?php

$token = new config();
$token->getToken();

class config{
    public function getToken(){
        
        if(!isset($_POST)){
            $client = '';
            $secret = '';
            }else{
            $client = $_POST['clientid'];
            $secret = $_POST['secret'];
            }
            $url = "https://api.sandbox.paypal.com/v1/oauth2/token";
            $headers = array("Accept: " => "application/json", "Accept-Language" => "en_US");
            $fields = array("grant_type"=>"client_credentials");
            
            $curl = curl_init();
            
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
            curl_setopt($curl, CURLOPT_USERPWD, "$client:$secret");
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields));
            
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_VERBOSE, 1);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            
            
            $execute = curl_exec($curl);
            
            curl_close($curl); 
            
            $response = json_decode($execute, true);
            
            echo "Bearer ". str_replace('"','',$response['access_token']);
            

    }
}



?>