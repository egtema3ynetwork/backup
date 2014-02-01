$(function()
{
	__SITE_INFO = function()
	{
		this.display = function()
		{
			$('.__site_info_div').remove();
			if (__.interface.language == "ar")
			{
				__.data.ui.site_marquee_txt_direction = "right";
			
				__.data.ui.site_marquee_txt  = __.data.ui.site_marquee_txt_ar;
			}
			else
			{
				__.data.ui.site_marquee_txt_direction = "left";
				__.data.ui.site_marquee_txt  = __.data.ui.site_marquee_txt_en;
			}
			var divtmp = __.tmp2html("site_info_div_tmp", __.data.ui);
			__.layout.header().prepend(divtmp);
			__.trigger("template/activated", "Site Info");
			__.trigger("site/changeTheme");
		};

		this.displayAbout = function()
		{
			$('.__site_about_div').remove();
			var divtmp = __.tmp2html('site_about_div_tmp', __.data.ui);

			__.trigger("layout/content/set", divtmp);
			__.trigger("site/newContent");
		};

	};

	CORE.prototype.info = new __SITE_INFO();

	__.trigger('layout/ready', null, function()
	{

		__.trigger("site/info/display", null, function(argument)
		{
			__.info.display();
		});

		__.trigger("site/changeLanguage", null, function(argument)
		{
			__.info.display();
		});

		__.trigger("site/info/about", null, function(argument)
		{
			__.info.displayAbout();
		});

		__.trigger("site/info/display");
	});

});
