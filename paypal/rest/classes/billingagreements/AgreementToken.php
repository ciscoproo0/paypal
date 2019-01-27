<?php

require_once '../Oauth.php';
require_once '../CurlCommand.php';
header('Content-type: application/json'); 

$agreementToken = new AgreementToken();
$agreementToken->CreateAgreementToken();

class AgreementToken{
    public function CreateAgreementToken(){
        $bearer = new Oauth();
        $callAPI = new CurlCommand();
        $url = "https://api.sandbox.paypal.com/v1/billing-agreements/agreement-tokens";
        $headers = array("Content-Type: application/json", "Authorization: " .$bearer->getToken());
        $fields = json_encode(array(
            'description' => 'Billing Agreement',
            'shipping_preference' => 'NO_SHIPPING',
            'payer' => 
            array (
              'payment_method' => 'PAYPAL',
            ),
            'plan' => 
            array (
              'type' => 'MERCHANT_INITIATED_BILLING',
              'merchant_preferences' => 
              array (
                'return_url' => 'https://example.com/return',
                'cancel_url' => 'https://example.com/cancel',
                'notify_url' => 'https://example.com/notify',
                'accepted_pymt_type' => 'INSTANT',
                'skip_shipping_address' => true,
                'immutable_shipping_address' => true,
              ),
            ),
          ));


        $response = $callAPI->RunCurl($url, $headers, $fields);
        echo $response;
    }
}
?>