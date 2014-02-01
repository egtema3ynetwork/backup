var db_menu_img = "<img style='width: 24px;height: 24px;margin:5px;align:left;' src='images/twitter.ico'/>";


$(function()
{

	__SITE_MENU = function()
	{

		if (this === window)
		{
			return new __SITE_MENU();
		}

		
		this.display = function()
		{
			$('.site-menu').remove();
			if (!!__.data.site_menu_list)
			{
				var menu_list = __.data.site_menu_list;
				__.layout.left().append(__.tmp2html("site_menu_core_div_tmp", __.data.ui));
				__.menu.drawMenu(0, menu_list);
				__.menu.show(17);
				__.trigger("template/activated", "Site Menu");
				__.trigger('site/newContent');
			}else
			{
				__.log("xxxxx No Menu Data  xxxxxxxxxx");
			}

		};

		this.drawMenu = function(id, menu_list)
		{
			$.each(menu_list, function(index, item)
			{
				if (item.parent_id == id)
				{
					var menu_tmp = __.tmp2html("site_menu_div_tmp", item);
					__.to$('submenu_' + id).append(menu_tmp);
					__.menu.drawMenu(item.id, menu_list);
				}
			});
		};

		this.show = function(id)
		{
			$('.submenu').not('#submenu_' + id).slideUp();
			$('#submenu_' + id).slideToggle();
			__.trigger('site/goto/top');

		};

		this.edit = function(id)
		{
			var menu_list = __.data.site_menu_list;
			$.each(menu_list, function(index, item)
			{
				if (item.id == id)
				{
					var edit_tmp = __.tmp2html("site_menu_edit_div_tmp", item);
					__.layout.content().html(edit_tmp);
					__.trigger('site/newContent');
					__.trigger('site/goto/top');
					return;
				}
			});

		};

		this.saveMenu = function(id)
		{
			var id = $('#site-menu_' + 'id' + '_' + id).val();
			var parent_id = $('#site-menu_' + 'parent_id' + '_' + id).val();
			var menu_text = $('#site-menu_' + 'menu_text' + '_' + id).val();
			var menu_text_ar = $('#site-menu_' + 'menu_text_ar' + '_' + id).val();
			var menu_func = $('#site-menu_' + 'menu_func' + '_' + id).val();
			var menu_css = $('#site-menu_' + 'menu_css' + '_' + id).val();
			var menu_tooltip = $('#site-menu_' + 'menu_tooltip' + '_' + id).val();
			var menu_tooltip_ar = $('#site-menu_' + 'menu_tooltip_ar' + '_' + id).val();
			var menu_hint = $('#site-menu_' + 'menu_hint' + '_' + id).val();

			__.ajax(
			{
				serviceName : "site.menu",
				method : "save",
				id : __.spy(id),
				parent_id : __.spy(parent_id),
				menu_text : __.spy(menu_text),
				menu_text_ar : __.spy(menu_text_ar),
				menu_func : __.spy(menu_func),
				menu_css : __.spy(menu_css),
				menu_tooltip : __.spy(menu_tooltip),
				menu_tooltip_ar : __.spy(menu_tooltip_ar),
				menu_hint : __.spy(menu_hint),
			}, function(data)
			{
				if (data.success == true)
				{
					$('#site-menu-info-div_' + id).html('Saved Succeed');
				}

			});

		};

		this.addMenu = function(id)
		{
			var id = $('#site-menu_' + 'id' + '_' + id).val();
			var parent_id = $('#site-menu_' + 'parent_id' + '_' + id).val();
			var menu_text = $('#site-menu_' + 'menu_text' + '_' + id).val();
			var menu_text_ar = $('#site-menu_' + 'menu_text_ar' + '_' + id).val();
			var menu_func = $('#site-menu_' + 'menu_func' + '_' + id).val();
			var menu_css = $('#site-menu_' + 'menu_css' + '_' + id).val();
			var menu_tooltip = $('#site-menu_' + 'menu_tooltip' + '_' + id).val();
			var menu_tooltip_ar = $('#site-menu_' + 'menu_tooltip_ar' + '_' + id).val();
			var menu_hint = $('#site-menu_' + 'menu_hint' + '_' + id).val();

			__.ajax(
			{
				serviceName : "site.menu",
				method : "add",
				id : __.spy(id),
				parent_id : __.spy(parent_id),
				menu_text : __.spy(menu_text),
				menu_text_ar : __.spy(menu_text_ar),
				menu_func : __.spy(menu_func),
				menu_css : __.spy(menu_css),
				menu_tooltip : __.spy(menu_tooltip),
				menu_tooltip_ar : __.spy(menu_tooltip_ar),
				menu_hint : __.spy(menu_hint),
			}, function(data)
			{
				if (data.success == true)
				{
					$('#site-menu-info-div_' + id).html('added Succeed');
				}

			});

		};

	};

	CORE.prototype.menu = new __SITE_MENU();

	__.trigger('layout/ready', null, function(args)
	{
		__.menu.display();

		__.trigger("site/member/changed",null ,  function( args)
		{
			__.menu.display();
		});

	});

});
