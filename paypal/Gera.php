<?php

$gera = new Gera();
$gera->geradorPessoa();
$gera->geradorCartao();
$gera->RandomID(16);

class Gera{
    
    public function geradorPessoa(){

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.4devs.com.br/ferramentas_online.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "acao=gerar_pessoa&cep_estado=SP",
        CURLOPT_HTTPHEADER => array("Content-Type: application/x-www-form-urlencoded"),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
    }
    public function geradorCartao(){

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.4devs.com.br/ferramentas_online.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "acao=gerar_cc&pontuacao=S&bandeira=master",
        CURLOPT_HTTPHEADER => array("Content-Type: application/x-www-form-urlencoded"),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo "<div id='cartao'>" . $response. "</div>";
        }
    }
}

?>