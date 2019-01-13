<?php

require_once 'Oauth.php';
require_once 'CurlCommand.php';

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
        $id = $this->RandomID();
        $url = "https://api.sandbox.paypal.com/v1/payments/payouts";
        $headers = array("Content-Type: application/json", "Authorization: ".$bearer->getToken());
        $fields = json_encode(
            array (
                'sender_batch_header' => 
                array (
                  'sender_batch_id' => $id,
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

        echo $response;
    }
    public function RandomID(){
      $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
      $id = '';
      $max = strlen($characters) - 1;
      for ($i = 0; $i < 16; $i++) {
           $id .= $characters[mt_rand(0, $max)];
      }
      return $id;
    }
}