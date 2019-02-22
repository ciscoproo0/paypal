<?php

require ("../../layouts/layout.php");

?>
</br>

<center><h3>Braintree Solutions</h3></center>
</br>

<center><div id="paypal-button"></div></center>


<!-- Load the required checkout.js script -->
<script src="https://www.paypalobjects.com/api/checkout.js" data-version-4></script>

<!-- Load the required Braintree components. -->
<script src="https://js.braintreegateway.com/web/3.39.0/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.39.0/js/paypal-checkout.min.js"></script>

<!-- #region callToken script -->
    <script id="callToken">
    var token = null
    // $('#paypal-button').click(function(){
        $(document).ready(function(){
        $.ajax({
                url: "/braintree/ppcheckout/server.php?action=ClientToken",
                type: 'GET',
                dataType: 'json',
                    success: function(response){
                            console.log(response);
                            token = response;
                            
                            // Render PayPal Button, iniciates contact with Braintree Server and your server.
                            paypal.Button.render({
                                braintree: braintree,
                                client:{
                                    sandbox: token
                                },
                                env: 'sandbox',
                                commit: true,

                                payment: function (data, actions){
                                    return actions.braintree.create({
                                        flow: 'checkout',
                                        amount:'10.00',
                                        currency: 'BRL',
                                        enableShippingAddress: false
                                    });
                                },
                                onAuthorize: function (payload){
                                    console.log("payload.nonce");
                                    console.log(payload.nonce);
                                    $.ajax({
                                        url: "/braintree/ppcheckout/server.php?action=nonce&nonce_="+payload.nonce,
                                        type: 'POST',
                                        dataType: 'application/x-www-form-urlencoded',
                                        data:{
                                            nonce: payload.nonce
                                        },
                                        success: function(response){
                                            console.log("-----Payment Response -----");
                                            console.log(response);
                                        },
                                        error: function(err){
                                            console.log("-----Payment Error -----");
                                            console.log(err);
                                        }
                                    });
                                },
                            }, '#paypal-button');
                            },
                    error: function(err){
                        console.log(err);
                        }
                    });
                });
    </script>
<!-- #endregion -->

<!-- #region BT script -->
    <script id="BT">

    </script>
<!-- #endregion -->

