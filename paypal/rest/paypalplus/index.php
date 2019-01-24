<?php

require_once ("../../layouts/layout.php");
require_once ("../../rest/classes/CreatePayment.php");

?>
</br>

<script src="https://www.paypalobjects.com/webstatic/ppplusdcc/ppplusdcc.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<body>

<center><h3>PayPal Plus</h3></center>

<div class="container-fluid">
</br>
        <!-- #region Oauth
            <center><div>
                <form id="createtoken" action="../../rest/classes/Config.php" method="post">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="title">Client ID</label>
                        <input type="text" id="clientid" name="clientid">
                        </br>
                        <label class="title">Secret</label>
                        <input type="text" id="secret" name="secret">
                    </div>
                    <div>
                        <input type="submit" id="submitButton"  name="submitButton" value="Gerar Token">
                    </div>
                </form>
            </div></center>
        <-- #endregion -->

    <div class="row">
            </br>


        <!-- #region PayPal Plus Form -->
            <div class="col-sm-12 col-md-6 col-lg-6">
                <center><h4>PayPal Plus Form</h4></center>
                </br>
                    <div id="ppplusform">
                        <div id="ppplus"></div>
                        <center><button class="btn btn-info " type="submit" id="continueButton" onclick="ppp.doContinue(); return false;"> Checkout </button></center>
                    </div>
                </div>
        <!-- #endregion -->

        <!-- #region CreatePayment/ExecutePayment -->
            <div class="col-sm-12 col-md-6 col-lg-6">
                <h4>Request-Response Create Payment</h4>
                </br>
                <button class="btn btn-info buttonCalls" id="requestCreateButton">Request</button>
                    <div id="requestCreate">
                        <?php 
                        echo "<pre>";
                        echo json_encode($_SESSION['requestpayment'], JSON_PRETTY_PRINT);
                        echo "</pre>";
                        ?>
                    </div>
                </br>
                </br>
                <button class="btn btn-info buttonCalls" id="responseCreateButton">Response</button>
                    <div id="responseCreate">
                        <?php 
                        echo "<pre>";
                        echo json_encode($_SESSION['createpayment'], JSON_PRETTY_PRINT);
                        echo "</pre>";
                        ?>
                    </div>

                <h4>Request-Response ExecutePayment</h4>
                </br>
                <button class="btn btn-info buttonCalls" id="requestExecuteButton">Request</button>
                    <div id="requestExecute">
                    </div>
                    </br>
                    </br>
                <button class="btn btn-info buttonCalls" id="responseExecuteButton">Response</button>
                    <div id="responseExecute">

                    </div>
                </div>
        <!-- #endregion -->
    </div>
</div>


</body>


<!-- #region Script Session Storage -->
    <script>
        sessionStorage.setItem('approval', '<?php echo $_SESSION['approval']; ?>');
        sessionStorage.setItem('execute', '<?php echo $_SESSION['execute']; ?>');
    </script>
<!-- #endregion -->

<!-- #region Script PP+ and Listener -->
    <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/rest/paypalplus/plusjs.js"></script>
    <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/rest/paypalplus/pluslistener.js"></script>
<!-- #endregion -->

<!-- #region Script CollapseButtons -->
    <script type="text/javascript" name="CollapseButtons">
        $(document).ready(function(){
            $('#requestCreate').hide();
            $('#requestCreateButton').click(function(){
                $('#requestCreate').toggle("slow"); 
            });
            
            $('#responseCreate').hide();
            $('#responseCreateButton').click(function(){
                $('#responseCreate').toggle("slow"); 
            });
            
            $('#requestExecute').hide();
            $('#requestExecuteButton').click(function(){
                $('#requestExecute').toggle("slow"); 
            });

            $('#responseExecute').hide();
            $('#responseExecuteButton').click(function(){
                $('#responseExecute').toggle("slow"); 
            });
            
    });
    </script>
<!-- #endregion -->

<!-- #region Script Submit Token -->
    <script type="text/javascript" name="submittoken">
        $('#createtoken').submit(function(event){
            event.preventDefault();

            var $form = $(this), url = $form.attr('action');
            var fields = $.post(url, {clientID: $('#clientid').val(), secret: $('#secret').val()});
            
            posting.done(function(data){
                console.log(data);
            });
        });
    </script>
<!-- #endregion -->


