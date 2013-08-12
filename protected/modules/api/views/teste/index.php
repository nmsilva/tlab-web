<script language="javascript">
    
    setInterval(function()
    {
        $.ajax({
            url: "<?php echo CController::createUrl("/api/teste/registametricas/id/".$id_sensor); ?>",
            success: function(result) {
                $('.result').append('Registou Valor em : '+$.now()+'<br>');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                location.reload();
            }
           });
    },1000);

    
</script>
<div class="result">
    
</div>