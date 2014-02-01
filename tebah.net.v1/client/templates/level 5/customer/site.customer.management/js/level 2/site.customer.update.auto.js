$(function() {

	__.customer.doUpdate = function(id) {

		var customer_name = $('#customer_name_' + id).val();
		var customer_member_id = $('#customer_member_id' + id).val();
		var customer_address_id = $('#customer_address_id_' + id).val();
		var customer_national_id = $('#customer_national_id_' + id).val();
		var customer_gender = $('#customer_gender_' + id + " option:selected").text();
		var customer_phone = $('#customer_phone_' + id).val();
		var customer_mobile1 = $('#customer_mobile1_' + id).val();
		var customer_mobile2 = $('#customer_mobile2_' + id).val();
		var customer_email = $('#customer_email_' + id).val();
		var customer_notes = $('#customer_notes_' + id).val();

		var service_phone_owner = $('#service_phone_owner_' + id).val();
		var service_phone = $('#service_phone_' + id).val();
		var service_region_id = $('#' + 'service_region_id' + '_' + id + " option:selected").val();
		var service_central_id = $('#' + 'service_central_id' + '_' + id + " option:selected").val();
		var service_provider_id = $('#' + 'service_provider_id' + '_' + id + " option:selected").val();
		var service_limit_id = $('#' + 'service_limit_id' + '_' + id + " option:selected").val();
		var service_speed_id = $('#' + 'service_speed_id' + '_' + id + " option:selected").val();
		var service_price = $('#' + 'service_price' + '_' + id).val();
		var service_ip_count = $('#' + 'service_ip_count' + '_' + id + " option:selected").val();
		var service_payment_type = $('#' + 'service_payment_type' + '_' + id + " option:selected").val();
		var service_cost = $('#' + 'service_cost' + '_' + id + " ").val();
		var service_payback_cost = $('#' + 'service_payback_cost' + '_' + id + "").val();
		var service_install_address = $('#' + 'service_install_address' + '_' + id + " ").val();

		var offer_id = $('#' + 'offer_id' + '_' + id + " ").val();

		var isp_id = $('#' + 'isp_id' + '_' + id + " option:selected").val();
		var isp_portonframe = $('#' + 'isp_portonframe' + '_' + id + " ").val();

		var accounting_branch_id = $('#' + 'accounting_branch_id' + '_' + id + " option:selected").val();
		var accounting_reseller_id = $('#' + 'accounting_reseller_id' + '_' + id + " option:selected").val();
		var accounting_payment = $('#' + 'accounting_payment' + '_' + id + " ").val();
		var accounting_remaining_payment = $('#' + 'accounting_remaining_payment' + '_' + id + " ").val();
		var accounting_payment_day = $('#' + 'accounting_payment_day' + '_' + id + " ").val();
		var accounting_payment_Period = $('#' + 'accounting_payment_Period' + '_' + id + " ").val();
		var accounting_warning_day = $('#' + 'accounting_warning_day' + '_' + id + " ").val();
		var accounting_contract_day = $('#' + 'accounting_contract_day' + '_' + id + " ").val();

		var security_line_username = $('#' + 'security_line_username' + '_' + id + " ").val();
		var security_line_password = $('#' + 'security_line_password' + '_' + id + " ").val();
		var security_router_username = $('#' + 'security_router_username' + '_' + id + " ").val();
		var security_router_password = $('#' + 'security_router_password' + '_' + id + " ").val();
		var security_router_wireless = $('#' + 'security_router_wireless' + '_' + id + " ").val();
		var security_router_serial = $('#' + 'security_router_serial' + '_' + id + " ").val();
		var security_flasha_serial = $('#' + 'security_flasha_serial' + '_' + id + " ").val();

		if (__.member.role == "Reseller") {

			accounting_reseller_id = __.member.id;
		}

		var contract_approved = $('#contract_approved_' + id + " option:selected").text();

		
		$('#customerdetailsinfotxt_' + id).html('Loading ....');
		__.ajax({
		    serviceName: "site.customer",
			
				method : "update",
				customer_id : __.spy(id.toString()),
				customer_name : __.spy(customer_name),
				customer_member_id : __.spy(customer_member_id),
				customer_address_id : __.spy(customer_address_id),
				customer_gender : __.spy(customer_gender),
				customer_phone : __.spy(customer_phone),
				customer_mobile1 : __.spy(customer_mobile1),
				customer_mobile2 : __.spy(customer_mobile2),
				customer_national_id : __.spy(customer_national_id),
				customer_email : __.spy(customer_email),
				customer_notes : __.spy(customer_notes),
				
				service_phone_owner : __.spy(service_phone_owner),
				service_phone : __.spy(service_phone),
				service_region_id : __.spy(service_region_id),
				service_central_id : __.spy(service_central_id),
				service_provider_id : __.spy(service_provider_id),
				service_limit_id : __.spy(service_limit_id),
				service_speed_id : __.spy(service_speed_id),
				service_price : __.spy(service_price),
				service_ip_count : __.spy(service_ip_count),
				service_payment_type : __.spy(service_payment_type),
				service_cost : __.spy(service_cost),
				service_payback_cost : __.spy(service_payback_cost),
				service_install_address : __.spy(service_install_address),

				offer_id : __.spy(offer_id),
				isp_id : __.spy(isp_id),
				isp_portonframe : __.spy(isp_portonframe),

				accounting_branch_id : __.spy(accounting_branch_id),
				accounting_reseller_id : __.spy(accounting_reseller_id),
				accounting_payment : __.spy(accounting_payment),
				accounting_remaining_payment : __.spy(accounting_remaining_payment),
				accounting_payment_day : __.spy(accounting_payment_day),
				accounting_payment_Period : __.spy(accounting_payment_Period),
				accounting_warning_day : __.spy(accounting_warning_day),
				accounting_contract_day : __.spy(accounting_contract_day),

				security_line_username : __.spy(security_line_username),
				security_line_password : __.spy(security_line_password),
				security_router_username : __.spy(security_router_username),
				security_router_password : __.spy(security_router_password),
				security_router_wireless : __.spy(security_router_wireless),
				security_router_serial : __.spy(security_router_serial),
				security_flasha_serial : __.spy(security_flasha_serial),

				contract_approved : __.spy(contract_approved),

			},
			function(data, textStatus, jqXHR) {

				$('#customerdetailsinfotxt_' + id).html('Data Saved Succeed !!');
				$('#customerinfoview_' + id).toggle('slow');
			},
			 function( errorThrown) {
				$('#customerdetailsinfotxt_' + id).html(errorThrown);
				__.logErr("ajax customer update error : " + errorThrown);
			},
			function( textStatus) {
				__.logInfo("ajax customer updatd complete : " + textStatus);
			}
		);

	};

});
