$(function()
{

	__SITE_INTERFACE = function()
	{

		if (this === window)
		{
			return new __SITE_INTERFACE();
		}

		this.language = "en";
		this.theme = "btn-primary";
		this.display = function()
		{
			__.layout.right().prepend(__.tmp2html('site_interface_div_tmp', [1]));
			__.trigger("template/activated", "Site Interface");
			$(document).trigger("site/newContent");
		};
		this.toggle = function()
		{
			$('#layout-interface-div').slideToggle();
		};
		this.ar = function(obj)
		{
			obj = (!!obj) ? obj : "*";
			
			this.language = "ar";

			__.log("Change Site Language To ... [ عربى ] ...");
			$('.ar-button').removeClass("btn-inverse").removeClass("btn-small");
			$('.ar-button').addClass("btn-success").addClass("btn-meduim");

			$('.en-button').addClass("btn-inverse").addClass("btn-small");
			$('.en-button').removeClass("btn-success").removeClass("btn-meduim");

			$(obj).each(function(index, obj)
			{

				if (!!$(obj).data('ar'))
				{
					$(obj).html($(obj).data('ar'));
					$(obj).attr("placeholder", $(obj).data('ar'));
				}

				if (!!$(obj).attr('tooltip-ar'))
				{
					$(obj).attr("data-original-title", $(obj).attr('tooltip-ar'));
				}

			});

		};
		this.en = function(obj)
		{
			obj = (!!obj) ? obj : "*";
			this.language = "en";
			__.log("Change Site Language To ... [ English ] ...");
			$('body').css("direction", "ltr");
			$('.en-button').removeClass("btn-inverse").removeClass("btn-small");
			$('.en-button').addClass("btn-success").addClass("btn-meduim");

			$('.ar-button').addClass("btn-inverse").addClass("btn-small");
			$('.ar-button').removeClass("btn-success").removeClass("btn-meduim");

			$(obj).each(function(index, obj)
			{
				if (!!$(obj).data('en'))
				{
					$(obj).html($(obj).data('en'));
					$(obj).attr("placeholder", $(obj).data('en'));
				}

				if (!!$(obj).attr('tooltip-en'))
				{
					$(obj).attr("data-original-title",$(obj).attr('tooltip-en'));
				}
			});

		};
		this.changeLanguage = function(name)
		{
			if (name == "ar")
			{
				this.ar();
			}
			else
			{
				this.en();
			}
		};
		this.changeTheme = function(name)
		{
			this.theme = name;
			$('.theme').removeClass("btn-inverse");
			$('.theme').removeClass("btn-success");
			$('.theme').removeClass("btn-danger");
			$('.theme').removeClass("btn-info");
			$('.theme').removeClass("btn-primary");
			$('.theme').removeClass("btn-warning");
			$('.theme').addClass(this.theme);
		};
		this.updateInterface = function()
		{
			__.interface.changeLanguage(__.interface.language);
			__.interface.changeTheme(__.interface.theme);
			__.logAction("__SITE_INTERFACE.updateInterface()");
		};
	};

	CORE.prototype.interface = new __SITE_INTERFACE();

	__.trigger('layout/ready', null, function()
	{
	    __.interface.language = __.data.ui.site_language;
	    __.interface.theme = __.data.ui.site_theme;
		__.trigger("site/updateInterface",null, function( args)
		{
			if(!!args)
			{
			
				__.interface.language == "ar" ?__.interface.ar(args) : __.interface.en(args);
				return ;
			}
			__.trigger("site/changeTheme", __.interface.theme);
			__.trigger('site/changeLanguage', __.interface.language);
		});

		__.trigger("site/changeTheme", null, function(args)
		{
			__.interface.changeTheme(!!args ? args : __.interface.theme);
		});

		__.trigger("site/newContent", null, function(args)
		{
			__.trigger("site/updateInterface");
		});

		__.trigger('site/changeLanguage', null, function(argument)
		{
			__.interface.changeLanguage(argument);
		});

		__.trigger("site/updateInterface");

	});

});
