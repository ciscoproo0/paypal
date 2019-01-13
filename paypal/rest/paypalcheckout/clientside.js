paypal.Button.render({

    env: 'sandbox', // sandbox | production

    style: {
        label: 'paypal',
        size:  'medium',    // small | medium | large | responsive
        shape: 'rect',     // pill | rect
        color: 'blue',     // gold | blue | silver | black
        tagline: false    
    },


    // PayPal Client IDs - replace with your own
    // Create a PayPal app: https://developer.paypal.com/developer/applications/create
    client: {
        sandbox:    'AQMvz-l3XHRLi2aHA0oSANfks5l-VwwS40Los6JPnGCLFceyXAN1LTnharyA0s5GrsFjYhh2iNxpeNrj',
    },

    // Show the buyer a 'Pay Now' button in the checkout flow
    commit: true,

    // payment() is called when the button is clicked
    payment: function(data, actions) {

        // Make a call to the REST api to create the payment
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                        amount: { total: '350.00', currency: 'BRL' }
                    }
                ]
            }
        });
    },

    // onAuthorize() is called when the buyer approves the payment
    onAuthorize: function(data, actions) {

        // Make a call to the REST api to execute the payment
        return actions.payment.execute().then(function(res) {
            //var resobj = JSON.parse(res);
            var state = res.transactions['0'].related_resources['0'].sale['state'];
            var saleID = res.transactions['0'].related_resources['0'].sale['id'];
            if(state == 'completed'){
              console.log(res);
              console.log(saleID);
              alert("Payment Completed!");
              window.location = "../../success.php"
            }else{
              alert("Your payment cannot be completed");
            }
        });
    }

}, '#paypal-button-container');
