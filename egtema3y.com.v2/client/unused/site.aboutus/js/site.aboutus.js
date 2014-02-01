
$(function() {

    __SITE_ABOUTUS = function() {

        this.display = function() {
            {
                __.layout.right().append(__.tmp2html('site-aboutus-div-tmp', [1]));
                $(document).trigger("site/newContent");
            }
            ;

        };
        this.toggle = function() {
            $('#layout-aboutus-div').slideToggle();
        };

    };

    CORE.prototype.aboutus = new __SITE_ABOUTUS();
    __.aboutus.display();

    $(document).trigger("template/activated", "Site About Us");
}
);