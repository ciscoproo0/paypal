var hostName = window.location.origin;

var pathCreate ="/rest/classes/CreatePayment.php?action=PayPalCheckout";
var pathExecute ="/rest/classes/ExecutePayment.php";
var pathGetSaleInfo ="/rest/classes/GetSaleInfo.php";

var CreatePaymentPath = hostName+pathCreate;
var ExecutePaymentPath = hostName+pathExecute;
var GetSaleInfoPath = hostName+pathGetSaleInfo;

paypal.Button.render({
    env: 'sandbox',

    style: {
      label: 'paypal',
      size:  'medium',    // small | medium | large | responsive
      shape: 'rect',     // pill | rect
      color: 'black',     // gold | blue | silver | black
      tagline: false    
  },

    //Set up payment with CreatePayment Path
    payment: function(data, actions) {

      return "EC-6WA905011C847494K";

      // return actions.request.post(CreatePaymentPath)
      //   .then(function(res) {
      //     console.log(res);
      //     return res.id;
      //   });
      },

    //execute payment wit ExecutePayment Path
    onAuthorize: function(data, actions) {
        return actions.request.post(ExecutePaymentPath, {
        paymentID: data.paymentID,
        payerID:   data.payerID
      })
        .then(function(res) {

          // Redirects to a success page
          //var resobj = JSON.parse(res);
          var resobj = res;
          var saleID = resobj.transactions['0'].related_resources['0'].sale['id']; 
          var state = resobj.transactions['0'].related_resources['0'].sale['state'];
          if(state == 'completed'){
            console.log(resobj);
            console.log(saleID);
            alert("Payment Completed!");
            window.location = "../../success.php";
          }else{
            alert("Your payment cannot be completed");
          }
        });
    }
  }, '#paypal-button');

