$(function()
{
    __SITE_LOGO = function() {

        this.display = function()
        {
        	
            $('body').prepend(__.tmp2html("site_logo_div_tmp", __.data.ui));
             $(document).trigger("template/activated", "Site Logo");
            __.trigger('site/newContent');
        };

        this.toggleDetails = function() {
            $('#logo-details').fadeToggle();
        };

    };

    CORE.prototype.logo = new __SITE_LOGO();
    
    __.trigger('layout/ready', null, function() {
		  __.logo.display();
	});
 
    
   
});