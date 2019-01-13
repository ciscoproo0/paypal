if (window.addEventListener) {
	window.addEventListener("message", receiveMessage, false);
	console.log("addEventListener successful", "debug");
} else if (window.attachEvent) {
	window.attachEvent("onmessage", receiveMessage);
	console.log("attachEvent successful", "debug");
} else {
	console.log("Could not attach message listener", "debug");
	throw new Error("Can't attach message listener");
}

function receiveMessage(event)
{
try {
var message = JSON.parse(event.data);
	if (typeof message['cause'] !== 'undefined') { //iFrame error ndling
		ppplusError = message['cause'].replace (/['"]+/g,""); //log & attach this error into the order if possible

	switch (ppplusError)
{
	case "INTERNAL_SERVICE_ERROR": //javascript fallthrough
	case "SOCKET_HANG_UP": //javascript fallthrough
	case "socket hang up": //javascript fallthrough
	case "connect ECONNREFUSED": //javascript fallthrough
	case "connect ETIMEDOUT": //javascript fallthrough
	case "UNKNOWN_INTERNAL_ERROR": //javascript fallthrough
	case "fiWalletLifecycle_unknown_error": //javascript fallthrough
	case "Failed to decrypt term info": //javascript fallthrough
	case "RESOURCE_NOT_FOUND": //javascript fallthrough


	case "INTERNAL_SERVER_ERROR":
	alert ("Ocorreu um erro inesperado, por favor tente novamente."); //pt_BR
	//Generic error, inform the customer to try again; generate a new approval_url and reload the iFrame.

	break;
	case "RISK_N_DECLINE": //javascript fallthrough
	case "NO_VALID_FUNDING_SOURCE_OR_RISK_REFUSED": //javascript fallthrough
	case "TRY_ANOTHER_CARD": //javascript fallthrough
	case "NO_VALID_FUNDING_INSTRUMENT":
	alert ("Seu pagamento não foi aprovado. Por favor utilize outro cartão, caso o problema persista entre em contato com o PayPal (0800-047-4482)."); //pt_BR
	//Risk denial, inform the customer to try again; generate a new approval_url and reload the iFrame.

	break;
	case "CARD_ATTEMPT_INVALID":
	alert ("Ocorreu um erro inesperado, por favor tente novamente."); //pt_BR
	//03 maximum payment attempts with error, inform the customer to try again; generate a new approval_url and reload the iFrame.
	break;
	case "INVALID_OR_EXPIRED_TOKEN":
	alert ("A sua sessão expirou, por favor tente novamente."); //pt_BR
	//User session is expired, inform the customer to try again; generate a new approval_url and reload the iFrame.

	break;
	case "CHECK_ENTRY":
	alert ("Por favor revise os dados de Cartão de Crédito inseridos."); //pt_BR
	//Missing or invalid credit card information, inform your customer to check the inputs.
	
	break;
	default: //unknown error & reload payment flow
	alert ("Ocorreu um erro inesperado, por favor tente novamente."); //pt_BR
	//Generic error, inform the customer to try again; generate a new approval_url and reload the iFrame.

		}
	}

	if (message['action'] == 'checkout') { //PPPlus session approved, do logic here
		var rememberedCard = null;
		var payer_ID = null;
		var payment_ID = null;
		var installmentsValue= null;
		
		console.log(message);
		
		rememberedCard = message['result']['rememberedCards']; //save on user BD record
		payer_ID = message['result']['payer']['payer_info']['payer_id'];
		payment_ID = sessionStorage.getItem('execute');
		$("#requestExecute").show().html("<pre>{ payer_id: " + payer_ID +" }</pre>");
	
	if("term" in message){
		installmentsValue = message['result']['term']['term']; //installments value
	} else {
		installmentsValue=1; //no installments
	}

		var hostName = window.location.origin;
		var pathExecute ="/rest/classes/ExecutePayment.php";
		var ExecutePaymentPath = hostName+pathExecute;
		
		var reqs = { payerID: payer_ID, paymentID: payment_ID };

		$.ajax({
			url: ExecutePaymentPath,
			type: 'POST',
			dataType: 'json',
			data: reqs,
				success: function(response){
					var state = response.transactions['0'].related_resources['0'].sale['state'];					
					if (state == "completed") {
						alert("Pagamento feito com sucesso!");
						console.log(response);
						//window.location = "../../success.php";
						}
						$("#responseExecute").show().html("<pre>" + JSON.stringify(response, null, 2)+"</pre>");
				},error: function(err){
					console.log(err);
					}
				});
			}
		}catch (e){ //treat exceptions here
			console.log(e);
			}
}
			