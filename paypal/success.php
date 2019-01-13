<?php

require ("layouts/layout.php");
require ("rest/classes/GetSaleInfo.php");

?>
</br>

<center><h1>Success!</h1></center>
<br/>
<br/>
<br/>

<center><h3>Your Transaction ID is</h3></center>

<center><pre><h4>
<?php
    $getInfo = new GetSaleInfo();
   $saleID = json_decode($getInfo->getInfo(), true);
   echo $saleID["payments"]["0"]["transactions"]["0"]["related_resources"]["0"]["sale"]["id"];
    
   
?>

</h4></pre></center>

<center><h4>Response Body Last Transaction</h4></center>

<pre>
<?php
    echo json_encode($saleID, JSON_PRETTY_PRINT);
?>
</pre>