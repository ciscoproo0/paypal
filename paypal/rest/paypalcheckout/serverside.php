<?php

require ("../../layouts/layout.php");


?>
<br/>
<center><h3>Server Side Button</h3></center>
<body>
<br/>
<br/>
<br/>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/rest/paypalcheckout/serverside.js"></script>


<div id="paypal-button"></div>




</body>
