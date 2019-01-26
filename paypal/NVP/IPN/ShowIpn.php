<?php
    $_SESSION['IPN'] = $_POST;

    $ipn = $_SESSION['IPN'];
    
    $responseNvp = explode('&', $ipn);    

    foreach ($responseNvp as $key => $value){
        echo "<li>$key: $value</li>";
    }

?>
