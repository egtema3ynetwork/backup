<?php


if ($method == "update" && $object == "site.member" && isset($_REQUEST["email"]) && isset($_REQUEST["password"]))
	{
		$member_id = $_REQUEST["id"];
		$memberemail = $_REQUEST["email"];
		$memberpassword = $_REQUEST["password"];
		$membername = $_REQUEST["name"];
		$membergender = $_REQUEST["gender"];
		$memberrole = $_REQUEST["role"];
		$membermember = $_REQUEST["member"];
		$memberfaceid = $_REQUEST["faceid"];
		$member_id = BlockSQL(unspy($member_id));
		$memberemail = BlockSQL(unspy($memberemail));
		$memberpassword = BlockSQL(unspy($memberpassword));
		$membername = BlockSQL(unspy($membername));
		$membergender = BlockSQL(unspy($membergender));
		$memberrole = BlockSQL(unspy($memberrole));
		$membermember = BlockSQL(unspy($membermember));
		$memberfaceid = BlockSQL(unspy($memberfaceid));
		$sql = "UPDATE $databasename.$tablename SET `name` =  '$membername' , `email` = '$memberemail' , `password` = '$memberpassword' , `gender` = '$membergender' , `role` = '$memberrole', `member` = '$membermember' , `faceid` ='$memberfaceid'  where id='$member_id'";
		$result = execQuery($sql);
		if ($memberrole == "Customer")
		{
			$sql = "select * from $databasename.tebah_customer where customer_email='$memberemail'";
			$outdata = runQuery($sql);
			if ($outdata -> count == 0)
			{
				$sql2 = "INSERT INTO $databasename.tebah_customer( customer_name, customer_email, customer_gender, customer_member_id) VALUES ('$membername','$memberemail','$membergender','$member_id')";
				$customerid =    execQuery($sql2) -> id;
				setCustomerCountHint();
			}
		}
	}










?>