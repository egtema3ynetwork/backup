<?php

	if ($method == "all" && $object == "site.customer")
	{

		$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';
		$condition = "";
		if (!!$value)
		{

			$condition .= " and (customer_id like '$value' or customer_name like '%$value%' or customer_email like '%$value%' or customer_phone like '%$value%' or customer_national_id like '%$value%'  or customer_gender like '$value') ";
		}

		$resellerid = isset($_REQUEST['resellerid']) ? $_REQUEST['resellerid'] : '';
		if (!!$resellerid)
		{

			$condition .= " and service_reseller_id like '$resellerid' ";
		}

		$tablename = "tebah_customer";
		$databasename = DB_NAME;

		$sql = "select * from $databasename.$tablename where 1 " . $condition . "   limit 100 ";

		$outdata = runQuery($sql);

	}

	if ($method == "select" && $object == "site.customer" && isset($_REQUEST["id"]))
	{

		$customeremail = $_REQUEST["email"];
		$customerpassword = $_REQUEST["password"];

		if ($spy == "1")
		{
			$customeremail = BlockSQL(unspy($customeremail));
			$customerpassword = BlockSQL(unspy($customerpassword));
		}
		else
		{
			$customeremail = BlockSQL($customeremail);
			$customerpassword = BlockSQL($customerpassword);
		}

		$tablename = "tebah_customer";
		$databasename = DB_NAME;

		$sql = "select * from $databasename.$tablename where customer_email='$customeremail' and customer_password='$customerpassword'";
		mysql_query("UPDATE $databasename.$tablename SET customer_latest_ip = '" . getuserip() . "' where customer_email='$customeremail' and customer_password='$customerpassword'", $con);

		$result = mysql_query($sql, $con);
		if ($result != null)
		{
			while ($r = mysql_fetch_assoc($result))
			{
				$rows[] = $r;
			}
			$outdata -> data = $rows;
			$outdata -> count = count($rows);
		}

		if ($spy == "1")
		{
			foreach ($outdata->data as $row)
			{
				$row -> customer_password = "***";
			}
		}
	}

	if ($method == "delete" && $object == "site.customer")
	{

		$customer_id = $_REQUEST["customer_id"];
		$customer_id = BlockSQL(unspy($customer_id));

		$tablename = "tebah_customer";
		$databasename = DB_NAME;

		$sql = "delete from $databasename.$tablename where customer_id=" . $customer_id;

		$result = mysql_query($sql, $con);
		if ($result != null)
		{
			while ($r = mysql_fetch_assoc($result))
			{
				$rows[] = $r;
			}
			$outdata -> data = $rows;
			$outdata -> count = count($rows);
		}

		setCustomerCountHint();

	}

	if ($method == "add" && $object == "site.customer")
	{

		$customeremail = $_REQUEST["email"];
		$customername = $_REQUEST["name"];
		$customergender = $_REQUEST["gender"];
		$customermemberid = $_REQUEST["member_id"];
		$contact_reseller_id = $_REQUEST["contact_reseller_id"];
		$contact_reseller_name = $_REQUEST["contact_reseller_name"];

		$customeremail = BlockSQL(unspy($customeremail));
		$customername = BlockSQL(unspy($customername));
		$customergender = BlockSQL(unspy($customergender));
		$customermemberid = BlockSQL(unspy($customermemberid));
		$contact_reseller_id = BlockSQL(unspy($contact_reseller_id));
		$contact_reseller_name = BlockSQL(unspy($contact_reseller_name));

		$sql = "select * from $databasename.$tablename where customer_member_id='$customermemberid'";
		$result = mysql_query($sql, $con);
		if ($result != null)
		{
			while ($r = mysql_fetch_assoc($result))
			{
				$rows[] = $r;
			}
			$outdata -> data = $rows;
			$outdata -> count = count($rows);
		}

		if (count($outdata -> data) > 0)
		{

		}
		else
		{
			$sql2 = "INSERT INTO $databasename.$tablename( customer_name, customer_email, customer_gender, customer_member_id , contact_reseller_id , contact_reseller_name ) VALUES ('$customername','$customeremail','$customergender','$customermemberid' ,'$contact_reseller_id' , '$contact_reseller_name' )";
			mysql_query($sql2);
			$customerid = mysql_insert_id();
			setCustomerCountHint();
			$sql = "select * from $databasename.$tablename where customer_id='$customerid'";

			$result = mysql_query($sql, $con);
			if ($result != null)
			{
				while ($r = mysql_fetch_assoc($result))
				{
					$rows[] = $r;
				}
				$outdata -> data = $rows;
				$outdata -> count = count($rows);
			}

			$outdata -> sql2 = $sql2;
		}

	}
?>