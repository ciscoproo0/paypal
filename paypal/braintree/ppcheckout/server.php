<?php

require_once "../braintree-php/lib/Braintree.php";
error_reporting(0);


$server = new server();

if(isset($_GET['action'])){
    if($_GET['action'] == 'ClientToken'){
        header('Content-type: application/json'); 
        $server->ClientToken();
    }elseif($_GET['action'] == 'nonce'){
        $server->Nonce();
    }
}
class server{

    //returns Client Token to be used in front-end
    function ClientToken(){
        
        $gateway = new Braintree_Gateway(['accessToken' => 'access_token$sandbox$5svrddpy8s3mx4jw$d0190491ecb39683ca118b73bf4061b7']);

        $clientToken = $gateway->clientToken()->generate();
        echo json_encode($clientToken);
    }
    function Nonce(){
        $nonce = $_POST['nonce_'];

        $gateway = new Braintree_Gateway(['accessToken' => 'access_token$sandbox$5svrddpy8s3mx4jw$d0190491ecb39683ca118b73bf4061b7']);
        $result = $gateway->transaction()->sale([
            "amount" => "10.00",
            "merchantAccountID" => "BRL",
            "paymentMethodNonce" => $nonce
        ]);
        file_put_contents('../../responsebt.txt', $result);
        if($result->success){
            print_r("Success ID" . $result->transaction->id);
        }else{
            print_r("Error Message: ". $result->message);
        }
    }
}


?>