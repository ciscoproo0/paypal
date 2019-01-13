$('#payouts').submit(function(e){
    e.preventDefault();
    $.ajax({
        url: '../../rest/classes/CreatePayouts.php',
        type: 'post',
        data: $('#payouts').serialize(),
        success:function(message){
            console.log(message);
            $("#responsePayouts").show().html("<pre>" + JSON.stringify(message, null, 2) +"</pre>");
        }
    });        
});