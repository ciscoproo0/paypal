var hostName = window.location.origin;

var pathCreate ="/rest/classes/Auth.php";
var pathExecute ="/rest/classes/ExecutePayment.php";
var pathCapture = "/rest/classes/Capture.php"

var CreatePaymentPath = hostName+pathCreate;
var ExecutePaymentPath = hostName+pathExecute;
var CreateResponsePath = CreatePaymentPath + "?action=requestCreate";
var CaptureRequestPath = pathCapture + "?action=requestCapture";
var CaptureResponsePath = pathCapture;
var authID = null;

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
      $.ajax({
        url: CreateResponsePath,
        type: 'GET',
        dataType: 'json',
        success: function(response){

          console.log("---------- Request from Create Payment ----------");
          console.log(response);
          //populates Div with Json
          $("#requestCreate").html("<pre>"+JSON.stringify(response, null, 2)+"</pre>");
        },
        error: function(err){console.log(err);}
      });  
      return actions.request.post(CreatePaymentPath).then(function(response) {
          //populates Div with Json
          console.log("---------- Response from Create Payment ----------");
          console.log(response);    
          $("#responseCreate").html("<pre>"+JSON.stringify(response, null, 2)+"</pre>");
          return response.id;
        });
      },

    //execute payment wit ExecutePayment Path
    onAuthorize: function(data, actions) {
        var request = {
          paymentID: data.paymentID,
          payerID:   data.payerID
        }

        console.log("---------- Request from Execute Payment ----------");
        console.log(request);
        
        //populates Div with Json
        $("#requestExecute").html("<pre>"+JSON.stringify(request, null, 2)+"</pre>");

        return actions.request.post(ExecutePaymentPath, {
        paymentID: data.paymentID,
        payerID:   data.payerID
      }).then(function(response) {

          console.log("---------- Response from Execute Payment ----------");
          console.log(response);
          $("#responseExecute").html("<pre>"+JSON.stringify(response, null, 2)+"</pre>");
          $("#captureButton").show();
          authID = response.transactions['0'].related_resources['0'].authorization['id'];          
        });
    }
  }, '#paypal-button');

