<?php

require_once ("../../layouts/layout.php");

?>
</br>
<body>

<h1>Step to Step PayPal Checkout</h1>
</br>

<center><h3>Call API to get an access Token</h3></center>

<!-- #region Credentials -->
    <form id="token" action="../../rest/step/config.php" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="clientIdLabel">ClientID</label>
                <input class="form-control" type="text" value="AQMvz-l3XHRLi2aHA0oSANfks5l-VwwS40Los6JPnGCLFceyXAN1LTnharyA0s5GrsFjYhh2iNxpeNrj" id="clientid" name="clientid" placeholder="clientid">
            </div>
            <div class="form-group col-md-6">
                <label for="secretLabel">Secret</label>
                <input class="form-control" type="text" value="EDjYV3HndXdvNAbTYRcmSX9oZBHYFzqciEaasVUJd4Huez84IJCmtKZ1N_IM4Vs6Gh3BE_CX0NYxf4eD" id="secret" name="secret" placeholder="secret">
            </div>
        </div>
        <center><button type="submit" class="btn btn-primary">Get Token</button></center>
    </form>
    </br>
<!-- #endregion -->

<!-- #region Div Bearer -->
    <center><div id="bearer">
    </div></center>
<!-- #endregion -->

<!-- #region Create Payment -->
    <div id="create">
        <form id="createpayment" action="../../rest/step/createpayment.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="clientIdLabel">ex1</label>
                    <input class="form-control" type="text" value="" id="" name="" placeholder="">
                </div>
                <div class="form-group col-md-3">
                    <label for="secretLabel">ex2</label>
                    <input class="form-control" type="text" value="" id="" name="" placeholder="">
                </div>
                <div class="form-group col-md-3">
                    <label for="secretLabel">ex3</label>
                    <input class="form-control" type="text" value="" id="" name="" placeholder="">
                </div>
            </div>
            <center><button type="submit" class="btn btn-primary">create</button></center>
        </form>
    </div>
<!-- #endregion -->

<!-- #region Call Token -->
    <script type="text/javascript" name="calltoken">
        $('#token').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '../../rest/step/config.php',
                type: 'post',
                data: $('#token').serialize(),
                success:function(message){
                console.log(message);
                $("#bearer").show().html("<pre><h5>" + JSON.stringify(message, null, 2) +"</h5></pre>");
                $("#create").show().slow();
            }
            });
        });
    </script>
<!-- #endregion -->

<!-- #region Script hideDivs -->
<script type="text/javascript" name="hideDivs">
        $(document).ready(function(){
            $('#create').hide();
        });
    </script>
<!-- #endretion -->
