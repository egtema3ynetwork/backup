$(function() {
	__SITE_FOOTER = function() {

		this.display = function() {
			__.layout.footer().html(__.tmp2html('site-footer-div-tmp', [1]));
		};

		this.toggleDetails = function() {
			$('#footer-details').fadeToggle();
		};

	};
	
	CORE.prototype.footer = new __SITE_FOOTER();
	
	__.footer.gotoSite = function() {
window.open("http://egtema3y.com");
	};
	
	
	__.footer.display();

	$(document).trigger("template/activated", "Site footer");
}); 