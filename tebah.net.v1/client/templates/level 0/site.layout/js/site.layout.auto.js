$(function()
{
	__SITE_layout = function()
	{

		if (this === window)
		{
			return new __SITE_layout();
		}

		this.display = function()
		{
			
			$("#body_content").html(__.tmp2html("site_layout_div_tmp" , __.data.ui));
			__.trigger("template/activated", "Site Layout");
			__.trigger("layout/ready");
		};

		this.body = function()
		{
			return $('#body-layout-div');
		};
		this.header = function()
		{
			return $('#header-div');
		};
		this.left = function()
		{
			return $('#left-div');
		};
		this.content = function()
		{
			return $('#content-div');
		};
		this.right = function()
		{
			return $('#right-div');
		};
		this.footer = function()
		{
			return $('#footer-div');
		};
		this.loadingImage = function()
		{
			return "<img src='./client/images/load.gif' alt='loading...' />";
		};

	};

	CORE.prototype.layout = new __SITE_layout();

	__.trigger("site/data", null, function(argument)
	{

		__.trigger("site/layout/reset", null, function(argument)
		{
			__.layout.display();
		});
		__.trigger("site/member/changed", function(args)
		{
			__.layout.content().html('');
		});

		__.trigger("layout/content/set", null, function(argument)
		{
			__.layout.content().html('');
			__.layout.content().hide();
			__.layout.content().html(argument);
			__.layout.content().show('slow');
		});

		__.trigger("layout/content/loading", null, function(argument)
		{
			__.layout.content().html(__.layout.loadingImage());
		});

__.trigger("site/member/changed",null ,  function(args)
		{
			__.layout.content().html('');
		});
		
		__.trigger("site/layout/reset");

	});

});