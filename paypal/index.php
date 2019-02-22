<?php

require ("layouts/layout.php");

session_start();

?>
</br>

<center><h3><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/rest/paypalcheckout/index.php">PayPal Express</h3></center>

</br>

<center><h3><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/rest/paypalplus/index.php">PayPal Plus</h3></center>

</br>

<center><h3><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/rest/payouts/index.php">Payouts</h3></center>

</br>

<center><h3><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/rest/authcap/index.php">Authorization and Capture</h3></center>
</br>

<center><h3><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/rest/billing/index.php">Billing Agreements</h3></center>
</br>

<center><h3><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/braintree/index.php">Braintree</h3></center>

