<?php
    $_SESSION['IPN'] = file_get_contents('php://input');

    $ipn = $_SESSION['IPN'];
    
    $responseNvp = explode('&', $ipn);    

    foreach ($responseNvp as $key => $value){
        echo "<li>$key: $value</li>";
    }

?>
