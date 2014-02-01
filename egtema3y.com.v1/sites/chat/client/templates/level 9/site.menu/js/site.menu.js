var db_menu_img = "<img style='width: 24px;height: 24px;margin:5px;align:left;' src='images/twitter.ico'/>";
var db_menu_0 = [{
	menu_name : "Chat Setting",
	en : "Chat Setting",
	ar : "اعدادات النظام",
	menu_id : 1,
	menu_sub_menu : "submenu_1",
	menu_action : "__.menu.show(1);  ",
	menu_style : "theme ",
	menu_role: "Administrator Member"
}];

var db_menu_1 = [{
	menu_name : "Create Chat Room",
	en : "Create Chat Room",
	ar : "شاشة التحكم",
	menu_id : "x",
	menu_action : "__.soon.display();",
	menu_style : "",
	menu_role : "Administrator Member"
},
{
    menu_name: "Chat Rooms Search",
    en: "Chat Rooms Search",
    ar: "مستخدم جديد",
    menu_id: "x",
    menu_action: "__.soon.display();",
    menu_style: "",
    menu_role: "Administrator Member"
}

];


$(function() {

	__SITE_MENU = function() {

		if (this === window) {
			return new __SITE_MENU();
		}

		this.loadMenu = function(id) {

			$("#menu_" + id).find(".menuico").html('');
			$('#menu_button_' + id).css("font-weight", "bold");
			if (id === 0) {
				$('#site-menu-tmp').tmpl(db_menu_0).appendTo($("#submenu_" + id));
				$("#submenu_" + id).show();
			}
			if (id === 1) {
				$('#site-menu-tmp').tmpl(db_menu_1).appendTo($("#submenu_" + id));
				$("#submenu_" + id).show();
			}
			if (id === 2) {
				$('#site-menu-tmp').tmpl(db_menu_2).appendTo($("#submenu_" + id));
				//$("#submenu_" + id).show();
			}
			if (id === 3) {
				$('#site-menu-tmp').tmpl(db_menu_3).appendTo($("#submenu_" + id));
				//$("#submenu_" + id).show();
			}
			if (id === 4) {
				$('#site-menu-tmp').tmpl(db_menu_4).appendTo($("#submenu_" + id));
				//$("#submenu_" + id).show();
			}
			$(document).trigger("site/newContent");

		};

		this.display = function() {

			__.layout.right().append($('#site-main-menu'));
			$(document).trigger("site/newContent");
			this.loadMenu(0);
			this.loadMenu(1);
			

		};
		this.show = function(id) {
			$('#submenu_' + id).slideToggle();
		};

	};

	CORE.prototype.menu = new __SITE_MENU();

	__.menu.display();

	$(document).trigger("template/activated", "Site Menu");

	$(document).on("site/member/changed", function(e, args) {
		__.menu.display();
	});

}); 