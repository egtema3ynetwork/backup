$(function() {

	__SITE_MEMBER = function() {

		if (this === window) {
			return new __SITE_MEMBER();
		}

		this.id = "";
		this.name = "";
		this.email = "";
		this.password = "";
		this.gender = "";
		this.role = "Anyone";
		this.ip = "";
		this.accesstoken = "";
		this.clearErrors = function() {
			$("#site-register-error-div").html("");
			$("#site-login-error-div").html("");
		};
		this.clearData = function() {
			__.setValue("member_email", "");
			__.setValue("member_password", "");
			__.setValue("member_name", "");
			__.setValue("member_id", "");
			__.setValue("member_gender", "");
			__.setValue("member_faceid", "");
			__.setValue("member_accesstoken", "");
			__.setValue("member_role", "Anyone");
			__.setValue("member_accesstoken", "");
			__.setValue("accesstoken", "");
			this.id = "";
			this.faceid = "";
			this.name = "";
			this.email = "";
			this.password = "";
			this.gender = "";
			this.role = "Anyone";
			this.ip = "";
			this.accesstoken = "";
			this.imageurl = "";
		};
		this.setUserData = function(data) {

			__.member.name = data.name;
			__.member.id = data.id;
			__.member.faceid = data.userid;
			__.member.role = data.role;
			__.member.gender = data.gender;
			__.member.email = data.email;
			__.member.ip = data.latest_ip;
			__.member.accesstoken = data.accesstoken;

			if (!!__.member.faceid) {
				__.member.imageurl = 'https://graph.facebook.com/' + __.member.faceid + '/picture?type=square';
			} else {
				__.member.imageurl = './client/images/' + __.member.gender + '.jpg';
			}

			__.setValue("member_name", __.member.name);
			__.setValue("member_id", __.member.id);
			__.setValue("member_role", __.member.role);
			__.setValue("member_gender", __.member.gender);
			__.setValue("member_email", __.member.email);
			__.setValue("member_ip", __.member.ip);
			__.setValue("member_accesstoken", __.member.accesstoken);
			__.setValue("accesstoken", __.member.accesstoken);
			__.setValue("member_faceid", __.member.faceid);
			__.setValue("member_imageurl", __.member.imageurl);
		};

		this.roles = [];
		this.loadRoles = function(argument) {
			
				__.member.roles = __.data.site_role_view_list;
			

		};

		this.login = function() {

			this.clearErrors();

			if (__.isDemoMode() === true) {
				$("#site-login-error-div").html("soon");
				$("#site-member-loginbutton").html("Login");
				return;
			}

			$("#site-member-loginbutton").html("Loading ... ");
			this.email = $("#site-member-email-txt").val();
			this.password = $("#site-member-password-txt").val();
			this.accesstoken = !!__.getValue('accesstoken') ? __.getValue('accesstoken') : "";
			
			__.ajax({
			    serviceName: "site.member",
				
					email : __.spy(this.email),
					password : __.spy(this.password),
					accesstoken : this.accesstoken
				},
				 function(data, textStatus, jqXHR) {

					__.log("ajax login success fire" + data);
					if (!!data && data.data.length === 1) {
						__.member.clearData();
						__.member.setUserData(data.data[0]);

						__.member.sayWelcome();

					} else {

						__.member.logout();
						$("#site-login-error-div").html("<div data-en='Error Login Try Again' data-ar=' خطأ حاول مرة اخرى'>Error Login Try Again</div>");
						$("#site-member-loginbutton").html("<div data-en='Login' data-ar='تسجيل الدخول'>Login</div>");

						__.logWarn("ajax member login  : data.lenght != 1 ");
					}

				},
				 function(jqXHR, textStatus, errorThrown) {
					__.member.logout();
					__.logErr("ajax member login error : " + errorThrown);
					$("#site-login-error-div").html("<div data-en='Error Login Try Again' data-ar=' خطأ حاول مرة اخرى'>Error Login Try Again</div>");
					$("#site-member-loginbutton").html("<div data-en='Login' data-ar='تسجيل الدخول'>Login</div>");

				},
				 function( textStatus) {
					__.logInfo("ajax member login complete : " + textStatus);
					$(document).trigger("site/newContent");
				}
			);

		};
		this.register = function() {

			this.clearErrors();

			if (__.isDemoMode() === true) {
				$("#site-register-error-div").html("Soon");
				$("#site-member-registerbutton").html("Register");
				return;
			}

			this.clearData();

			$("#site-member-registerbutton").html("Loading ... ");
			this.email = $("#site-register-email-txt").val();
			this.password = $("#site-register-password-txt").val();
			this.name = $("#site-register-name-txt").val();
			this.gender = $("#site-register-gender-txt  option:selected").text();

			if (this.email == "") {
				$("#site-member-register-error-div").html("<div data-en='Email Required' data-ar='يجب كتابة البريد الالكترونى'></div>");
				$(document).trigger("site/member/changed");
				return;
			}
			if (this.password == "") {
				$("#site-member-register-error-div").html("<div data-en='Password Required' data-ar='يجب كتابة كلمة المرور'></div>");
				$(document).trigger("site/member/changed");
				return;
			}
			if (this.name == "") {
				$("#site-member-register-error-div").html("<div data-en='Name Required' data-ar='يجب كتابة الاسم'></div>");
				$(document).trigger("site/member/changed");
				return;
			}

			
			__.ajax({
			    serviceName: "site.member",
			
					method : "add",
					name : __.spy(this.name),
					email : __.spy(this.email),
					password : __.spy(this.password),
					gender : __.spy(this.gender)
				},
				 function(data, textStatus, jqXHR) {

					if (data.data.length === 1) {

						__.member.setUserData(data.data[0]);

						__.member.sayWelcome();

					} else {

						$("#site-member-register-error-div").html("Email Used Before ");
						$("#site-member-registerbutton").html("Register");
						__.logWarn("ajax member Register  : data.lenght != 1 ");

					}

				},
				 function(jqXHR, textStatus, errorThrown) {
					__.logErr("ajax member Register error : " + errorThrown);
					$("#site-member-register-error-div").html("Error Register Try Again");
					$("#site-member-registerbutton").html("Register");

				},
				 function(jqXHR, textStatus) {
					__.logInfo("ajax member Register complete : " + textStatus);

				}
			);

		};
		this.logout = function() {

			this.clearErrors();
			this.clearData();

			__.log("__.member.logout();");

			$("#site-member-content-div").hide();
			$("#site-member-content-div").html(__.tmp2html('site-member-login-div-tmp', [1]));
			$("#site-member-content-div").show('slow');

			__.trigger("site/newContent");
			__.trigger("site/member/logout");
			__.trigger("site/member/changed");
		};
		this.gotoFacebooky = function() {
			window.open("http://facebooky.egtema3y.com");
		};

		this.check = function() {
			this.clearErrors();

			$("#site-member-content-div").html('');

			this.id = __.getValue("member_id");
			this.name = __.getValue("member_name");
			this.gender = __.getValue("member_gender");
			this.email = __.getValue("member_email");
			this.role = __.getValue("member_role");
			this.ip = __.getValue("member_ip");
			this.accesstoken = __.getValue("member_accesstoken");
			this.faceid = __.getValue("member_faceid");
			this.imageurl = __.getValue("member_imageurl");

			if (__.getValue('accesstoken')) {
				__.member.login();
				return;
			}

			if (!!this.name) {

				__.member.sayWelcome();

			} else {
				this.clearData();
				this.showLogin();
			}
		};
		this.sayWelcome = function() {

			$("#site-member-content-div").hide();
			$('#site-member-content-div').html(__.tmp2html('site-member-welcome-div-tmp', [1]));

			$("#site-member-welcome-name").html(this.name);
			$("#site-member-welcome-email").html(this.email);
			$("#site-member-welcome-role").html(this.role);
			$("#site-member-welcome-ip").html(this.ip);

			$('#site-member-welcome-img').html("<img class='shadow' src='" + this.imageurl + "' style='width:40px;height:40px;'/>");

			$("#site-member-welcome-div").show("slow");
			$("#site-member-content-div").show('slow');

			$(document).trigger("site/newContent");
			$(document).trigger("site/member/changed");
		};
		this.display = function() {
			$('.__site_member_div').remove();
			this.clearErrors();
			__.layout.right().append(__.tmp2html('site-member-div-tmp', [1]));
			__.member.loadRoles();
			$(document).trigger("template/activated", "Site Member");
			$(document).trigger("site/newContent");
		};
		this.showRegister = function() {
			this.clearErrors();
			$("#site-member-content-div").hide();
			$("#site-member-content-div").html(__.tmp2html('site-member-register-div-tmp', [1]));
			$("#site-member-content-div").show('slow');

			$(document).trigger("site/newContent");
		};
		this.showLogin = function() {
			this.clearErrors();
			$("#site-member-content-div").hide();
			$("#site-member-content-div").html(__.tmp2html('site-member-login-div-tmp', [1]));
			$("#site-member-content-div").show('slow');

			$("#site-member-email-txt").on("keypress", function(e) {

				if (e.keyCode == 13) {
					__.member.login();
				}
			});

			$("#site-member-password-txt").bind("keypress", function(e) {

				if (e.keyCode == 13) {
					__.member.login();
				}
			});

			$(document).trigger("site/newContent");
		};
		this.toggle = function() {
			$("#site-member-content-div").slideToggle();
		};

		this.getAllMembers = function() {

			
			__.ajax({
			    serviceName: "site.member",
				
					method : "all"
				},
				 function(data, textStatus, jqXHR) {

					__.log("ajax get all members success fire");
					$.each(data.data, function() {

						$('#testtxt').append(this.member_name + "<br>");

					});

				},
				 function( errorThrown) {
					__.logErr("ajax member login error : " + errorThrown);

				},
				 function( textStatus) {

				}
			);

		};

	};

	var __member = new __SITE_MEMBER();
	CORE.prototype.member = __member;

	__.trigger("layout/ready", null, function(args) {
		__.trigger("site/member/changed", null, function(args) {
			__.member.applaySecurity();
		});

		__.trigger("site/newContent", null, function(args) {
			__.member.applaySecurity();
		});

		__.member.display();
		__.member.check();
	});

});

