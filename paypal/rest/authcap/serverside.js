var hostName = window.location.origin;

var pathCreate ="/rest/classes/Auth.php";
var pathExecute ="/rest/classes/ExecutePayment.php";

var CreatePaymentPath = hostName+pathCreate;
var ExecutePaymentPath = hostName+pathExecute;
var CreateResponsePath = CreatePaymentPath + "?action=requestCreate";

paypal.Button.render({
    env: 'sandbox',

    style: {
      label: 'paypal',
      size:  'medium',    // small | medium | large | responsive
      shape: 'rect',     // pill | rect
      color: 'silver',     // gold | blue | silver | black
      tagline: false    
  },

    //Set up payment with CreatePayment Path
    payment: function(data, actions) {

      return actions.request.post(CreatePaymentPath).then(function(res) {

          console.log("---------- Response from Create Payment ----------");
          console.log(res);
            $.ajax({
              url: CreateResponsePath,
              type: 'GET',
              dataType: 'json',
              success: function(response){
                //populates Div with Json
                $("#requestCreate").html("<pre>"+JSON.stringify(response, null, 2)+"</pre>");
              },
              error: function(err){console.log(err);}
            });          
          //populates Div with Json       
          $("#responseCreate").html("<pre>"+JSON.stringify(res, null, 2)+"</pre>");
          return res.id;
        });
      },

    //execute payment wit ExecutePayment Path
    onAuthorize: function(data, actions) {
        var request = {
          paymentID: data.paymentID,
          payerID:   data.payerID
        }

        console.log("---------- Request from Execute Payment ----------");
        console.log(JSON.stringify(request));
        
        //populates Div with Json
        $("#requestExecute").html("<pre>"+JSON.stringify(request, null, 2)+"</pre>");

        return actions.request.post(ExecutePaymentPath, {
        paymentID: data.paymentID,
        payerID:   data.payerID
      }).then(function(res) {

          console.log("---------- Response from Execute Payment ----------");
          console.log(res);
          $("#responseExecute").html("<pre>"+JSON.stringify(res, null, 2)+"</pre>");
          $("#captureButton").show();
          var resobj = res;
          var saleID = resobj.transactions['0'].related_resources['0'].sale['id']; 
          var state = resobj.transactions['0'].related_resources['0'].sale['state'];
            console.log(resobj);
            console.log(saleID);
        });
    }
  }, '#paypal-button');

