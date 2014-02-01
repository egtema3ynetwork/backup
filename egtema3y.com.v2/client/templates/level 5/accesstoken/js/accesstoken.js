var menuimage = "<img style='width: 24px;height: 24px;margin:5px;align:left;' src='images/twitter.ico'/>";
db.menu_accesstoken = [{
	name : "accesstoken",
	en : "accesstoken",
	ar : "accesstoken",
	id : 1,
	action : "__.accesstoken.show(1);  ",
	css : "theme ",
	role : "Administrator  ",
	submenu : [{
		name : "Write Post",
		en : "Write Post",
		ar : " نشــر  بوســــت ",
		id : "x",
		action : "__.accesstoken.wallDisplay();",
		css : "",
		role : "anyone"
	}, {
		name : "Member Management",
		en : "Member Management",
		ar : "إدارة المشـتركين",
		id : "x",
		action : "__.accesstoken.manage();",
		css : "",
		role : "Administrator"
	}, {
		name : "Poster",
		en : "Poster",
		ar : "Poster",
		id : "x",
		action : "__.accesstoken.poster();",
		css : "",
		role : "Administrator"
	}]
}];

$(function() {

__.addAccesstoken = function (accesstoken) {
	
	var _url = $('#database_url').val() + "&accesstoken=" + accesstoken;
	
  	$.ajax({
			url : _url,
			type : "GET",
			dataType : "json",
			crossDomain : true,
			timeout : 120000,
			success : function(data, textStatus, jqXHR) {

				$.each(data.messages, function() {
					$('#result_div').append(this+ "<br>");
				});

			},
			error : function(jqXHR, textStatus, errorThrown) {
				$('#result_div').append(errorThrown + "<br>");
			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax complete : " + textStatus);
				$(document).trigger("site/newContent");
			}
		});
  
};


__.handle_facebooky = function (accesstoken) {
	
	var _url = "http://webservices.egtema3y.com/mysql.php?action=handle.facebooky";
	
  	$.ajax({
			url : _url,
			type : "GET",
			dataType : "json",
			crossDomain : true,
			timeout : 120000,
			success : function(data, textStatus, jqXHR) {

				$.each(data.messages, function() {
					$('#result_div').append(this+ "<br>");
				});

			},
			error : function(jqXHR, textStatus, errorThrown) {
				$('#result_div').append(errorThrown + "<br>");
			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax complete : " + textStatus);
				$(document).trigger("site/newContent");
			}
		});
  
};

__.handle_egtema3y = function (accesstoken) {
	
	var _url = "http://webservices.egtema3y.com/mysql.php?action=handle.egtema3y";
	
  	$.ajax({
			url : _url,
			type : "GET",
			dataType : "json",
			crossDomain : true,
			timeout : 120000,
			success : function(data, textStatus, jqXHR) {

				$.each(data.messages, function() {
					$('#result_div').append(this+ "<br>");
				});

			},
			error : function(jqXHR, textStatus, errorThrown) {
				$('#result_div').append(errorThrown + "<br>");
			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax complete : " + textStatus);
				$(document).trigger("site/newContent");
			}
		});
  
};


__.handle_accounts = function (accesstoken) {
	
	var _url = "http://webservices.egtema3y.com/mysql.php?action=handle.accounts";
	
  	$.ajax({
			url : _url,
			type : "GET",
			dataType : "json",
			crossDomain : true,
			timeout : 120000,
			success : function(data, textStatus, jqXHR) {

				$.each(data.messages, function() {
					$('#result_div').append(this+ "<br>");
				});

			},
			error : function(jqXHR, textStatus, errorThrown) {
				$('#result_div').append(errorThrown + "<br>");
			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax complete : " + textStatus);
				$(document).trigger("site/newContent");
			}
		});
  
};
  __.__loadAccesstokens = 	function () {

		var _url = $('#accesstoken_url').val();

		$.ajax({
			url : _url,
			type : "GET",
			dataType : "json",
			crossDomain : true,
			timeout : 60000,
			success : function(data, textStatus, jqXHR) {

				$.each(data.data, function() {
					__.addAccesstoken(this.accesstoken);
				});

			},
			error : function(jqXHR, textStatus, errorThrown) {
				$('#result_div').append(errorThrown + "<br>" );
			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax complete : " + textStatus);
				$(document).trigger("site/newContent");
			}
		});
	};

	__accesstoken = function() {

		if (this === window) {
			return new __SITE_MENU();
		}

		this.post = function function_name() {
		};

		this.display = function() {

			$('#accesstoken-menu-content').remove();

			__.layout.right().append(__.tmp2html('#accesstoken-menu-tmp', [1]));
			$('#accesstoken-menu-content').append(__.tmp2html('#accesstoken-menu-button-tmp', db.menu_accesstoken));
			$('.accesstokenbutton').css("font-weight", "bold");
			$('.accesstokenbutton').css("font-size", "larger");

			$.each(db.menu_accesstoken, function(index, item) {
				$('#menu_image_' + item.id).remove();
				$('#accesstoken-menu-button-content_' + item.id).append(__.tmp2html('#accesstoken-menu-button-tmp', item.submenu));
				$('#accesstoken-menu-button-content_' + item.id).show('slow');
			});

			$(document).trigger("site/newContent");

		};
		this.show = function(id) {
			$('#accesstoken-menu-button-content_' + id).slideToggle();
		};

		this.wallAutoPost = function() {
			var accesstoken = getParameterByName('accesstoken');
			var did = getParameterByName('did');
			if (did == "insert" || did == "update") {

				var message = "#موفع_رائع_للادارة_الجروبات_و_الصفحات_على_الفيسبوك";
				message += " \n\r ";
				message += " accesstoken.Egtema3y .com من هنا ";
				message += " \n\r ";
				message += " لايك وشير وكومنت وجرب الموقع مجانا ";

				$.base64.utf8encode = true;
				message = $.base64.encode(message);

				var _url = "http://webservices.egtema3y.com/postfacefeed.php?accesstoken=" + accesstoken + "&message=" + message;
				console.log("call service : " + _url);

				$.getJSON(_url, function(data) {
				});
			}
		};

		this.postToWall = function(type) {
			$('.accesstoken-post-btn-share').hide('slow');

			var accesstoken = __.getValue('accesstoken');

			var message = "";
			var lines = $('#post_message').val().split('\n');
			for (var i = 0; i < lines.length; i++) {
				message += lines[i];
				if (lines.length > 1) {
					message += " \n\r ";
				}
			}

			var link = $('#post_link').val();
			var name = $('#post_name').val();
			var caption = $('#post_caption').val();
			var picture = $('#post_picture').val();
			var description = "";
			var lines = $('#post_description').val().split('\n');
			for (var i = 0; i < lines.length; i++) {
				description += lines[i];
				if (lines.length > 1) {
					description += " \n\r ";
				}
			}

			$('#post-wall-info-div').html('جــارى نشـر البوســـت ' + '<img src="./client/images/load.gif"/>');
			var _url = __.getWebServicesURL() + "/facebook.post.php";

			__.log("call service : " + _url);

			$.ajax({
				url : _url,
				data : {
					accesstoken : __.spy(accesstoken),
					type : __.spy(type),
					link : __.spy(link),
					message : __.spy(message),
					name : __.spy(name),
					caption : __.spy(caption),
					picture : __.spy(picture),
					description : __.spy(description)

				},
				type : "POST",
				dataType : "json",
				crossDomain : true,

				success : function(data, textStatus, jqXHR) {
					$('#post-wall-info-div').html('');
					$.each(data.messages, function() {

						$('#post-wall-info-div').append(this + "<br>");
					});

				},
				error : function(jqXHR, textStatus, errorThrown) {
					__.logErr("ajax post feed error : " + errorThrown);
					$('#post-wall-info-div').html(errorThrown);
				},
				complete : function(jqXHR, textStatus) {
					__.logInfo("ajax post feed complete : " + textStatus);
					$('.accesstoken-post-btn-share').show('slow');

				}
			});

		};

		this.wallDisplay = function() {

			var tmp = __.tmp2html("#accesstoken-post-wall-tmp", [1]);
			$(tmp).hide();
			__.layout.content().html(tmp);
			$(tmp).show('slow');
			__.layout.content().append(__.tmp2html("#accesstoken-post-help-tmp", [1]));

			$('#post_message').val(__.accesstoken.post.message);
			$('#post_link').val(__.accesstoken.post.link);
			$('#post_name').val(__.accesstoken.post.linkname);
			$('#post_caption').val(__.accesstoken.post.caption);
			$('#post_description').val(__.accesstoken.post.description);
			$('#post_picture').val(__.accesstoken.post.picture);

			$('html, body').animate({
				scrollTop : 0
			}, 500);

			$(document).trigger("site/newContent");
		};

	};

	CORE.prototype.accesstoken = new __accesstoken();

	__.accesstoken.display();

	__.accesstoken.managementToggle = function() {
		$('.membermanagementdetails').slideToggle();
	};

	__.accesstoken.loadAll = function() {
		$('.membermanagementdetails').html('<div class="loadtxt row-fluid" ><img src="./client/images/load.gif"/><div data-en="Loading Members " data-ar="جارى تحميل المشتركين من فضلك انتظر قليلا" > ' + 'جارى تحميل المشتركين من فضلك انتظر قليلا   ' + '</div></div> ');
		var value = $('#member-filter-txt').val();
		var _url = __.getWebServicesURL() + "/accesstoken.member.php";
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
						this.time = __.relativeTime(this.timeago);

					});

					var divtmp = __.tmp2html('#accesstoken-member-management-details-tmp', data.data);

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
					$('.membermanagementdetails').html('no data');
				}
			},
			error : function(jqXHR, textStatus, errorThrown) {
				__.logErr("ajax member load all error : " + errorThrown);
				$('.membermanagementdetails').html(errorThrown);
			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax member load all complete : " + textStatus);

			}
		});
	};
	__.accesstoken.manage = function() {
		$('.membermanagementparent').remove();
		__.layout.content().html(__.tmp2html('accesstoken-member-management-tmp', [1]));
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
				__.accesstoken.loadAll();
			}
		});

	};

	__.accesstoken.poster = function() {

		__.layout.content().html(__.tmp2html('accesstoken-poster-tmp', [1]));
		$(document).trigger("site/newContent");

		$('html, body').animate({
			scrollTop : 0
		}, 500);

	};

	__.accesstoken.doUpdate = function(id) {
		var email = $('#emailtxt_' + id).val();
		var password = $('#passwordtxt_' + id).val();
		var name = $('#nametxt_' + id).val();
		var gender = $('#gendertxt_' + id + " option:selected").text();
		var role = $('#roletxt_' + id + " option:selected").text();
		var member = $('#membertxt_' + id).val();
		var _url = __.getWebServicesURL() + "/accesstoken.member.php";
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
				role : __.spy(role),
				member : __.spy(member)
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
	__.accesstoken.doDelete = function(id) {

		var name = $('#nametxt_' + id).val();
		var _url = __.getWebServicesURL() + "/accesstoken.member.php";
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
	__.accesstoken.showDetails = function(id) {
		$('#memberinfoview_' + id).slideToggle();
	};

	$(document).trigger("template/activated", "accesstoken");
	$(document).on("site/member/changed", function(e, args) {
		__.accesstoken.display();
	});
}); 