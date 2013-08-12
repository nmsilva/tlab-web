$(document).ready(function() {
    
    $('.btn-navbar').click(function(){
        var options = {};
        $("#mainmenu" ).toggle('blind', options, 500 );
    });
    
    $('#sel-lang').click(function(){
        $(".more-lang" ).toggle();
        return false;
    });
});

