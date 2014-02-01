



$(function()
{
    __SITE_LOGO = function() {

        this.display = function()
        {
            __.layout.header().html(__.tmp2html('site-logo-div-tmp', [1]));
        };

        this.toggleDetails = function() {
            $('#logo-details').fadeToggle();
        };

    };

    CORE.prototype.logo = new __SITE_LOGO();
    __.logo.display();
    
    $(document).trigger("template/activated", "Site Logo");
});