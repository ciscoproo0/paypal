<?php

require_once ("../../layouts/layout.php");

?>
</br>
<body>

<h1>Step by Step PayPal Checkout</h1>
</br>

<center><h3>Call API to get an access Token</h3></center>

<!-- #region Script PP+ and Listener -->
    <script src="https://www.paypalobjects.com/webstatic/ppplusdcc/ppplusdcc.min.js" type="text/javascript"></script>
<!-- #endregion -->

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
    <center><div id="bearer" name="bearer">
    </div></center>
<!-- #endregion -->
<hr>
<!-- #region Create Payment -->
    <div id="create">
        </br>
        <center><h3>Create Payment</h3></center>
        </br>
        <form id="createpayment" action="../../rest/step/createpayment.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="clientIdLabel">Item Name</label>
                    <input class="form-control" type="text" value="Tênis" id="name" name="name" placeholder="Tênis">
                </div>
                <div class="form-group col-md-3">
                    <label for="secretLabel">Description</label>
                    <input class="form-control" type="text" value="Tênis nike" id="itemsdescription" name="itemsdescription" placeholder="Tênis nike">
                </div>
                <div class="form-group col-md-3">
                    <label for="secretLabel">quantity</label>
                    <input class="form-control" type="text" value="1" id="quantity" name="quantity" placeholder="2">
                </div>
                <div class="form-group col-md-3">
                    <label for="secretLabel">price</label>
                    <input class="form-control" type="text" value="200.00" id="price" name="price" placeholder="200.00">
                </div>
                <div class="form-group col-md-3">
                    <label for="secretLabel">currency</label>
                    <input class="form-control" type="text" value="BRL" id="currency" name="currency" placeholder="BRL">
                </div>
                <div class="form-group col-md-3">
                    <label for="secretLabel">Note To Payer</label>
                    <input class="form-control" type="text" value="Exemplo de compra teste" id="note_to_payer" name="note_to_payer" placeholder="exemplo de compra teste">
                </div>   
                <div class="form-group col-md-3">
                    <label for="secretLabel">Payment Description</label>
                    <input class="form-control" type="text" value="Compra feita na loja teste do Francisco" id="description" name="description" placeholder="Compra feita na loja teste do Francisco">
                </div>     
                <div class="form-group col-md-3">
                    <label for="secretLabel">Total Purchase</label>
                    <input class="form-control" type="text" value="200.00" id="amounttotal" name="amounttotal" placeholder="200.00">
                </div>  
                <div class="form-group col-md-3">
                    <label for="secretLabel">Currency Total Purchase</label>
                    <input class="form-control" type="text" value="BRL" id="amountcurrency" name="amountcurrency" placeholder="BRL">
                </div> 
                <div class="form-group col-md-3">
                    <input class="form-control" type="text" value="" id="bearertoken" name="bearertoken" hidden>
                </div>          
            </div>
            <center><button type="submit" class="btn btn-primary" id="createButton">create</button></center>
        </form>
    </div>
<!-- #endregion -->
<hr>
<!-- #region Response Create -->
    <center><div id="responsecreate" name="responsecreate">
    </div></center>
<!-- #endregion -->
<hr>
<!-- #region PayPal Plus -->
    <div id="ppplus"></div>
    <center><button class="btn btn-info " type="submit" id="continueButton" onclick="ppp.doContinue(); return false;"> Checkout </button></center>
<!-- #endregion -->
<hr>
<!-- #region Response Execute -->
    <center><div id="responseexecute"></div></center>
<!-- #endregion -->
<!-- #region Script hideDivs/Buttons -->
 <script type="text/javascript" name="hideDivs">
        sessionStorage.clear();
        $(document).ready(function(){
            $('#create').hide();
            $('#responsecreate').hide();
            //$('#ppplus').hide();
            $('#continueButton').hide();
        });
    </script>
<!-- #endretion -->

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

                    //stores bearer token
                    sessionStorage.setItem('bearer', message);

                    //show bearer token
                    $("#bearer").show().html("<pre><h5>" + JSON.stringify(message, null, 2) +"</h5></pre>");
                    document.querySelector('#bearertoken').value = sessionStorage.getItem('bearer');
                    $("#create").show();
                }
            });
        });
    </script>
<!-- #endregion -->

<!-- #region Create Payment -->
    <script type="text/javascript" name="calltoken">
    var ppp = null;
        $('#createpayment').submit(function(e){
            e.preventDefault();
                var approval = null;
                $.ajax({
                    url: '../../rest/step/createpayment.php',
                    type: 'post',
                    data: $('#createpayment').serialize(),
                    success:function(message){
                    var response = JSON.parse(message);
                    console.log(response);
                    sessionStorage.setItem('execute', response.links[2].href);

                    $("#responsecreate").show().html("<pre>" + JSON.stringify(response, null, 2)+"</pre>");
                    $('#continueButton').show();
                    //$('#ppplus').show().css('height', '500px');
                    //$('iframe').css('height', '500px');
                    //var ppobj = sessionStorage.getItem('ppobj');  
                        ppp = PAYPAL.apps.PPP({
                        approvalUrl: response.links[1].href,
                        country: "BR",
                        language: "pt_BR",
                        placeholder: "ppplus",
                        mode: "sandbox",
                        payerEmail: "franciscoteste@chicote.com",
                        payerFirstName: "Chico",
                        payerLastName: "do teste Silva",
                        payerTaxId: "42648123059",
                        payerTaxIdType: "BR_CPF",
                        payerPhone: "11970638989"
                    });
                }
            });
        });
    </script>
<!-- #endregion -->

<!-- #region PPPlus obj -->

<!-- #endregion -->

<!-- #region Listener -->
    <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/rest/step/pluslistener.js"></script>
<!-- #endregion -->
