<?php

require 'core.php';

$outdata;
$outdata -> data = array();
$outdata -> errors = array();
$outdata -> messages = array();

$object = isset($_REQUEST['object']) ? $_REQUEST['object'] : 'site.customer';
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : 'select';
$spy = isset($_REQUEST['spy']) ? $_REQUEST['spy'] : '1';

$tablename = "tebah_customer";
$databasename = DB_NAME;

if ($method == "select" && $object == "site.customer" && isset($_REQUEST["id"])) {

	$customeremail = $_REQUEST["email"];
	$customerpassword = $_REQUEST["password"];

	if ($spy == "1") {
		$customeremail = BlockSQL(unspy($customeremail));
		$customerpassword = BlockSQL(unspy($customerpassword));
	} else {
		$customeremail = BlockSQL($customeremail);
		$customerpassword = BlockSQL($customerpassword);
	}

	$tablename = "tebah_customer";
	$databasename = DB_NAME;

	$sql = "select * from $databasename.$tablename where customer_email='$customeremail' and customer_password='$customerpassword'";
	mysql_query("UPDATE $databasename.$tablename SET customer_latest_ip = '" . getuserip() . "' where customer_email='$customeremail' and customer_password='$customerpassword'", $con);
	
   $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
        
	if ($spy == "1") {
		foreach ($outdata->data as $row) {
			$row -> customer_password = "***";
		}
	}
}

if ($method == "all" && $object == "site.customer") {

	$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';
	$condition = "";
	if (!!$value) {

		$condition = " and customer_id like '$value' or customer_name like '%$value%' or customer_email like '%$value%' or customer_phone like '%$value%' or customer_national_id like '%$value%' or customer_city like '%$value%' or customer_gender like '$value'";
	}

	$tablename = "tebah_customer";
	$databasename = DB_NAME;

	$sql = "select * from $databasename.$tablename where 1 " . $condition."  order by contact_date desc limit 100 ";

	 $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
        
	if ($spy == "1") {
		foreach ($outdata->data as $row) {
			//$row->customer_password = "***";
		}
	}
}


if ($method == "all" && $object == "site.request") {

	$customer_id = isset($_REQUEST['customer_id']) ? $_REQUEST['customer_id'] : '';
  $customer_id = BlockSQL(unspy($customer_id));
	$tablename = "tebah_request";
	$databasename = DB_NAME;

	$sql = "select * from $databasename.$tablename where customer_id = '$customer_id'  limit 100 ";

	 $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
        
	
}


if ($method == "select.latest" && $object == "customer.request") {

	$values = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';
	$condition = "";
	if (!!$values) {
		$values = BlockSQL(unspy($values));

		if ($values == "UnApproved Request") {
$condition .= " and status like 'Cancel'  action like 'Activation Request' ";
		} else {

			$pieces = explode(" ", $values);
			foreach ($pieces as $key => $value) {
				$condition .= " and (status like '%$value%' or customer_name like '%$value%' or action like '%$value%' or request_type like '%$value%' or customer_id = '$value') ";
			}
		}
	}

	$tablename = "tebah_request";
	$databasename = DB_NAME;

	$sql = "select * from $databasename.$tablename where 1 " . $condition . " limit 30 ;";

	 $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
        

}

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

	mysql_query($sql,$con);

if($request_type == "Pending TE" && $status == "__Approved")
{


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
	mysql_query($sql,$con);
	$requestid = mysql_insert_id();
  
}

if($request_type == "Pending WO" && $status == "__Approved")
{


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
	mysql_query($sql,$con);
	$requestid = mysql_insert_id();
  
}

if($request_type == "Pending Splitting" && $status == "__Approved")
{


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
	mysql_query($sql,$con);
	$requestid = mysql_insert_id();
  
}

if($request_type == "Pending Installing" && $status == "__Approved")
{


  $customer_id = BlockSQL(unspy($_REQUEST["customer_id"]));
	$customer_gender = BlockSQL(unspy($_REQUEST["customer_gender"]));
	$customer_name = BlockSQL(unspy($_REQUEST["customer_name"]));
	$request_type = BlockSQL('Active');
	$action = BlockSQL('Activation Request');
	$status = BlockSQL('__Pending');
	$notes = BlockSQL('');
  $add_user_id = BlockSQL(unspy($_REQUEST["member_id"]));

	$columns = "`id`, `customer_id`, `request_type`, `action`, `status`, `notes`, `modified_time`,`customer_gender` , `customer_name` , `add_user_id`";
	$values = "NULL,'$customer_id','$request_type','$action','$status','$notes',NULL,'$customer_gender' , '$customer_name' , '$add_user_id'";
	$sql = "INSERT INTO $databasename.$tablename ($columns) VALUES ($values)";
	mysql_query($sql,$con);
	$requestid = mysql_insert_id();
  
}


if($request_type == "Active" && $status == "__Approved")
{


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
	mysql_query($sql,$con);
	$requestid = mysql_insert_id();
  
}

	$outdata -> messages[] = "succeed";

}

if ($method == "add" && $object == "site.customer") {

	$customeremail = $_REQUEST["email"];
	$customername = $_REQUEST["name"];
	$customergender = $_REQUEST["gender"];
	$customermemberid = $_REQUEST["member_id"];

	$customeremail = BlockSQL(unspy($customeremail));
	$customername = BlockSQL(unspy($customername));
	$customergender = BlockSQL(unspy($customergender));
	$customermemberid = BlockSQL(unspy($customermemberid));

	$sql = "select * from $databasename.$tablename where customer_member_id='$customermemberid'";
	 $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
        

	if (count($outdata -> data) > 0) {

	} else {
		$sql2 = "INSERT INTO $databasename.$tablename( customer_name, customer_email, customer_gender, customer_member_id) VALUES ('$customername','$customeremail','$customergender','$customermemberid')";
		mysql_query($sql2);
		$customerid = mysql_insert_id();

		$sql = "select * from $databasename.$tablename where customer_id='$customerid'";
		
     $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
        
        
		$outdata -> sql2 = $sql2;
	}

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
	mysql_query($sql);
	$requestid = mysql_insert_id();
	if (!!$requestid) {
		$outdata -> messages[] = "succeed";
    
    
    
	} else {
		$outdata -> messages[] = "error";
	}

}

if ($method == "update" && $object == "site.customer") {

	$customer_id = BlockSQL(unspy($_REQUEST["customer_id"]));
	$customer_name = BlockSQL(unspy($_REQUEST["customer_name"]));
  $customer_member_id = BlockSQL(unspy($_REQUEST["customer_member_id"]));
	$customer_email = BlockSQL(unspy($_REQUEST["customer_email"]));
	$customer_gender = BlockSQL(unspy($_REQUEST["customer_gender"]));
	$customer_phone = BlockSQL(unspy($_REQUEST["customer_phone"]));
	$customer_mobile1 = BlockSQL(unspy($_REQUEST["customer_mobile1"]));
	$customer_mobile2 = BlockSQL(unspy($_REQUEST["customer_mobile2"]));
	$customer_national_id = BlockSQL(unspy($_REQUEST["customer_national_id"]));
	$customer_city = BlockSQL(unspy($_REQUEST["customer_city"]));
	$contact_branch = BlockSQL(unspy($_REQUEST["contact_branch"]));
	$contact_service_provider = BlockSQL(unspy($_REQUEST["contact_service_provider"]));
	$contact_line_speed = BlockSQL(unspy($_REQUEST["contact_line_speed"]));
	$contact_ip_count = BlockSQL(unspy($_REQUEST["contact_ip_count"]));
	$offer_type = BlockSQL(unspy($_REQUEST["offer_type"]));
	$offer_free_product = BlockSQL(unspy($_REQUEST["offer_free_product"]));
	$contact_payment_type = BlockSQL(unspy($_REQUEST["contact_payment_type"]));
	$customer_address = BlockSQL(unspy($_REQUEST["customer_address"]));
	$customer_notes = BlockSQL(unspy($_REQUEST["customer_notes"]));
	$line_username = BlockSQL(unspy($_REQUEST["line_username"]));
	$line_password = BlockSQL(unspy($_REQUEST["line_password"]));
	$router_username = BlockSQL(unspy($_REQUEST["router_username"]));
	$router_password = BlockSQL(unspy($_REQUEST["router_password"]));
	$router_wireless = BlockSQL(unspy($_REQUEST["router_wireless"]));
	$contact_date = BlockSQL(unspy($_REQUEST["contact_date"]));
	$contact_payback_cost = BlockSQL(unspy($_REQUEST["contact_payback_cost"]));
	$contact_service_cost = BlockSQL(unspy($_REQUEST["contact_service_cost"]));
	$contact_router_cost = BlockSQL(unspy($_REQUEST["contact_router_cost"]));
	$router_serial = BlockSQL(unspy($_REQUEST["router_serial"]));
	$flasha_serial = BlockSQL(unspy($_REQUEST["flasha_serial"]));
	$contact_pay = BlockSQL(unspy($_REQUEST["contact_pay"]));
	$contact_notpay = BlockSQL(unspy($_REQUEST["contact_notpay"]));
	$contact_approved = BlockSQL(unspy($_REQUEST["contact_approved"]));
	$contact_pay_day = BlockSQL(unspy($_REQUEST["contact_pay_day"]));
	$contact_month_cost = BlockSQL(unspy($_REQUEST["contact_month_cost"]));
	$contact_free_day = BlockSQL(unspy($_REQUEST["contact_free_day"]));
	$contact_warn_day = BlockSQL(unspy($_REQUEST["contact_warn_day"]));
	$offer_month_count = BlockSQL(unspy($_REQUEST["offer_month_count"]));
	$offer_month_discount = BlockSQL(unspy($_REQUEST["offer_month_discount"]));
	$offer_first_invoice = BlockSQL(unspy($_REQUEST["offer_first_invoice"]));

	$sql = "UPDATE $databasename.$tablename SET ";
	$sql .= " customer_name =  '$customer_name' ";
	$sql .= " , customer_email =  '$customer_email' ";
	$sql .= " , customer_gender =  '$customer_gender' ";
	$sql .= " , customer_phone =  '$customer_phone' ";
	$sql .= " , customer_mobile1 =  '$customer_mobile1' ";
	$sql .= " , customer_mobile2 =  '$customer_mobile2' ";
	$sql .= " , customer_national_id =  '$customer_national_id' ";
	$sql .= " , customer_city =  '$customer_city' ";
	$sql .= " , contact_branch =  '$contact_branch' ";
	$sql .= " , contact_service_provider =  '$contact_service_provider' ";
	$sql .= " , contact_line_speed =  '$contact_line_speed' ";
	$sql .= " , contact_ip_count =  '$contact_ip_count' ";
	$sql .= " , offer_type =  '$offer_type' ";
	$sql .= " , offer_free_product =  '$offer_free_product' ";
	$sql .= " , contact_payment_type =  '$contact_payment_type' ";
	$sql .= " , customer_address =  '$customer_address' ";
	$sql .= " , customer_notes =  '$customer_notes' ";
	$sql .= " , line_username =  '$line_username' ";
	$sql .= " , line_password =  '$line_password' ";
	$sql .= " , router_username =  '$router_username' ";
	$sql .= " , router_password =  '$router_password' ";
	$sql .= " , router_wireless =  '$router_wireless' ";

	$sql .= " , contact_payback_cost =  '$contact_payback_cost' ";
	$sql .= " , contact_service_cost =  '$contact_service_cost' ";
	$sql .= " , contact_router_cost =  '$contact_router_cost' ";
	$sql .= " , router_serial =  '$router_serial' ";
	$sql .= " , flasha_serial =  '$flasha_serial' ";
	$sql .= " , contact_pay =  '$contact_pay' ";
	$sql .= " , contact_notpay =  '$contact_notpay' ";
	$sql .= " , contact_approved =  '$contact_approved' ";
	$sql .= " , contact_pay_day =  '$contact_pay_day' ";
	$sql .= " , contact_month_cost =  '$contact_month_cost' ";
	$sql .= " , contact_free_day =  '$contact_free_day' ";
	$sql .= " , contact_warn_day =  '$contact_warn_day' ";
	$sql .= " , offer_month_count =  '$offer_month_count' ";
	$sql .= " , offer_month_discount =  '$offer_month_discount' ";
	$sql .= " , offer_first_invoice =  '$offer_first_invoice' ";

	$sql .= " where customer_id='$customer_id' ";
	
  $oldApproved = "__Pending" ;
  	$sql2 = "select  contact_approved from $databasename.$tablename where customer_id='$customer_id' ";
  $result2 = mysql_query($sql2, $con);
        if ($result2 != null) {
            while ($r = mysql_fetch_assoc($result2)) {
                $oldApproved = $r['contact_approved'];
            }
}

        
   $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
        
        
        
if($contact_approved == "__Approved" && $oldApproved != "__Approved")
{

	$request_type = BlockSQL('Pending TE');
	$action = BlockSQL('Activation Request');
	$status = BlockSQL('__Pending');
	$notes = BlockSQL('');
  $add_user_id = $customer_member_id;

	$columns = "`id`, `customer_id`, `request_type`, `action`, `status`, `notes`, `modified_time`,`customer_gender` , `customer_name` , `add_user_id`";
	$values = "NULL,'$customer_id','$request_type','$action','$status','$notes',NULL,'$customer_gender' , '$customer_name' , '$add_user_id'";
	$sql = "INSERT INTO $databasename.tebah_request ($columns) VALUES ($values)";
	mysql_query($sql,$con);
	$requestid = mysql_insert_id();
  
}
        
}

if ($method == "delete" && $object == "site.customer") {

	$customer_id = $_REQUEST["customer_id"];
	$customer_id = BlockSQL(unspy($customer_id));

	$tablename = "tebah_customer";
	$databasename = DB_NAME;

	$sql = "delete from $databasename.$tablename where customer_id=" . $customer_id;
	
   $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
        
        
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($outdata);
?>
