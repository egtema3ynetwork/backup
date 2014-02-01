$(function() {

	__SITE_SOON = function() {
		this.display = function() {

			$('.soondiv').remove();
			__.layout.content().html(__.tmp2html('site-soon-div-tmp', [1]));
			$('.soondiv').hide();
			$('.soondiv').show('slow');
			if (__.layout.content().children().length > 7) {
				$('html, body').animate({
					scrollTop : $('.soondiv').last().offset().top - 100
				}, 500);
			}
			$(document).trigger("site/newContent");
		};
		this.toggle = function() {
			$('#site-soon-div').slideToggle();
		};

	};

	CORE.prototype.soon = new __SITE_SOON();

	$(document).trigger("template/activated", "Site Soon");

}); 