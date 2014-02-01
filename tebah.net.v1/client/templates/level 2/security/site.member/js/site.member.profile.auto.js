$(function() {

	__.member.showProfile = function() {

__.trigger("layout/content/loading" );

		var id = __.member.id;
		
		__.ajax({
		    serviceName: "site.member",
			
				method : "selectone",
				id : __.spy(id)
			},
			 function(data, textStatus, jqXHR) {

				__.log("ajax member load profile success fire");
				if (data.data.length > 0) {
					var i = 1;
					$.each(data.data, function() {
						this.index = i;
						i++;
						if (!!this.faceid) {
							this.imageurl = 'https://graph.facebook.com/' + this.userid + '/picture?type=square';
						} else {
							this.imageurl = './client/images/' + this.gender + '.jpg';
						}

					});

					var divtmp = __.tmp2html('#site-member-management-profile-div-tmp', data.data);

					
					__.trigger("layout/content/set" , divtmp);

					$.each(data.data, function() {

						var id = this.id;
						var role = this.role;
						var gender = this.gender;
						$("#roletxt_" + id).append(__.tmp2html(db.select_option_tmp, __.member.roles));
						__.setSelect('#roletxt_' + id, role);
						__.setSelect('#gendertxt_' + id, gender);
					});

					$(document).trigger("site/newContent");

				} else {
					__.logWarn("ajax member load profile  : data.lenght == 0 ");
				}
			},
		 function( errorThrown) {
				__.logErr("ajax member load profile error : " + errorThrown);
			},
			 function( textStatus) {
				__.logInfo("ajax member load profile complete : " + textStatus);
			}
		);

	};

});
