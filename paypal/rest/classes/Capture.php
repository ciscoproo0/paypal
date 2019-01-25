<?php

require_once 'Oauth.php';
require_once 'CurlCommand.php';
header('Content-type: application/json');
 
$Execute = new Capture();
$Execute->CaptureAuth();

class Capture{
    public function CaptureAuth(){
        $bearer = new Oauth();
        $callAPI = new CurlCommand();
        if(isset($_POST['authid']) && !empty($_POST['authid'])){
            $AuthID = $_POST['authid'];
            $headers = array("Content-Type: application/json", "Authorization: ".$bearer->getToken());
            $url = "https://api.sandbox.paypal.com/v1/payments/authorization/".$AuthID."/capture";
        }
        $fields = json_encode(array(
                        'amount' => 
                            array (
                                'currency' => 'BRL',
                                'total' => '120',
                                ),
                        'is_final_capture' => true,
                        ));
        
        if(isset($_GET['action']) && !empty($_GET['action'])) {
            $action = $_GET['action'];
  
            if($action = 'requestCapture'){
                echo $fields;            
            }
          }else{
          $execute = $callAPI->RunCurl($url, $headers, $fields);
            echo $execute;
        }
    }
}