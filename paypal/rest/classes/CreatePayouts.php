<?php

require_once 'Oauth.php';
require_once 'CurlCommand.php';
header('Content-type: application/json'); 

$Payouts = new CreatePayouts();
$Payouts->SendPayouts();

class CreatePayouts{
    public function SendPayouts(){
        $callAPI = new CurlCommand();
        $bearer = new Oauth();
        $value = $_POST['value'];
        $currency = $_POST['currency'];
        $note = $_POST['note'];
        $sender_item_id = $_POST['sender_item_id'];
        $receiver = $_POST['receiver'];
        $url = "https://api.sandbox.paypal.com/v1/payments/payouts";
        $headers = array("Content-Type: application/json", "Authorization: ".$bearer->getToken());
        $fields = json_encode(
            array (
                'sender_batch_header' => 
                array (
                  'sender_batch_id' => '066dasaagggdasd',
                  'email_subject' => 'Você recebeu um payout',
                  'email_message' => 'Você recebeu um payout de ciscoproo0-vendedor@paypal.com',
                  'recipient_type' => 'EMAIL',
                ),
                'items' => 
                array (
                  0 => 
                  array (
                    'amount' => 
                    array (
                      'value' => $value,
                      'currency' => $currency,
                    ),
                    'note' => $note,
                    'sender_item_id' => $sender_item_id,
                    'receiver' => $receiver,
                  ),
                ),
              )
        );
        
        $response = $callAPI->RunCurl($url, $headers, $fields);

        return $response;
    }
}