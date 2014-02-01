$(function() {

	__SITE_INTERFACE = function() {

		if (this === window) {
			return new __SITE_INTERFACE();
		}

		this.interfaceuage = "en";
		this.theme = "btn-success";
		this.display = function() {
			__.layout.right().prepend(__.tmp2html('site-interface-div-tmp', [1]));
			$(document).trigger("site/newContent");
		};
		this.toggle = function() {
			$('#layout-interface-div').slideToggle();
		};
		this.ar = function() {
			this.interfaceuage = "ar";

			__.log("Change Site Language To ... [ عربى ] ...");
			$('.ar-button').removeClass("btn-inverse").removeClass("btn-small");
			$('.ar-button').addClass("btn-success").addClass("btn-meduim");

			$('.en-button').addClass("btn-inverse").addClass("btn-small");
			$('.en-button').removeClass("btn-success").removeClass("btn-meduim");

			$('*').each(function(index, obj) {

				if (!!$(obj).data('ar')) {
					$(obj).html($(obj).data('ar'));
					$(obj).attr("placeholder", $(obj).data('ar'));
				}

				if (!!$(obj).attr('tooltip-ar')) {
					$(obj).attr("data-original-title", $(obj).attr('tooltip-ar'));
				}

			});
			$("[rel=tooltip]").tooltip({
				placement : 'bottom'
			});

		};
		this.en = function() {
			this.interfaceuage = "en";
			__.log("Change Site Language To ... [ English ] ...");
			$('body').css("direction", "ltr");
			$('.en-button').removeClass("btn-inverse").removeClass("btn-small");
			$('.en-button').addClass("btn-success").addClass("btn-meduim");

			$('.ar-button').addClass("btn-inverse").addClass("btn-small");
			$('.ar-button').removeClass("btn-success").removeClass("btn-meduim");

			$('*').each(function(index, obj) {
				if (!!$(obj).data('en')) {
					$(obj).html($(obj).data('en'));
					$(obj).attr("placeholder", $(obj).data('en'));
				}

				if (!!$(obj).attr('tooltip-en')) {
					$(obj).attr("data-original-title", $(obj).attr('tooltip-en'));
				}
			});
			$("[rel=tooltip]").tooltip({
				placement : 'bottom'
			});
		};
		this.changeLanguage = function(name) {
			if (name == "ar") {
				this.ar();
			} else {
				this.en();
			}
		};
		this.changeTheme = function(name) {
			this.theme = name;
			$('.theme').removeClass("btn-inverse");
			$('.theme').removeClass("btn-success");
			$('.theme').removeClass("btn-danger");
			$('.theme').removeClass("btn-info");
			$('.theme').removeClass("btn-primary");
			$('.theme').removeClass("btn-warning");
			$('.theme').addClass(this.theme);
		};
		this.updateInterface = function() {
			__.interface.changeLanguage(__.interface.interfaceuage);
			__.interface.changeTheme(__.interface.theme);
			__.logAction("__SITE_INTERFACE.updateInterface()");
		};
	};

	CORE.prototype.interface = new __SITE_INTERFACE();

	$(document).on("site/updateInterface", function(e, args) {
		__.interface.updateInterface();
	});
	$(document).on("site/updateTheme", function(e, args) {
		__.interface.changeTheme(args);
	});
	$(document).on("site/updateLanguage", function(e, args) {
		__.interface.changeLanguage(args);
	});
	$(document).on("site/newContent", function(e, args) {
		$(document).trigger("site/updateInterface");
	});

	$(document).trigger("template/activated", "Site Interface");

}); 