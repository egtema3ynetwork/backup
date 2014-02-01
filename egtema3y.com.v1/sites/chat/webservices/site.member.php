<?php

require 'core.php';

$outdata;
$outdata -> data = array();
$outdata -> errors = array();

$object = isset($_REQUEST['object']) ? $_REQUEST['object'] : 'site.member';
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : 'select';
$spy = isset($_REQUEST['spy']) ? $_REQUEST['spy'] : '1';

$tablename = "chat_member";
$databasename = "chat";

if ($method == "select" && $object == "site.member") {

	if (isset($_REQUEST['email']) && isset($_REQUEST['password'])) {
		$memberemail = $_REQUEST['email'];
		$memberpassword = $_REQUEST['password'];

		if ($spy == "1") {
			$memberemail = BlockSQL(unspy($memberemail));
			$memberpassword = BlockSQL(unspy($memberpassword));
		} else {
			$memberemail = BlockSQL($memberemail);
			$memberpassword = BlockSQL($memberpassword);
		}

		$sql = "UPDATE $databasename.$tablename SET `time`=CURRENT_TIMESTAMP , `latest_ip` = '" . getuserip() . "' where email='$memberemail' and password='$memberpassword'";
		mysql_query($sql, $con);
		$sql = "select *,TIMESTAMPDIFF(SECOND,time,CURRENT_TIMESTAMP()) as timeago from $databasename.$tablename where email='$memberemail' and password='$memberpassword'";
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
				$row -> password = "***";
			}
		}
	}
	$accesstoken = isset($_REQUEST['accesstoken']) ? $_REQUEST['accesstoken'] : '';
	if ($accesstoken != "") {

		$sql = "UPDATE $databasename.$tablename SET `latest_ip` = '" . getuserip() . "' where accesstoken = '$accesstoken' ";
	mysql_query($sql, $con);
		$sql = "select * from $databasename.$tablename  where accesstoken = '$accesstoken'";
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
				$row -> password = "***";
			}
		}
	}

}

if ($method == "all" && $object == "site.member") {

	$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';
	$condition = "";
	if (!!$value) {
		$value = unspy($value);
		$condition = " and (name like '%$value%' or email like '%$value%' or role like '%$value%' or gender like '$value' or id like '$value'  ) ";
	}

	$sql = "select *,TIMESTAMPDIFF(SECOND,time,CURRENT_TIMESTAMP()) as timeago from $databasename.$tablename where 1 " . $condition . " order by time desc limit 100 ";
 $outdata->sql = $sql;
$rows = array();
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
			//$row->member_password = "***";
		}
	}
}

if ($method == "selectone" && $object == "site.member") {

	$value = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	$condition = "";
	if (!!$value) {
		$value = unspy($value);
		$condition = " and  id = $value  ";
	}

	$sql = "select * from $databasename.$tablename where 1 " . $condition . " limit 30";

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
			//$row->member_password = "***";
		}
	}
}

if ($method == "add" && $object == "site.member" && isset($_REQUEST["email"]) && isset($_REQUEST["password"])) {

	$memberemail = $_REQUEST["email"];
	$memberpassword = $_REQUEST["password"];
	$membername = $_REQUEST["name"];
	$membergender = $_REQUEST["gender"];

	$memberemail = BlockSQL(unspy($memberemail));
	$memberpassword = BlockSQL(unspy($memberpassword));
	$membername = BlockSQL(unspy($membername));
	$membergender = BlockSQL(unspy($membergender));

	if (count( runQuery("select id from $databasename.$tablename where email ='$memberemail' ") -> data) == 0) {

		$sql = "INSERT INTO $databasename.$tablename( `name`, `email`, `password`, `gender`, `role` , `created_ip` , `latest_ip`) VALUES ('$membername','$memberemail','$memberpassword','$membergender','Member', '" . getuserip() . "', '" . getuserip() . "')";
		mysql_query($sql);
		$memberid = mysql_insert_id();

		$sql = "select * from $databasename.$tablename where id='$memberid'";
		 $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
	}
}


if ($method == "add customer" && $object == "site.member" && isset($_REQUEST["email"]) && isset($_REQUEST["password"])) {

	$memberemail = $_REQUEST["email"];
	$memberpassword = $_REQUEST["password"];
	$membername = $_REQUEST["name"];
	$membergender = $_REQUEST["gender"];

	$memberemail = BlockSQL(unspy($memberemail));
	$memberpassword = BlockSQL(unspy($memberpassword));
	$membername = BlockSQL(unspy($membername));
	$membergender = BlockSQL(unspy($membergender));


$result = mysql_query("select id from $databasename.$tablename where email ='$memberemail' ", $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
        
        
	if ($outdata->count == 0) {

		$sql = "INSERT INTO $databasename.$tablename( `name`, `email`, `password`, `gender`, `role` , `created_ip` , `latest_ip`) VALUES ('$membername','$memberemail','$memberpassword','$membergender','Customer', '" . getuserip() . "', '" . getuserip() . "')";
		mysql_query($sql);
		$memberid = mysql_insert_id();

	if (!!$memberid) {
		
    $sql2 = "INSERT INTO $databasename.tebah_customer( customer_name, customer_email, customer_gender, customer_member_id) VALUES ('$membername','$memberemail','$membergender','$member_id')";
		mysql_query($sql2, $con);
		$customerid = mysql_insert_id();
    
	}
  
		$sql = "select * from $databasename.$tablename where id='$memberid'";
		 $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
	}
}



if ($method == "add user" && $object == "site.member" && isset($_REQUEST["email"]) && isset($_REQUEST["password"])) {

	$memberemail = $_REQUEST["email"];
	$memberpassword = $_REQUEST["password"];
	$membername = $_REQUEST["name"];
	$membergender = $_REQUEST["gender"];
$memberrole = $_REQUEST["role"];


	$memberemail = BlockSQL(unspy($memberemail));
	$memberpassword = BlockSQL(unspy($memberpassword));
	$membername = BlockSQL(unspy($membername));
	$membergender = BlockSQL(unspy($membergender));
  $memberrole = BlockSQL(unspy($memberrole));


$result = mysql_query("select id from $databasename.$tablename where email ='$memberemail' ", $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
        
        
	if ($outdata->count == 0) {

		$sql = "INSERT INTO $databasename.$tablename( `name`, `email`, `password`, `gender`, `role` , `created_ip` , `latest_ip`) VALUES ('$membername','$memberemail','$memberpassword','$membergender','$memberrole', '" . getuserip() . "', '" . getuserip() . "')";
		mysql_query($sql);
		$memberid = mysql_insert_id();
  
		$sql = "select * from $databasename.$tablename where id='$memberid'";
		 $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
	}
}




if ($method == "update" && $object == "site.member" && isset($_REQUEST["email"]) && isset($_REQUEST["password"])) {

	$member_id = $_REQUEST["id"];
	$memberemail = $_REQUEST["email"];
	$memberpassword = $_REQUEST["password"];
	$membername = $_REQUEST["name"];
	$membergender = $_REQUEST["gender"];
	$memberrole = $_REQUEST["role"];
	$membermember = $_REQUEST["member"];

	$member_id = BlockSQL(unspy($member_id));
	$memberemail = BlockSQL(unspy($memberemail));
	$memberpassword = BlockSQL(unspy($memberpassword));
	$membername = BlockSQL(unspy($membername));
	$membergender = BlockSQL(unspy($membergender));
	$memberrole = BlockSQL(unspy($memberrole));
	$membermember = BlockSQL(unspy($membermember));

	$sql = "UPDATE $databasename.$tablename SET `name` =  '$membername' , `email` = '$memberemail' , `password` = '$memberpassword' , `gender` = '$membergender' , `role` = '$memberrole', `member` = '$membermember'  where id='$member_id'";
	 $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }

	if ($memberrole == "Customer") {
		
    $sql = "select * from $databasename.tebah_customer where customer_email='$memberemail'";
		
     $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
        if($outdata->count == 0)
        {
   $sql2 = "INSERT INTO $databasename.tebah_customer( customer_name, customer_email, customer_gender, customer_member_id) VALUES ('$membername','$memberemail','$membergender','$member_id')";
		mysql_query($sql2, $con);
		$customerid = mysql_insert_id();
    }
	}
}

if ($method == "delete" && $object == "site.member") {

	$member_id = $_REQUEST["id"];
	$member_id = BlockSQL(unspy($member_id));

	$sql = "delete from $databasename.$tablename where id=" . $member_id;
	$outdata = runQuery($sql);
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($outdata);
?>
