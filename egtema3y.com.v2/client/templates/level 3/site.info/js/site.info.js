$(function() {
	__SITE_INFO = function() {
		this.display = function() {
			__.layout.header().append(__.tmp2html('#site-info-tmp', [1]));
			$(document).trigger("site/newContent");
		};

	};

	CORE.prototype.info = new __SITE_INFO();
	__.info.display();

	$(document).trigger("template/activated", "Site Info");

});
