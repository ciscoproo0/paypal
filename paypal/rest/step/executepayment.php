<?php
header('Content-type: application/json'); 
 
$Execute = new executepayment();
$Execute->executepay();

class executepayment{
    public function executepay(){

        $PayerID = $_POST['payerID'];
        $Execute = $_POST['paymentID'];
        $bearer = $_POST['bearer'];
        $url = $Execute;
        $headers = array("Content-Type: application/json", "Authorization: ".$bearer);
        $fields = json_encode(array("payer_id"=>"".$PayerID));


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