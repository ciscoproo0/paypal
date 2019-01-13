<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        header('Location: ../../index.php');
        exit();
    }
    
        $rawpost = file_get_contents('php://input');
        $request = "cmd=_notify-validate&" . $rawpost;
        
        // $postarray = explode('&', $rawpost);
    //     $fields = array();
        
    //     foreach ($postarray as $value) {
    //         $value = explode('=', $value);
    //         if (count($value) == 2) {
    //             if($value[0] === 'payment_date'){
    //                 if (substr_count($keyval[1], '+') === 1) {
    //                     $value[1] = str_replace('+', '%2B', $keyval[1]);
    //                 }
    //             }
    //             $fields[$value[0]] = urldecode($value[1]);
    //         }
    //     }
        
    //     $request = "cmd=_notify-validate";
    //     $get_magic_quotes_exists = false;
        
    //     if (function_exists('get_magic_quotes_gpc')) {
    //         $get_magic_quotes_exists = true;
    //     }
    //     foreach ($fields as $key => $value) {
    //         if($get_magic_quotes_exists === true && get_magic_quotes_gpc() == 1){
            
    //         $value = urldecode(stripslashes($value));
            
    //     }else{
    //         $value = urlencode($value);
    //     }
    //     $request .= "&" . $key . "=" . "$value";

    // }
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "https://ipnpb.sandbox.paypal.com/cgi-bin/webscr");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    
    $response = curl_exec($ch);
    
    curl_close($ch);
    
    file_put_contents("test.txt", $response);
    var_dump($response);
    

?>