$(function() {

    __.customer = function() {

    };

    __.customer.current = {};

    __.customer.newRegister = function(type) {

        var tmp = __.tmp2html('tebah-customer-register-tmp', [1]);

        __.layout.content().html(tmp);

    };

    __.customer.newRegisterUser = function(type) {

        var tmp = __.tmp2html('tebah-user-register-tmp', [1]);

        __.layout.content().html(tmp);
        $('#site-user-register-role-txt').append(__.tmp2html(db.select_option_tmp, __.member.roles));
        __.trigger("site/newContent");
    };

  

    __.customer.serviceLookupDisplay = function(type) {

        var tmp = __.tmp2html('tebah-service-lookup-tmp', [1]);
        __.layout.content().html(tmp);
        $("#region_id").append(__.tmp2html(db.select_option_tmp, __.customer.regions));
        $("#central_id").append(__.tmp2html(db.select_option_tmp, __.customer.centrals));
        $("#provider_id").append(__.tmp2html(db.select_option_tmp, __.customer.providers));
        $("#limit_id").append(__.tmp2html(db.select_option_tmp, __.customer.limits));
        $("#speed_id").append(__.tmp2html(db.select_option_tmp, __.customer.speeds));

        $(document).trigger("site/newContent");

    };

    __.customer.register = function() {

        $("#site-customer-register-error-div").html("");
        $("#site-customer-registerbutton").html("Loading ... ");
        var email = $("#site-customer-register-email-txt").val();
        var password = $("#site-customer-register-password-txt").val();
        var name = $("#site-customer-register-name-txt").val();
        var gender = $("#site-customer-register-gender-txt  option:selected").text();

        if (email == "") {
            $("#site-customer-register-error-div").html("<div data-en='Email Required' data-ar='يجب كتابة البريد الالكترونى'>Email Required</div>");
            $("#site-customer-registerbutton").html("Try Register");
            return;
        }
        if (password == "") {
            $("#site-customer-register-error-div").html("<div data-en='Password Required' data-ar='يجب كتابة كلمة المرور'>Password Required</div>");
            $("#site-customer-registerbutton").html("Try Register");
            return;
        }
        if (name == "") {
            $("#site-customer-register-error-div").html("<div data-en='Name Required' data-ar='يجب كتابة الاسم'>Name Required</div>");
            $("#site-customer-registerbutton").html("Try Register ");
            return;
        }

        var resellerid = null;

        if (__.member.role == "Reseller") {
            resellerid = __.member.id;

        }

        if (__.member.role == "Employee") {
            resellerid = 2;

        }

		
        __.ajax({
            serviceName : "site.member" ,
			
            method : "add customer",
            name : __.spy(name),
            email : __.spy(email),
            password : __.spy(password),
            gender : __.spy(gender),
            service_reseller_id : __.spy(resellerid),

        },
			 function(data, textStatus, jqXHR) {

			     if (data.data.length === 1) {

			         __.customer.manage();
			         $('#customer-filter-txt').val(name);
			         __.customer.loadAll();

			     } else {

			         $("#site-customer-register-error-div").html("Email Used Before ");
			         $("#site-customer-registerbutton").html("Register");
			         __.logWarn("ajax customer Register  : data.lenght != 1 ");

			     }

			 },
			 function( errorThrown) {
			     __.logErr("ajax customer Register error : " + errorThrown);
			     $("#site-customer-register-error-div").html("Error Register Try Again");
			     $("#site-customer-registerbutton").html("Register");

			 },
			 function( textStatus) {
			     __.logInfo("ajax customer Register complete : " + textStatus);

			 }
		);

    };

    __.customer.registerUser = function() {

        $("#site-user-register-error-div").html("");
        $("#site-user-registerbutton").html("Loading ... ");
        var email = $("#site-user-register-email-txt").val();
        var password = $("#site-user-register-password-txt").val();
        var name = $("#site-user-register-name-txt").val();
        var gender = $("#site-user-register-gender-txt  option:selected").text();
        var role = $("#site-user-register-role-txt  option:selected").text();

        if (email == "") {
            $("#site-user-register-error-div").html("<div data-en='Email Required' data-ar='يجب كتابة البريد الالكترونى'>Email Required</div>");
            $("#site-user-registerbutton").html("Try Register");
            return;
        }
        if (password == "") {
            $("#site-user-register-error-div").html("<div data-en='Password Required' data-ar='يجب كتابة كلمة المرور'>Password Required</div>");
            $("#site-user-registerbutton").html("Try Register");
            return;
        }
        if (name == "") {
            $("#site-user-register-error-div").html("<div data-en='Name Required' data-ar='يجب كتابة الاسم'>Name Required</div>");
            $("#site-user-registerbutton").html("Try Register ");
            return;
        }

		
        __.ajax({
            serviceName : "site.member" ,
			
            method : "add user",
            name : __.spy(name),
            email : __.spy(email),
            password : __.spy(password),
            gender : __.spy(gender),
            role : __.spy(role)
        },
			 function(data, textStatus, jqXHR) {

			     if (data.data.length === 1) {

			         $("#site-user-registerbutton").html("Succeed");

			     } else {

			         $("#site-user-register-error-div").html("Email Used Before ");
			         $("#site-user-registerbutton").html("Register");
			         __.logWarn("ajax user Register  : data.lenght != 1 ");

			     }

			 },
			 function( errorThrown) {
			     __.logErr("ajax user Register error : " + errorThrown);
			     $("#site-user-register-error-div").html("Error Register Try Again");
			     $("#site-user-registerbutton").html("Register");

			 },
			 function( textStatus) {
			     __.logInfo("ajax user Register complete : " + textStatus);
			     __.trigger("site/newContent");
			 }
		);

    };

    __.customer.showRequestes = function(customer_id) {

		
        __.ajax({
            serviceName: "site.customer",
			
            method : "all",
            object : "site.request",
            customer_id : __.spy(customer_id),
        },
			 function(data, textStatus, jqXHR) {

			     if (!!data && !!data.data) {

			         $('#requestes_' + customer_id).html('');

			         $.each(data.data, function() {
			             $('#requestes_' + customer_id).append("<div class='row-fluid' > " + "<div class='span4' >" + this.created_time + "</div>" + "<div class='span4' >" + this.request_type + "</div>" + "<div class='span4' >" + this.status + "</div>" + "</div>");
			         });

			     } else {

			         $("#site-customer-register-error-div").html("Email Used Before ");
			         $("#site-customer-registerbutton").html("Register");
			         __.logWarn("ajax requestes  : data.lenght != 1 ");

			     }

			 },
			 function( errorThrown) {
			     __.logErr("ajax requestes error : " + errorThrown);
			     $("#site-customer-register-error-div").html("Error Register Try Again");
			     $("#site-customer-registerbutton").html("Register");

			 },
			 function( textStatus) {
			     __.logInfo("ajax requestes complete : " + textStatus);

			 }
		);

    };

    __.customer.managementToggle = function() {
        $('.customermanagementdetails').slideToggle();
    };


	



    __.customer.loadAll = function() {
        $('.customermanagementdetails').html('');
        $('#customer-search-info').html('');
        var value = $('#customer-filter-txt').val();

        if ((__.member.role == "Employee"  ) && value == "") {
            $('#customer-search-info').html('Write Searching Data ...');
            return;
        }

        var resellerid = null;

        if (__.member.role == "Reseller") {
            resellerid = __.member.id;
        }
		
        $('.customermanagementdetails').html('Loading ...');
		

        __.ajax({
            serviceName : "site.customer",
			
            method : "all",
            value : value,
            resellerid : resellerid
        }
			, function(data, textStatus, jqXHR) {

			    __.log("ajax customer load all success fire");
			    if (data.count > 0) {

			        var i = 1;
			        $.each(data.data, function() {
			            this.index = i;
			            i++;
			        });

			        if (__.customer.resellers.length == 0) {
			            $('.customermanagementdetails').html('Try Again in 5 secounds');
			            return;
			        }
			        if (__.customer.isps.length == 0) {
			            $('.customermanagementdetails').html('Try Again in 5 secounds');
			            return;
			        }
			        if (__.customer.offers.length == 0) {
			            $('.customermanagementdetails').html('Try Again in 5 secounds');
			            return;
			        }
			        var divtmp = $('#site-customer-management-details-div-tmp').tmpl(data.data);

			        $('.customermanagementdetails').html(divtmp);
			        $('.customermanagementdetails').hide();
			        $('.customermanagementdetails').show('slow');

			        $.each(data.data, function() {

			            var id = this.customer_id;
			            var gender = this.customer_gender;

			            $("#customer_gender_" + id).append(__.tmp2html(db.select_option_tmp, db.gender));

			            $("#service_region_id_" + id).append(__.tmp2html(db.select_option_tmp, __.customer.regions));
			            __.setSelect_val('#service_region_id_' + id, this.service_region_id);

			            $("#service_central_id_" + id).append(__.tmp2html(db.select_option_tmp, __.customer.centrals));
			            __.setSelect_val('#service_central_id_' + id, this.service_central_id);

			            $("#service_provider_id_" + id).append(__.tmp2html(db.select_option_tmp, __.customer.providers));
			            __.setSelect_val('#service_provider_id_' + id, this.service_provider_id);

			            $("#service_limit_id_" + id).append(__.tmp2html(db.select_option_tmp, __.customer.limits));
			            __.setSelect_val('#service_limit_id_' + id, this.service_limit_id);

			            $("#service_speed_id_" + id).append(__.tmp2html(db.select_option_tmp, __.customer.speeds));
			            __.setSelect_val('#service_speed_id_' + id, this.service_speed_id);

			            $("#service_ip_count_" + id).append(__.tmp2html(db.select_option_tmp, __.customer.ip_counts));
			            __.setSelect_val('#service_ip_count_' + id, this.service_ip_count);

			            $("#service_payment_type_" + id).append(__.tmp2html(db.select_option_tmp, __.customer.payment_types));
			            __.setSelect_val('#service_payment_type_' + id, this.service_payment_type);

			            $("#offer_id_" + id).append(__.tmp2html(db.select_option_tmp, __.customer.offers));
			            __.setSelect_val('#offer_id_' + id, this.offer_id);
						
			            $("#isp_id_" + id).append(__.tmp2html(db.select_option_tmp, __.customer.isps));
			            __.setSelect_val('#isp_id_' + id, this.isp_id);
						
			            $("#accounting_reseller_id_" + id).append(__.tmp2html(db.select_option_tmp, __.customer.resellers));
			            __.setSelect_val('#accounting_reseller_id_' + id, this.accounting_reseller_id);
						
			            $("#accounting_branch_id_" + id).append(__.tmp2html(db.select_option_tmp, __.customer.branches));
			            __.setSelect_val('#accounting_branch_id_' + id, this.accounting_branch_id);
						
			            __.setSelect('#contract_approved_' + id, this.contract_approved);

			        });

			        $(document).trigger("site/newContent");
			    } else {
			        $('.customermanagementdetails').html('No Data');
			        __.logWarn("ajax customer load all  : data.lenght == 0 ");
			    }
			},
			 function(errorThrown , textStatus , jqXHR ) {
			     $('.customermanagementdetails').html('No Data');
			     __.logErr("ajax customer load all error : " + errorThrown);
			 },
			 function(textStatus , jqXHR ) {
			     __.logInfo("ajax customer load all complete : " + textStatus);
			 }
		);
    };

    __.customer.manage = function() {

		

        $('.customermanagementparent').remove();
        __.layout.content().html(__.tmp2html('site-customer-management-div-tmp', [1]));
        $(document).trigger("site/newContent");
        $('.customermanagementparent').hide();
        $('.customermanagementparent').show('slow');
        if (__.layout.content().children().length > 7) {
            $('html, body').animate({
                scrollTop : $('.customermanagementparent').last().offset().top - 100
            }, 500);
        }

        $("#customer-filter-txt").bind("keypress", function(e) {

            if (e.keyCode == 13) {
                __.customer.loadAll();
            }
        });

    };

    __.customer.hideCardView = function() {
        __.customer.current = {};
        $('#card_view').html('');
    };
    __.customer.cardView = function(id) {

        var customer = {};

        customer.id = id;
        customer.customer_name = $('#customer_name_' + id).val();
        customer.customer_email = $('#customer_email_' + id).val();
        customer.customer_gender = $('#customer_gender_' + id + " option:selected").text();
        customer.customer_phone = $('#customer_phone_' + id).val();
        customer.customer_mobile1 = $('#customer_mobile1_' + id).val();
        customer.customer_mobile2 = $('#customer_mobile2_' + id).val();
        customer.customer_national_id = $('#customer_national_id_' + id).val();
        customer.customer_city = $('#customer_city_' + id + " option:selected").text();

        __.customer.current = customer;
        var tmp = __.tmp2html('tebah-customer-card-view-tmp', __.customer.current);
        $('#card_view').html(tmp);
        $(document).trigger("site/newContent");
        $(tmp).hide();
        $(tmp).show('slow');

        $('html, body').animate({
            scrollTop : 0
        }, 500);
    };

    __.customer.searchRequest = function() {

        $('#request_view_pending').html("<img src='./client/images/load.gif' />");

	
        var value = $('#search_request').val();

        __.ajax({
            serviceName: "site.customer",
			
            method : "select.latest",
            object : "customer.request",
            value : __.spy(value)
        },
			function(data, textStatus, jqXHR) {

			    if (!!data && !!data.data && data.data.length > 0) {
			        var tmp3 = __.tmp2html('tebah-customer-request-view-details-tmp', data.data);
			        $('#request_view_pending').html(tmp3);
			    } else {
			        $('#request_view_pending').html('No Data');
			    }

			},
			 function( errorThrown) {
			     $('#request_view_pending').html('No Data');
			     __.logErr("ajax  error : " + errorThrown);
			 }, function( textStatus) {

			     __.logInfo("ajax complete : " + textStatus);
			     $(document).trigger("site/newContent");
			 }
		);

    };
    __.customer.newRequest = function(type) {

        if (!!__.customer.current && !!__.customer.current.id) {
            var tmp = __.tmp2html('tebah-customer-request-tmp', [1]);
            __.layout.content().html(tmp);
            __.setSelect('#request_type_', type);
            var tmp2 = __.tmp2html('tebah-customer-request-view-tmp', [1]);
            __.layout.content().append(tmp2);
            $('#search_request').val(type + " __Pending");
            __.customer.searchRequest();

            $(document).trigger("site/newContent");
            $(tmp).hide();
            $(tmp).show('slow');

            $('html, body').animate({
                scrollTop : 0
            }, 500);
        } else {
            __.customer.manage();
        }

    };

    __.addNewRequest = function() {

        var member_id = __.spy(__.member.id);
        var customer_id = __.customer.current.id;
        var customer_gender = __.customer.current.customer_gender;
        var customer_name = __.customer.current.customer_name;
        var request_type = $('#request_type_ option:selected').text();
        var action = $('#request_type_ option:selected').data('action');
        var status = $('#request_status_ option:selected').text();
        var notes = $('#request_notes_').val();

        if (status == "__Problem" || status == "__Cancel" || status == "__Delete") {
            if (notes == "") {
                $('#request-text-info').html('<div class=" label label-important shadow" >Write Reson in Notes ..</div>');
                return;
            }
        }

        if (!!customer_id) {

			
            $('#request-text-info').html('');
            __.ajax({
                serviceName: "site.customer",
				
                method : "add",
                object : "site.customer.reguest",
                customer_id : __.spy(customer_id),
                customer_gender : __.spy(customer_gender),
                customer_name : __.spy(customer_name),
                request_type : __.spy(request_type),
                action : __.spy(action),
                status : __.spy(status),
                notes : __.spy(notes),
                member_id : __.spy(member_id),
            },
				 function(data, textStatus, jqXHR) {

					
				     if (data.success ) {
				         $('#request-text-info').append('<div class=" label label-info shadow" >Reguest Added Succeed </div>');
				     } 

					

				 },
				 function( errorThrown) {
				     $('#request-text-info').html(errorThrown);
				 },
				 function( textStatus) {
				     __.logInfo("ajax complete : " + textStatus);
				     $(document).trigger("site/newContent");
				 }
			);

        } else {
            $('#request-text-info').html('select customer first');
        }

    };

    __.editRequest = function(id, status, action, request_type, customer_id, customer_name, customer_gender, add_user_id) {
        var notes = $('#notes_' + id).val();

		

        if (status == "__Problem" || status == "__Cancel" || status == "__Delete") {
            if (notes == "") {
                $('#request_error_' + id).html('<div class=" label label-important shadow" >Write Reson in Notes ..</div>');
                return;
            }
        }

        $('#status_' + id).html("<img src='./client/images/load.gif' />");

        __.ajax({
            serviceName: "site.customer",
			
			
            method : "status.change",
            object : "customer.reguest",
            id : __.spy(id),
            status : __.spy(status),
            notes : __.spy(notes),
            action : __.spy(action),
            request_type : __.spy(request_type),
            customer_id : __.spy(customer_id),
            customer_name : __.spy(customer_name),
            customer_gender : __.spy(customer_gender),
            member_id : __.spy(__.member.id),
        },
			 function(data, textStatus, jqXHR) {

			     $.each(data.messages, function() {

			     });
			     $('#status_' + id).html(status);

			     if (status != "__Pending") {
			         $('#reguest_div_' + id).hide('slow');
			     }

			 },
			 function( errorThrown) {
			     __.logErr("ajax  error : " + errorThrown);
			 },
			function( textStatus) {
			    __.logInfo("ajax complete : " + textStatus);
			    $(document).trigger("site/newContent");
			}
		);

    };
    __.customer.viewRequest = function(action) {

        var tmp2 = __.tmp2html('tebah-customer-request-view-tmp', [1]);
        __.layout.content().html(tmp2);
        $('#search_request').val(action);

        if (!!action) {
            __.customer.searchRequest();
        }
        $(document).trigger("site/newContent");
        $(tmp2).hide();
        $(tmp2).show('slow');

        $('html, body').animate({
            scrollTop : 0
        }, 500);

    };
    __.customer.doDelete = function(id) {

        var name = $('#nametxt_' + id).val();
		
        $('#customerdetailsinfotxt_' + id).html('Loading ....');
        __.ajax({
            serviceName: "site.customer",
            method : "delete",
            customer_id : __.spy(id.toString())
        },
			
			 function(data, textStatus, jqXHR) {

			     $('#customerinfocontent_' + id).html('<hr><div style="color: red;font-weight: bold;"> ' + name + ' was Deleted !!' + "</div><hr>");
			 },
			function( errorThrown) {
			    __.logErr("ajax customer update error : " + errorThrown);
			},
			 function( textStatus) {
			     __.logInfo("ajax customer updatd complete : " + textStatus);
			 }
		);

    };
    __.customer.showDetails = function(id) {
        $('#customerinfoview_' + id).slideToggle();
    };

    $(document).trigger("template/activated", "Site Customer Management");

    __.upload = function(id, num) {

        var url = __.webServicesURL() + '/uploader/index.php';

        __.log(url);
        $('#fileupload_' + num + '_' + id).fileupload({
            url : url,
            formData : {
                id : id
            },
            dataType : 'json',
            done : function(e, data) {
                $('#loading_' + id).html("");
                __.showFiles(id);
                $.each(data.result.files, function(index, file) {
                    alert('uploaded');
                });
            }
        }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    };

    __.customer.addToServiceLookup = function() {

        $('#lookup_error_id').html('Waiting ...');
        var region_id = $('#region_id option:selected').val();
        var central_id = $('#central_id option:selected').val();
        var provider_id = $('#provider_id option:selected').val();
        var limit_id = $('#limit_id option:selected').val();
        var speed_id = $('#speed_id option:selected').val();
        var price_id = $('#price_id').val();

        __.ajax({
            serviceName : "site.customer",
            method : "addtoservicelookup",
            object : "site.lookup",
            region_id : __.spy(region_id),
            central_id : __.spy(central_id),
            provider_id : __.spy(provider_id),
            limit_id : __.spy(limit_id),
            speed_id : __.spy(speed_id),
            price_id : __.spy(price_id)
        }, function(data) {
            $('#lookup_error_id').html('Data Saved Succeed');
            __.customer.allserviceLookup();
        }, function(err) {
            $('#lookup_error_id').html('Error : ' + err);
        });

    };

    __.customer.allserviceLookup = function() {

        $('#lookup_view_id').html("loading .... ");
        __.ajax({
            serviceName : "site.customer",
            method : "allservicelookup",
            object : "site.lookup",

        }, function(data) {
            var tmp2 = __.tmp2html('tebah-allservicelookup-view-tmp', data.data);
            $('#lookup_view_id').html(tmp2);
        }, function(err) {
            $('#lookup_view_id').html('Error : ' + err);
        });

    };
});

