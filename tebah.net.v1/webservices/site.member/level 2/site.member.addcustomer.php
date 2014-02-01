<?php



	if ($method == "add customer" && $object == "site.member" && isset($_REQUEST["email"]) && isset($_REQUEST["password"]))
	{
		$memberemail = $_REQUEST["email"];
		$memberpassword = $_REQUEST["password"];
		$membername = $_REQUEST["name"];
		$membergender = $_REQUEST["gender"];
		
		$memberemail = BlockSQL(unspy($memberemail));
		$memberpassword = BlockSQL(unspy($memberpassword));
		$membername = BlockSQL(unspy($membername));
		$membergender = BlockSQL(unspy($membergender));
		
		$sql = "select id from $databasename.$tablename where email ='$memberemail' ";
		$outdata = runQuery($sql);
		if ($outdata -> count == 0)
		{
			$sql = "INSERT INTO $databasename.$tablename( `name`, `email`, `password`, `gender`, `role` , `created_ip` , `latest_ip`) VALUES ('$membername','$memberemail','$memberpassword','$membergender','Customer', '" . getuserip() . "', '" . getuserip() . "')";
			$memberid =   execQuery($sql) -> id;
			if (!!$memberid)
			{
				$service_reseller_id = $_REQUEST["service_reseller_id"];
				$service_reseller_id = BlockSQL(unspy($service_reseller_id));
				
				$sql2 = "INSERT INTO $databasename.tebah_customer( customer_name, customer_email, customer_gender, customer_member_id , accounting_reseller_id ) VALUES ('$membername','$memberemail','$membergender','$member_id' , '$service_reseller_id' )";
				$customerid =   execQuery($sql2) -> id;
				setCustomerCountHint();
			}
			$sql = "select * from $databasename.$tablename where id='$memberid'";
			$outdata = runQuery($sql);

		}
	}













?>