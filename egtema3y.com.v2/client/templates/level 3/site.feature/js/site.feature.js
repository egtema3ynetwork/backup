$(function() {
	__SITE_FEATURE = function() {
		this.display = function() {
			__.layout.content().html('');
			__.layout.content().hide();
			__.layout.content().append(__.tmp2html('site-feature-div-tmp', [1]));
			__.layout.content().show('slow');
			$('html, body').animate({
				scrollTop : '0px'
			}, 300);
			$(document).trigger("site/newContent");
		};
		
		this.help = function() {
			__.layout.content().html('');
			var tmp = __.tmp2html('site-help-silverlight-tmp', [1]);
			var tmp2 = __.tmp2html('site-help-addpage-tmp', [1]);
			
			__.layout.content().append(tmp2);
			__.layout.content().append(tmp);
			
			$(tmp).hide();
			$(tmp).show('slow');
			$('html, body').animate({
				scrollTop : '0px'
			}, 300);
			$(document).trigger("site/newContent");
		};
		
		this.win = function() {
			__.layout.content().html('');
			var tmp = __.tmp2html('site-help-win-tmp', [1]);
	
			__.layout.content().append(tmp);
			
			$(tmp).hide();
			$(tmp).show('slow');
			$('html, body').animate({
				scrollTop : '0px'
			}, 300);
			$(document).trigger("site/newContent");
		};
		
		this.toggle = function() {
			$('#layout-feature-div').slideToggle();
		};
	};

	CORE.prototype.feature = new __SITE_FEATURE();

	$(document).trigger("template/activated", "Site Feature");

});
