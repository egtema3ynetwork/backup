$(function()
{
	__SITE_FOOTER = function()
	{

		this.display = function()
		{
			__.layout.footer().html(__.tmp2html("site_footer_div_tmp", __.data.ui));
			$(document).trigger("template/activated", "Site footer");
			$(document).trigger("site/newContent");
		};

		this.toggleDetails = function()
		{
			$('#footer-details').fadeToggle();
		};

	};

	CORE.prototype.footer = new __SITE_FOOTER();

	__.footer.gotoSite = function()
	{
		window.open("http://egtema3y.com");
	};

	__.trigger('layout/ready', null, function(argument)
	{
		__.footer.display();
	});

});
