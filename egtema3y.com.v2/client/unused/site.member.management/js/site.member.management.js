$(function() {

	__.member.managementToggle = function() {
		$('.membermanagementdetails').slideToggle();
	};

	__.member.showProfile = function() {

		var id = __.member.id;
		var _url = __.getWebServicesURL() + "/site.member.php";
		__.log("call service = " + _url);

		$.ajax({
			url : _url,
			data : {
				method : "selectone",
				id : __.spy(id)
			},
			type : "POST",
			dataType : "json",
			crossDomain : true,
			timeout : 60000,
			success : function(data, textStatus, jqXHR) {

				__.log("ajax member load profile success fire");
				if (data.data.length > 0) {
					var i = 1;
					$.each(data.data, function() {
						this.index = i;
						i++;
						if (!!this.userid) {
							this.imageurl = 'https://graph.facebook.com/' + this.userid + '/picture?type=square';
						} else {
							this.imageurl = './client/images/' + this.gender + '.jpg';
						}

					});

					var divtmp = __.tmp2html('#site-member-management-profile-div-tmp', data.data);

					__.layout.content().html(divtmp);
					__.layout.content().hide();
					__.layout.content().show('slow');

					$.each(data.data, function() {

						var id = this.id;
						var role = this.role;
						var gender = this.gender;

						__.setSelect('#roletxt_' + id, role);
						__.setSelect('#gendertxt_' + id, gender);
					});

					$(document).trigger("site/newContent");
					
				} else {
					__.logWarn("ajax member load profile  : data.lenght == 0 ");
				}
			},
			error : function(jqXHR, textStatus, errorThrown) {
				__.logErr("ajax member load profile error : " + errorThrown);
			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax member load profile complete : " + textStatus);
			}
		});

	};
	__.member.loadAll = function() {
		$('.membermanagementdetails').html('');
		var value = $('#member-filter-txt').val();
		var _url = __.getWebServicesURL() + "/site.member.php";
		__.log("call service = " + _url);

		$.ajax({
			url : _url,
			data : {
				method : "all",
				value : __.spy(value)
			},
			type : "POST",
			dataType : "json",
			crossDomain : true,
			timeout : 60000,
			success : function(data, textStatus, jqXHR) {

				__.log("ajax member load all success fire");
				if (data.data.length > 0) {
					var i = 1;
					$.each(data.data, function() {
						this.index = i;
						i++;
						if (!!this.userid) {
							this.imageurl = 'https://graph.facebook.com/' + this.userid + '/picture?type=square';
						} else {
							this.imageurl = './client/images/' + this.gender + '.jpg';
						}

					});

					var divtmp = __.tmp2html('#site-member-management-details-div-tmp', data.data);

					$('.membermanagementdetails').html(divtmp);
					$('.membermanagementdetails').hide();
					$('.membermanagementdetails').show('slow');

					$.each(data.data, function() {

						var id = this.id;
						var role = this.role;
						var gender = this.gender;

						__.setSelect('#roletxt_' + id, role);
						__.setSelect('#gendertxt_' + id, gender);
					});

					$(document).trigger("site/newContent");
				} else {
					__.logWarn("ajax member load all  : data.lenght == 0 ");
				}
			},
			error : function(jqXHR, textStatus, errorThrown) {
				__.logErr("ajax member load all error : " + errorThrown);
			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax member load all complete : " + textStatus);
			}
		});
	};
	__.member.manage = function() {
		$('.membermanagementparent').remove();
		__.layout.content().html(__.tmp2html('site-member-management-div-tmp', [1]));
		$(document).trigger("site/newContent");
		$('.membermanagementparent').hide();
		$('.membermanagementparent').show('slow');
		if (__.layout.content().children().length > 7) {
			$('html, body').animate({
				scrollTop : $('.membermanagementparent').last().offset().top - 100
			}, 500);
		}

		$("#member-filter-txt").bind("keypress", function(e) {

			if (e.keyCode == 13) {
				__.member.loadAll();
			}
		});

	};
	__.member.doUpdate = function(id) {
		var email = $('#emailtxt_' + id).val();
		var password = $('#passwordtxt_' + id).val();
		var name = $('#nametxt_' + id).val();
		var gender = $('#gendertxt_' + id + " option:selected").text();
		var role = $('#roletxt_' + id + " option:selected").text();

		var _url = __.getWebServicesURL() + "/site.member.php";
		__.log("call service = " + _url);
		$('#memberdetailsinfotxt_' + id).html('Loading ....');
		$.ajax({
			url : _url,
			data : {
				method : "update",
				name : __.spy(name),
				password : __.spy(password),
				email : __.spy(email),
				gender : __.spy(gender),
				id : id,
				role : __.spy(role)
			},
			type : "POST",
			dataType : "json",
			crossDomain : true,
			timeout : 60000,
			success : function(data, textStatus, jqXHR) {

				$('#memberdetailsinfotxt_' + id).html('Data Saved Succeed !!');
			},
			error : function(jqXHR, textStatus, errorThrown) {
				__.logErr("ajax member update error : " + errorThrown);
			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax member updatd complete : " + textStatus);
			}
		});

	};
	__.member.doDelete = function(id) {

		var name = $('#nametxt_' + id).val();
		var _url = __.getWebServicesURL() + "/site.member.php";
		__.log("call service = " + _url);
		$('#memberdetailsinfotxt_' + id).html('Loading ....');
		$.ajax({
			url : _url,
			data : {
				method : "delete",
				id : __.spy(id.toString())
			},
			type : "POST",
			dataType : "json",
			crossDomain : true,
			timeout : 60000,
			success : function(data, textStatus, jqXHR) {

				$('#memberinfocontent_' + id).html('<hr><div style="color: red;font-weight: bold;"> ' + name + ' was Deleted !!' + "</div><hr>");
			},
			error : function(jqXHR, textStatus, errorThrown) {
				__.logErr("ajax member update error : " + errorThrown);
			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax member updatd complete : " + textStatus);
			}
		});

	};
	__.member.showDetails = function(id) {
		$('#memberinfoview_' + id).slideToggle();
	};

	$(document).trigger("template/activated", "Site Member Management");

});

