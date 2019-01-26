<?php
    $_SESSION['IPN'] = $_POST;

    $ipn = $_SESSION['IPN'];

    $responseNvp = array();
 
    if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $ipn, $matches)) {
        foreach ($matches['name'] as $offset => $name) {
            $responseNvp[$name] = $matches['value'][$offset];
        }
    }

    echo $responseNvp;
?>
