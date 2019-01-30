var hostName = window.location.origin;

var pathBillingToken ="/rest/classes/billingagreements/AgreementToken.php";
var pathBilling ="/rest/classes/billingagreements/Agreements.php";

var BillingTokenPath = hostName+pathBillingToken;
var BillingPath = hostName+pathBilling;
var RequestBillingToken = hostName+pathBillingToken + "?action=requestBillingToken";
var billingID = null;


paypal.Button.render({
    env: 'sandbox',

    style: {
      label: 'paypal',
      size:  'medium',    // small | medium | large | responsive
      shape: 'rect',     // pill | rect
      color: 'blue',     // gold | blue | silver | black
      tagline: false    
  },

    //Set up payment with CreatePayment Path
    payment: function(data, actions) {
        $.ajax({
            url: RequestBillingToken,
            type: 'GET',
            dataType: 'json',
            success: function(response){
    
              console.log("---------- Request from BillingToken ----------");
              console.log(response);
              //populates Div with Json
              $("#requestBillingToken").html("<pre>"+JSON.stringify(response, null, 2)+"</pre>");
            },
            error: function(err){console.log(err);}
          });  
      return actions.request.post(pathBillingToken)
        .then(function(response) {
            console.log("---------- Response from BillingToken ----------");
            console.log(response);

            //populates Div with Json
            $("#responseBillingToken").html("<pre>"+JSON.stringify(response, null, 2)+"</pre>");
          return response.token_id;
        });
    },

    //execute payment wit ExecutePayment Path
    onAuthorize: function(data, actions) {
        var request = {
            billingToken: data.billingToken
          }  
          console.log("---------- Request from Billing ----------");
          console.log(request);
          
          //populates Div with Json
          $("#requestBilling").html("<pre>"+JSON.stringify(request, null, 2)+"</pre>");

      // 2. Make a request to your server
      return actions.request.post(pathBilling, {
        billingToken: data.billingToken
      })
        .then(function(response) {
            console.log("---------- Response from Billing ----------");
            console.log(response);
            $("#responseBilling").html("<pre>"+JSON.stringify(request, null, 2)+"</pre>");
            $('#referenceTransaction').show();
            billingID = response.id;
        });
    }
  }, '#paypal-button');