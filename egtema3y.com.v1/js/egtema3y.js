// JScript source code
$( document ).ready( function ()
{
   
});

$("body").on({
    // When ajaxStart is fired, add 'loading' to body class
    ajaxStart: function() { 
        $(this).addClass("loading"); 
    },
    // When ajaxStop is fired, rmeove 'loading' from body class
    ajaxStop: function() { 
        $(this).removeClass("loading"); 
    }    
});

    //$( '[data-toggle="tooltip"]' ).tooltip(); // must to show tootip style
 
    


