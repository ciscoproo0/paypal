$('#payouts').submit(function(event){
    event.preventDefault();
    var fields = $.post(url, {value: $('#value').val(), currency: $('#currency').val(), note: $('#note').val(), sender_item_id: $('#sender_item_id').val(), receiver: $('#receiver').val()});
    
    posting.done(function(data){
        console.log(data);
    });
});