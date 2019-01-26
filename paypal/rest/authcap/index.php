<?php

require ("../../layouts/layout.php");

?>
</br>

<center><h3>Checkout with Authorization and Capture</h3></center>
</br>
<body>
    <br/>
    <br/>
    <br/>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST']?>/rest/authcap/serverside.js"></script>



    <div class="row">

    <!-- #region EC JSV4 button -->
        <div class="col-sm-12 col-md-6 col-lg-6">
        <center><h4>EC JSV4 button</h4></center>
        </br>
            <center><div id="paypal-button"></div></center>
            </br>
            </br>
            <div id="capture">
                <center><button type="button" class="btn btn-dark" id="captureButton" name="captureButton">Capture</button></center>
            </div>
        </div>


    <!-- #endregion -->

    <!-- #region CreatePayment/ExecutePayment -->
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h4>Request-Response Create Payment</h4>
            <button class="btn btn-info buttonCalls" id="requestCreateButton">Request</button>
                <div id="requestCreate">
                </div>
            </br>
            </br>
            <button class="btn btn-info buttonCalls" id="responseCreateButton">Response</button>
                <div id="responseCreate">
                </div>
            </br>
            </br>
            <h4>Request-Response ExecutePayment</h4>
            <button class="btn btn-info buttonCalls" id="requestExecuteButton">Request</button>
                <div id="requestExecute">
                </div>
            </br>
            </br>
            <button class="btn btn-info buttonCalls" id="responseExecuteButton">Response</button>
                <div id="responseExecute">
                </div>

            </br>
            </br>
            <h4>Request-Response Capture Payment</h4>
            <button class="btn btn-info buttonCalls" id="requestCaptureButton">Request</button>
                <div id="requestCapture">
                </div>
            </br>
            </br>
            <button class="btn btn-info buttonCalls" id="responseCaptureButton">Response</button>
                <div id="responseCapture">
                </div>
        </div>
    <!-- #endregion -->

    </div>

    <!-- #region Script CollapseButtons -->
        <script type="text/javascript" name="CollapseButtons">
                $(document).ready(function(){
                    $('#captureButton').hide();

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

                    $('#requestCapture').hide();
                    $('#requestCaptureButton').click(function(){
                        $('#requestCapture').toggle("slow"); 
                    });

                    $('#responseCapture').hide();
                    $('#responseCaptureButton').click(function(){
                        $('#responseCapture').toggle("slow"); 
                    });
                    
            });
        </script>
    <!-- #endregion -->

    <!-- #region Script Capture Action -->
        <script>
            $('#captureButton').click(function(){
                $.ajax({
                url: CaptureRequestPath,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    $("#requestCapture").html("<pre>"+JSON.stringify(response, null, 2)+"</pre>");
                    console.log("---------- Request from Capture Payment ----------");
                    console.log(response);
                    $.ajax({
                    url: CaptureResponsePath,
                    type: 'POST',
                    dataType: 'json',
                    data: {authid: authID},
                    success: function(response){
                        $("#responseCapture").html("<pre>"+JSON.stringify(response, null, 2)+"</pre>");
                        console.log("---------- Response from Capture Payment ----------");
                        console.log(response);
                    },
                    error: function(err){console.log(err);}
                    });
                },
                error: function(err){console.log(err);}
                });
            });
        </script>
    <!-- #endregion -->

</body>