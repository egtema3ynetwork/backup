<?php




if ($method == "status.change" && $object == "customer.reguest") {

	$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';
	$condition = "";
	if (!!$value) {
		$condition = " and customer_name like '%$value%' or customer_email like '%$value%' or customer_phone like '%$value%' or customer_national_id like '%$value%' or customer_city like '%$value%' or customer_gender like '$value'";
	}

	$tablename = "tebah_request";
	$databasename = DB_NAME;

	$request_type = BlockSQL(unspy($_REQUEST["request_type"]));
	$action = BlockSQL(unspy($_REQUEST["action"]));
	$status = BlockSQL(unspy($_REQUEST["status"]));
	$notes = BlockSQL(unspy($_REQUEST["notes"]));
	$id = BlockSQL(unspy($_REQUEST["id"]));

	$sql = "update $databasename.$tablename set status='$status' , notes='$notes' where id='$id' " . $condition . " ;";

	mysql_query($sql, $con);

	if ($request_type == "Pending TE" && $status == "__Approved") {

		$customer_id = BlockSQL(unspy($_REQUEST["customer_id"]));
		$customer_gender = BlockSQL(unspy($_REQUEST["customer_gender"]));
		$customer_name = BlockSQL(unspy($_REQUEST["customer_name"]));
		$request_type = BlockSQL('Pending WO');
		$action = BlockSQL('Activation Request');
		$status = BlockSQL('__Pending');
		$notes = BlockSQL('');
		$add_user_id = BlockSQL(unspy($_REQUEST["member_id"]));

		$columns = "`id`, `customer_id`, `request_type`, `action`, `status`, `notes`, `modified_time`,`customer_gender` , `customer_name` , `add_user_id`";
		$values = "NULL,'$customer_id','$request_type','$action','$status','$notes',NULL,'$customer_gender' , '$customer_name' , '$add_user_id'";
		$sql = "INSERT INTO $databasename.$tablename ($columns) VALUES ($values)";
		mysql_query($sql, $con);
		$requestid = mysql_insert_id();

	}

	if ($request_type == "Pending WO" && $status == "__Approved") {

		$customer_id = BlockSQL(unspy($_REQUEST["customer_id"]));
		$customer_gender = BlockSQL(unspy($_REQUEST["customer_gender"]));
		$customer_name = BlockSQL(unspy($_REQUEST["customer_name"]));
		$request_type = BlockSQL('Pending Splitting');
		$action = BlockSQL('Activation Request');
		$status = BlockSQL('__Pending');
		$notes = BlockSQL('');
		$add_user_id = BlockSQL(unspy($_REQUEST["member_id"]));

		$columns = "`id`, `customer_id`, `request_type`, `action`, `status`, `notes`, `modified_time`,`customer_gender` , `customer_name` , `add_user_id`";
		$values = "NULL,'$customer_id','$request_type','$action','$status','$notes',NULL,'$customer_gender' , '$customer_name' , '$add_user_id'";
		$sql = "INSERT INTO $databasename.$tablename ($columns) VALUES ($values)";
		mysql_query($sql, $con);
		$requestid = mysql_insert_id();

	}

	if ($request_type == "Pending Splitting" && $status == "__Approved") {

		$customer_id = BlockSQL(unspy($_REQUEST["customer_id"]));
		$customer_gender = BlockSQL(unspy($_REQUEST["customer_gender"]));
		$customer_name = BlockSQL(unspy($_REQUEST["customer_name"]));
		$request_type = BlockSQL('Pending Installing');
		$action = BlockSQL('Activation Request');
		$status = BlockSQL('__Pending');
		$notes = BlockSQL('');
		$add_user_id = BlockSQL(unspy($_REQUEST["member_id"]));

		$columns = "`id`, `customer_id`, `request_type`, `action`, `status`, `notes`, `modified_time`,`customer_gender` , `customer_name` , `add_user_id`";
		$values = "NULL,'$customer_id','$request_type','$action','$status','$notes',NULL,'$customer_gender' , '$customer_name' , '$add_user_id'";
		$sql = "INSERT INTO $databasename.$tablename ($columns) VALUES ($values)";
		mysql_query($sql, $con);
		$requestid = mysql_insert_id();

	}

	if ($request_type == "Pending Installing" && $status == "__Approved") {

		$customer_id = BlockSQL(unspy($_REQUEST["customer_id"]));
		$customer_gender = BlockSQL(unspy($_REQUEST["customer_gender"]));
		$customer_name = BlockSQL(unspy($_REQUEST["customer_name"]));
		$request_type = BlockSQL('Provider Active');
		$action = BlockSQL('Activation Request');
		$status = BlockSQL('__Pending');
		$notes = BlockSQL('');
		$add_user_id = BlockSQL(unspy($_REQUEST["member_id"]));

		$columns = "`id`, `customer_id`, `request_type`, `action`, `status`, `notes`, `modified_time`,`customer_gender` , `customer_name` , `add_user_id`";
		$values = "NULL,'$customer_id','$request_type','$action','$status','$notes',NULL,'$customer_gender' , '$customer_name' , '$add_user_id'";
		$sql = "INSERT INTO $databasename.$tablename ($columns) VALUES ($values)";
		mysql_query($sql, $con);
		$requestid = mysql_insert_id();

	}

	if ($request_type == "Provider Active" && $status == "__Approved") {

		$customer_id = BlockSQL(unspy($_REQUEST["customer_id"]));
		$customer_gender = BlockSQL(unspy($_REQUEST["customer_gender"]));
		$customer_name = BlockSQL(unspy($_REQUEST["customer_name"]));
		$request_type = BlockSQL('Customer Active');
		$action = BlockSQL('Activation Request');
		$status = BlockSQL('__Pending');
		$notes = BlockSQL('');
		$add_user_id = BlockSQL(unspy($_REQUEST["member_id"]));

		$columns = "`id`, `customer_id`, `request_type`, `action`, `status`, `notes`, `modified_time`,`customer_gender` , `customer_name` , `add_user_id`";
		$values = "NULL,'$customer_id','$request_type','$action','$status','$notes',NULL,'$customer_gender' , '$customer_name' , '$add_user_id'";
		$sql = "INSERT INTO $databasename.$tablename ($columns) VALUES ($values)";
		mysql_query($sql, $con);
		$requestid = mysql_insert_id();

	}

	$outdata -> messages[] = "succeed";

}



if ($method == "add" && $object == "site.customer.reguest") {

	$tablename = "tebah_request";

	$customer_id = BlockSQL(unspy($_REQUEST["customer_id"]));
	$customer_gender = BlockSQL(unspy($_REQUEST["customer_gender"]));
	$customer_name = BlockSQL(unspy($_REQUEST["customer_name"]));
	$request_type = BlockSQL(unspy($_REQUEST["request_type"]));
	$action = BlockSQL(unspy($_REQUEST["action"]));
	$status = BlockSQL(unspy($_REQUEST["status"]));
	$notes = BlockSQL(unspy($_REQUEST["notes"]));
	$add_user_id = BlockSQL(unspy($_REQUEST["member_id"]));

	$columns = "`id`, `customer_id`, `request_type`, `action`, `status`, `notes`, `modified_time`,`customer_gender` , `customer_name` , `add_user_id`";
	$values = "NULL,'$customer_id','$request_type','$action','$status','$notes',NULL,'$customer_gender' , '$customer_name' , '$add_user_id'";
	$sql = "INSERT INTO $databasename.$tablename ($columns) VALUES ($values)";
	$outdata =  execQuery($sql);
	
	
	setCustomerRequestCountHint();
	

}




if ($method == "select.latest" && $object == "customer.request") {

	$tablename = "tebah_request_view";
	$databasename = DB_NAME;

	$values = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';
	$condition = "";
	if (!!$values) {
		$values = BlockSQL(unspy($values));

		if ($values == "UnApproved Request") {
			$condition .= " and status like 'Cancel' and  action like 'Activation Request' ";
		} else {

			$pieces = explode(" ", $values);
			foreach ($pieces as $key => $value) {
				$condition .= " and (status like '%$value%' or customer_name like '%$value%' or action like '%$value%' or request_type like '%$value%' or customer_id = '$value') ";
			}
		}
	}

	$sql = "select * from $databasename.$tablename  where 1   " . $condition . " limit 30 ;";

	$result = mysql_query($sql, $con);
	if ($result != null) {
		while ($r = mysql_fetch_assoc($result)) {
			$rows[] = $r;
		}
		$outdata -> data = $rows;
		$outdata -> count = count($rows);
	}

}

if ($method == "all" && $object == "site.request") {

	$customer_id = isset($_REQUEST['customer_id']) ? $_REQUEST['customer_id'] : '';
	if ($spy == '1') {
		$customer_id = BlockSQL(unspy($customer_id));
	}
	$tablename = "tebah_request_view";
	$databasename = DB_NAME;

	$sql = "select *   from $databasename.$tablename  where  customer_id = '$customer_id'  limit 100 ";
	$outdata = runQuery($sql);

}














?>