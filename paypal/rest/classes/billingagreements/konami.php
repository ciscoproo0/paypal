<?php

?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $.ajax({
    url: "CalculatedFinancingOptions",
    type: "GET",
    dataType: "json",
    success: function(response){
        console.log(response);
    },
    error: function(err){
        console.log(err);
    }

});

    
</script>