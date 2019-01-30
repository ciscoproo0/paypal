<?php

require ("../../../layouts/layout.php");

?>
</br>

<center><h3>Reference Transactions</h3></center>
</br>
<body>
    <br/>
    <br/>
    <br/>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST']?>/rest/billing/reftrans/serverside.js"></script>



    <div class="row">

    <!-- #region EC JSV4 button -->
        <div class="col-sm-12 col-md-6 col-lg-6">
        <center><h4>EC JSV4 button</h4></center>
        </br>
            <center><div id="paypal-button"></div></center>
            </br>
            </br>
            <div id="referenceTransaction">
                <center><button type="button" class="btn btn-dark" id="referenceTransaction" name="referenceTransaction">Pay</button></center>
            </div>
        </div>


    <!-- #endregion -->

    <!-- #region CreatePayment/ExecutePayment -->
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h4>Request-Response Billing AgreementToken</h4>
            <button class="btn btn-info buttonCalls" id="requestBillingTokenButton">Request</button>
                <div id="requestBillingToken">
                </div>
            </br>
            </br>
            <button class="btn btn-info buttonCalls" id="responseBillingTokenButton">Response</button>
                <div id="responseBillingToken">
                </div>
            </br>
            </br>
            <h4>Request-Response Billing Agreement</h4>
            <button class="btn btn-info buttonCalls" id="requestBillingButton">Request</button>
                <div id="requestBilling">
                </div>
            </br>
            </br>
            <button class="btn btn-info buttonCalls" id="responseBillingButton">Response</button>
                <div id="responseBilling">
                </div>
            </br>
            </br>
            <h4>Request-Response Execute Agreement (Create Payment)</h4>
            <button class="btn btn-info buttonCalls" id="requestExecuteAgreementButton">Request</button>
                <div id="requestExecuteAgreement">
                </div>
            </br>
            </br>
            <button class="btn btn-info buttonCalls" id="responseExecuteAgreementButton">Response</button>
                <div id="responseExecuteAgreement">
                </div>
        </div>
    <!-- #endregion -->

    </div>

    <!-- #region Script CollapseButtons -->
        <script type="text/javascript" name="CollapseButtons">
                $(document).ready(function(){
                    $('#referenceTransaction').hide();

                    $('#requestBillingToken').hide();
                    $('#requestBillingTokenButton').click(function(){
                        $('#requestBillingToken').toggle("slow"); 
                    });
                    
                    $('#responseBillingToken').hide();
                    $('#responseBillingTokenButton').click(function(){
                        $('#responseBillingToken').toggle("slow"); 
                    });
                    
                    $('#requestBilling').hide();
                    $('#requestBillingButton').click(function(){
                        $('#requestBilling').toggle("slow"); 
                    });

                    $('#responseBilling').hide();
                    $('#responseBillingButton').click(function(){
                        $('#responseBilling').toggle("slow"); 
                    });   

                    $('#requestExecuteAgreement').hide();
                    $('#requestExecuteAgreementButton').click(function(){
                        $('#requestExecuteAgreement').toggle("slow"); 
                    });

                    $('#responseExecuteAgreement').hide();
                    $('#responseExecuteAgreementButton').click(function(){
                        $('#responseExecuteAgreement').toggle("slow"); 
                    });                 
            });
        </script>
    <!-- #endregion -->

    <!-- #region ReferenceTransaction Script -->
    <script src="http://<?php echo $_SERVER['HTTP_HOST']?>/rest/billing/reftrans/referencetransaction.js"></script>
    <!-- #endregion -->