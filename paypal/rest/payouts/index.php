<?php

require_once ("../../layouts/layout.php");
require_once ("../../rest/classes/CreatePayment.php");

?>
</br>

<script src="https://www.paypalobjects.com/webstatic/ppplusdcc/ppplusdcc.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<body>

<h1>Payouts</h1>
</br>

<!-- #region Form Payouts -->
    <form id="payouts" action="../../rest/classes/CreatePayouts.php" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="valueLabel">Value</label>
                <input class="form-control" type="text" placeholder="10.00" value="10.00" id="value" name="value">
            </div>
            <div class="form-group col-md-6">
                <label for="currencyLabel">Currency</label>
                <input class="form-control" type="text" placeholder="BRL" value="BRL" id="currency" name="currency">
            </div>
            <div class="form-group col-md-6">
                <label for="noteLabel">Note</label>
                <input class="form-control" type="text" placeholder="Thanks" value="Thanks" id="note" name="note">
            </div>
            <div class="form-group col-md-6">
                <label for="senderLabel">Sender Item ID</label>
                <input class="form-control" type="text" placeholder="Shirt-xv229900" value="Shirt-xv229900" id="sender_item_id" name="sender_item_id">
            </div>
            <div class="form-group col-md-6">
                <label for="receiverLabel">receiver</label>
                <input class="form-control" type="text" placeholder="francisco-buyer@gmail.com" value="francisco-buyer@gmail.com" id="receiver" name="receiver">
            </div>
        </div>
        <center><button type="submit" class="btn btn-primary">Submit</button></center>
    </form>
    </br>
<!-- #endregion -->

<!-- #region Response Payouts Region -->
    <center><button class="btn btn-primary" id="responseButton" name="responseButton">Payouts Response</button></center>    
    <div id="responsePayouts" name="responsePayouts">  
    </div>
<!-- #endregion -->

<!-- #region Script CollapseButtons -->
    <script type="text/javascript" name="CollapseButtons">
        $(document).ready(function(){
            $('#responsePayouts').hide();
            $('#responseButton').click(function(){
                $('#responsePayouts').toggle("slow"); 
            });
        });
    </script>
<!-- #endretion -->

<!-- #region Script Form Payouts -->
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/rest/payouts/postForm.js"></script>
<!-- #endregion -->