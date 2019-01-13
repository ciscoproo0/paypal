<?php

require ("../../layouts/layout.php");

?>
</br>

<center><h3>Client Side Button</h3></center>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
</head>

<body>
</br>
</br>
</br>
    <center><div id="paypal-button-container"></div></center>
<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/rest/paypalcheckout/clientside.js"></script>
</body>
