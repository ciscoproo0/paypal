var ppp = PAYPAL.apps.PPP({
		    approvalUrl: sessionStorage.getItem('approval'),
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

