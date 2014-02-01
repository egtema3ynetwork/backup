$(function() {
	__SITE_layout = function() {

		if (this === window) {
			return new __SITE_layout();
		}

		this.display = function() {
			$("body").prepend(__.tmp2html('site-layout-div-tmp', [1]));
			$(document).trigger("layout/ready");
		};

		this.body = function() {
			return $('#body-layout-div');
		};
		this.header = function() {
			return $('#header-div');
		};
		this.left = function() {
			return $('#left-div');
		};
		this.content = function() {
			return $('#content-div');
		};
		this.right = function() {
			return $('#right-div');
		};
		this.footer = function() {
			return $('#footer-div');
		};
		this.loadingImage = function() {
			return "<img src='images/load.gif' alt='loading...' />";
		};

	};

	CORE.prototype.layout = new __SITE_layout();

	__.layout.display();

	$(document).trigger("template/activated", "Site Layout");

	$(document).on("site/member/changed", function(e, args) {
		__.layout.content().html('');
	});

}); 