<?php

	if ($method == "update" && $object == "site.customer")
	{

		$customer_id = BlockSQL(unspy($_REQUEST["customer_id"]));
		$customer_name = BlockSQL(unspy($_REQUEST["customer_name"]));
		$customer_member_id = BlockSQL(unspy($_REQUEST["customer_member_id"]));
		$customer_address_id = BlockSQL(unspy($_REQUEST["customer_address_id"]));
		$customer_national_id = BlockSQL(unspy($_REQUEST["customer_national_id"]));
		$customer_gender = BlockSQL(unspy($_REQUEST["customer_gender"]));
		$customer_phone = BlockSQL(unspy($_REQUEST["customer_phone"]));
		$customer_mobile1 = BlockSQL(unspy($_REQUEST["customer_mobile1"]));
		$customer_mobile2 = BlockSQL(unspy($_REQUEST["customer_mobile2"]));
		$customer_email = BlockSQL(unspy($_REQUEST["customer_email"]));
		$customer_notes = BlockSQL(unspy($_REQUEST["customer_notes"]));

		$service_phone_owner = BlockSQL(unspy($_REQUEST["service_phone_owner"]));
		$service_phone = BlockSQL(unspy($_REQUEST["service_phone"]));
		$service_region_id = BlockSQL(unspy($_REQUEST["service_region_id"]));
		$service_central_id = BlockSQL(unspy($_REQUEST["service_central_id"]));
		$service_provider_id = BlockSQL(unspy($_REQUEST["service_provider_id"]));
		$service_limit_id = BlockSQL(unspy($_REQUEST["service_limit_id"]));
		$service_speed_id = BlockSQL(unspy($_REQUEST["service_speed_id"]));
		$service_price = BlockSQL(unspy($_REQUEST["service_price"]));
		$service_ip_count = BlockSQL(unspy($_REQUEST["service_ip_count"]));
		$service_payment_type = BlockSQL(unspy($_REQUEST["service_payment_type"]));
		$service_cost = BlockSQL(unspy($_REQUEST["service_cost"]));
		$service_payback_cost = BlockSQL(unspy($_REQUEST["service_payback_cost"]));
		$service_install_address = BlockSQL(unspy($_REQUEST["service_install_address"]));

		$offer_id = BlockSQL(unspy($_REQUEST["offer_id"]));

		$isp_id = BlockSQL(unspy($_REQUEST["isp_id"]));
		$isp_portonframe = BlockSQL(unspy($_REQUEST["isp_portonframe"]));

		$accounting_branch_id = BlockSQL(unspy($_REQUEST["accounting_branch_id"]));
		$accounting_reseller_id = BlockSQL(unspy($_REQUEST["accounting_reseller_id"]));
		$accounting_payment = BlockSQL(unspy($_REQUEST["accounting_payment"]));
		$accounting_remaining_payment = BlockSQL(unspy($_REQUEST["accounting_remaining_payment"]));
		$accounting_payment_day = BlockSQL(unspy($_REQUEST["accounting_payment_day"]));
		$accounting_payment_Period = BlockSQL(unspy($_REQUEST["accounting_payment_Period"]));
		$accounting_warning_day = BlockSQL(unspy($_REQUEST["accounting_warning_day"]));
		$accounting_contract_day = BlockSQL(unspy($_REQUEST["accounting_contract_day"]));

		$security_line_username = BlockSQL(unspy($_REQUEST["security_line_username"]));
		$security_line_password = BlockSQL(unspy($_REQUEST["security_line_password"]));
		$security_router_username = BlockSQL(unspy($_REQUEST["security_router_username"]));
		$security_router_password = BlockSQL(unspy($_REQUEST["security_router_password"]));
		$security_router_wireless = BlockSQL(unspy($_REQUEST["security_router_wireless"]));
		$security_router_serial = BlockSQL(unspy($_REQUEST["security_router_serial"]));
		$security_flasha_serial = BlockSQL(unspy($_REQUEST["security_flasha_serial"]));

		$contract_approved = BlockSQL(unspy($_REQUEST["contract_approved"]));

		$sql = "UPDATE $databasename.$tablename SET ";
		$sql .= " customer_name =  '$customer_name' ";
		$sql .= " ,customer_member_id =  '$customer_member_id' ";
		$sql .= " ,customer_address_id =  '$customer_address_id' ";
		$sql .= " , customer_national_id =  '$customer_national_id' ";
		$sql .= " , customer_gender =  '$customer_gender' ";
		$sql .= " , customer_phone =  '$customer_phone' ";
		$sql .= " , customer_mobile1 =  '$customer_mobile1' ";
		$sql .= " , customer_mobile2 =  '$customer_mobile2' ";
		$sql .= " , customer_email =  '$customer_email' ";
		$sql .= " , customer_notes =  '$customer_notes' ";

		$sql .= " ,service_phone_owner  =  '$service_phone_owner' ";
		$sql .= " , service_phone =  '$service_phone' ";
		$sql .= " , service_region_id =  '$service_region_id' ";
		$sql .= " , service_central_id =  '$service_central_id' ";
		$sql .= " , service_provider_id =  '$service_provider_id' ";
		$sql .= " , service_limit_id =  '$service_limit_id' ";
		$sql .= " , service_speed_id =  '$service_speed_id' ";
		$sql .= " ,service_price  =  '$service_price' ";
		$sql .= " , service_ip_count =  '$service_ip_count' ";
		$sql .= " ,service_payment_type  =  '$service_payment_type' ";
		$sql .= " , service_cost =  '$service_cost' ";
		$sql .= " , service_payback_cost =  '$service_payback_cost' ";
		$sql .= " , service_install_address =  '$service_install_address' ";

		$sql .= " , offer_id =  '$offer_id' ";
		$sql .= " , isp_id =  '$isp_id' ";
		$sql .= " , isp_portonframe =  '$isp_portonframe' ";
		$sql .= " ,  accounting_branch_id=  '$accounting_branch_id' ";
		$sql .= " , accounting_reseller_id =  '$accounting_reseller_id' ";
		$sql .= " , accounting_payment =  '$accounting_payment' ";
		$sql .= " , accounting_remaining_payment =  '$accounting_remaining_payment' ";
		$sql .= " ,accounting_payment_day  =  '$accounting_payment_day' ";
		$sql .= " , accounting_payment_Period =  '$accounting_payment_Period' ";
		$sql .= " , accounting_warning_day =  '$accounting_warning_day' ";
		$sql .= " ,accounting_contract_day  =  '$accounting_contract_day' ";

		$sql .= " , security_line_username =  '$security_line_username' ";
		$sql .= " ,  security_line_password=  '$security_line_password' ";
		$sql .= " , security_router_username =  '$security_router_username' ";
		$sql .= " , security_router_password =  '$security_router_password' ";
		$sql .= " , security_router_wireless =  '$security_router_wireless' ";
		$sql .= " ,security_router_serial  =  '$security_router_serial' ";
		$sql .= " , security_flasha_serial =  '$security_flasha_serial' ";

		$sql .= " ,  contract_approved=  '$contract_approved' ";

		$sql .= " where customer_id='$customer_id' ";

		$oldApproved = "__Pending";
		$sql2 = "select  contract_approved from $databasename.$tablename where customer_id='$customer_id' ";
		$outdata = runQuery($sql2);
		if(!!$outdata && !!$outdata->count && $outdata->count > 0)
		{
			$oldApproved = $outdata -> data[0]['contract_approved'];
		}
		

		$rows = array();

		 execQuery($sql);
setCustomerCountHint();
		if ($contract_approved == "__Approved" && $oldApproved != "__Approved")
		{

			$request_type = BlockSQL('Pending TE');
			$action = BlockSQL('Activation Request');
			$status = BlockSQL('__Pending');
			$notes = BlockSQL('');
			$add_user_id = $customer_member_id;

			$columns = "`id`, `customer_id`, `request_type`, `action`, `status`, `notes`, `modified_time`,`customer_gender` , `customer_name` , `add_user_id`";
			$values = "NULL,'$customer_id','$request_type','$action','$status','$notes',NULL,'$customer_gender' , '$customer_name' , '$add_user_id'";
			$sql = "INSERT INTO $databasename.tebah_request ($columns) VALUES ($values)";

			$outdata =  	execQuery($sql);

		}

	}
?>