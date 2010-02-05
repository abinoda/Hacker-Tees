$(function() {
    $("#email-signup form").submit(function(e) {
		e.preventDefault();
		
		if (valid_email($("#email").val()))
		{
		    $("#email-signup").animate({'opacity':"0.2"}, 500, function() 
            { 
                $(this).animate({'opacity':"1.0"}, 500) 
            });
		    
    		$.post($(this).attr("action"), $(this).serialize(), function(response) {    		
                if (response.success)
                {
                    $("#email").val('enter your email');
                    
                    $("#email-signup").append('<span class="flash success">Thanks!</span>');                    
                } 
                else
                {
                    $("#email-signup").append('<span class="flash error">Whoops! There was an error.</span>');
                }
                                
                setTimeout(function() {
                    $("#email-signup span.flash").fadeOut("slow").remove();
                }, 5000);
    		}, "json");
    	}
    });
});

function valid_email(str) {
    return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);
}