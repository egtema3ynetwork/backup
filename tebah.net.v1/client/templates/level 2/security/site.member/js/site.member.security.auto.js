$(function() {
	
__.member.applaySecurity = function() {
			__.trigger('security/enabled');
				};
				
$(document).on("security/enabled", function(e, args) {
	
	if (__.isDemoMode()) {
				return;
			}

			var role = __.getValue('member_role');
			
			if (!!role && role=="Developer") {
				return;
			}
			
			if (!!role ) {
				__.logWarn('Member role = [' + role + ']');
				$('.security-enabled').not('.' + role).not('.Anyone').remove();
				$('.view-enabled').not('.' + role).not('.Anyone').remove();
				$('.edit-enabled').not('.' + role).not('.Anyone').attr("Disabled" ,"Disabled");
				$('.block-enabled').filter('.' + role).attr("Disabled" ,"Disabled");
			}else{
				$('.security-enabled').remove();
				$('.view-enabled').remove();
				$('.edit-enabled').attr("Disabled" ,"Disabled");
				$('.block-enabled').attr("Disabled" ,"Disabled");
			}
			

			$.each($('.notempty'), function(index, item) {
				if ($(item).children.length < 1) {
					$(item).addClass('mustdelete');
				}
			});

			$('.mustdelete').remove();




			$(document).trigger("site/updateInterface");


	});






});