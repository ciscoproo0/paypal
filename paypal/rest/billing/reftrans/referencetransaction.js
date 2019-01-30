var hostName = window.location.origin;
var pathExecuteAgreement ="/rest/classes/billingagreements/ExecuteAgreement.php";
var ExecuteAgreementPath = hostName+pathExecuteAgreement;


$('#referenceTransaction').click(function(){
    $.ajax({
    url: ExecuteAgreementPath + "?action=requestExecute",
    type: 'GET',
    dataType: 'json',
    success: function(response){
        $("#requestCapture").html("<pre>"+JSON.stringify(response, null, 2)+"</pre>");
        console.log("---------- Request from Execute Agreement (Create Payment) ----------");
        console.log(response);
        $.ajax({
        url: ExecuteAgreementPath,
        type: 'POST',
        dataType: 'json',
        data: {billingID: billingID},
        success: function(response){
            $("#responseCapture").html("<pre>"+JSON.stringify(response, null, 2)+"</pre>");
            console.log("---------- Response from Execute Agreement (Create Payment) ----------");
            console.log(response);
        },
        error: function(err){console.log(err);}
        });
    },
    error: function(err){console.log(err);}
    });
});