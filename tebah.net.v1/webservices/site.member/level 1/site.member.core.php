<?php
	$outdata;
	$outdata -> data = array();
	$outdata -> errors = array();
	$rows = array();
	$object = isset($_REQUEST['object']) ? $_REQUEST['object'] : 'site.member';
	$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : 'select';
	$spy = isset($_REQUEST['spy']) ? $_REQUEST['spy'] : '1';
	$tablename = "site_member";
	$databasename = "tebah";
	if ($method == "select" && $object == "site.member")
	{
		if (isset($_REQUEST['email']) && isset($_REQUEST['password']))
		{
			$memberemail = $_REQUEST['email'];
			$memberpassword = $_REQUEST['password'];
			if ($spy == "1")
			{
				$memberemail = BlockSQL(unspy($memberemail));
				$memberpassword = BlockSQL(unspy($memberpassword));
			}
			else
			{
				$memberemail = BlockSQL($memberemail);
				$memberpassword = BlockSQL($memberpassword);
			}
			$sql = "UPDATE $databasename.$tablename SET `time`=CURRENT_TIMESTAMP , `latest_ip` = '" . getuserip() . "' where email='$memberemail' and password='$memberpassword'";
			execQuery($sql);
			$sql = "select *,TIMESTAMPDIFF(SECOND,time,CURRENT_TIMESTAMP()) as timeago from $databasename.$tablename where (email='$memberemail' or email='$memberemail') and password='$memberpassword'";
			$outdata = runQuery($sql);
			if ($spy == "1")
			{
				$rows;
				foreach ($outdata->data as $row)
				{
					//$row['password']="***";
					$rows[] = $row;
				}
				$outdata -> data = $rows;
			}
		}
		$accesstoken = isset($_REQUEST['accesstoken']) ? $_REQUEST['accesstoken'] : '';
		if ($accesstoken != "")
		{
			$sql = "UPDATE $databasename.$tablename SET `latest_ip` = '" . getuserip() . "' where accesstoken = '$accesstoken' ";
			execQuery($sql);
			$sql = "select * from $databasename.$tablename  where accesstoken = '$accesstoken'";
			$outdata = runQuery($sql);
			if ($spy == "1")
			{
				$rows;
				foreach ($outdata->data as $row)
				{
					//$row['password']="***";
					$rows[] = $row;
				}
				$outdata -> data = $rows;
			}
		}
	}
	if ($method == "all" && $object == "site.member")
	{
		$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';
		$condition = "";
		if (!!$value)
		{
			$value = unspy($value);
			$condition = " and (name like '%$value%' or email like '%$value%' or role like '%$value%' or gender like '$value' or id like '$value'  ) ";
		}
		$sql = "select *,TIMESTAMPDIFF(SECOND,time,CURRENT_TIMESTAMP()) as timeago from $databasename.$tablename where 1 " . $condition . " order by time desc limit 100 ";
		$outdata = runQuery($sql);
	}
	if ($method == "all" && $object == "site.reseller")
	{
		$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';
		$condition = "";
		if (!!$value)
		{
			$value = unspy($value);
			$condition = "  and (name like '%$value%' or email like '%$value%' or role like '%$value%' or gender like '$value' or id like '$value'  ) ";
		}
		$sql = "select *,TIMESTAMPDIFF(SECOND,time,CURRENT_TIMESTAMP()) as timeago from $databasename.$tablename where 1 and role='Reseller' " . $condition . " order by time desc limit 100 ";
		$outdata = runQuery($sql);
		$rows = array();
		foreach ($outdata->data as $row)
		{
			//$row['password']="***";
			$row['text'] = $row['name'];
			$row['value'] = $row['id'];
			$rows[] = $row;
		}
		$outdata -> data = $rows;
	}
	if ($method == "all" && $object == "site.isp")
	{
		$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';
		$condition = "";
		if (!!$value)
		{
			$value = unspy($value);
			$condition = "  and (name like '%$value%' or email like '%$value%' or role like '%$value%' or gender like '$value' or id like '$value'  ) ";
		}
		$sql = "select *,TIMESTAMPDIFF(SECOND,time,CURRENT_TIMESTAMP()) as timeago from $databasename.$tablename where 1 and role='ISP' " . $condition . " order by time desc limit 100 ";
		$outdata = runQuery($sql);
		$rows = array();
		foreach ($outdata->data as $row)
		{
			//$row['password']="***";
			$row['text'] = $row['name'];
			$row['value'] = $row['id'];
			$rows[] = $row;
		}
		$outdata -> data = $rows;
	}
	if ($method == "selectone" && $object == "site.member")
	{
		$value = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
		$condition = "";
		if (!!$value)
		{
			$value = unspy($value);
			$condition = " and  id = $value  ";
		}
		$sql = "select * from $databasename.$tablename where 1 " . $condition . " limit 30";
		$outdata = runQuery($sql);
		$rows = array();
		foreach ($outdata->data as $row)
		{
			//$row['password']="***";
			$row['text'] = $row['name'];
			$row['value'] = $row['id'];
			$rows[] = $row;
		}
		$outdata -> data = $rows;
	}
	if ($method == "add" && $object == "site.member" && isset($_REQUEST["email"]) && isset($_REQUEST["password"]))
	{
		$memberemail = $_REQUEST["email"];
		$memberpassword = $_REQUEST["password"];
		$membername = $_REQUEST["name"];
		$membergender = $_REQUEST["gender"];
		$memberemail = BlockSQL(unspy($memberemail));
		$memberpassword = BlockSQL(unspy($memberpassword));
		$membername = BlockSQL(unspy($membername));
		$membergender = BlockSQL(unspy($membergender));
		if (runQuery("select id from $databasename.$tablename where email ='$memberemail' ") -> count == 0)
		{
			$sql = "INSERT INTO $databasename.$tablename( `name`, `email`, `password`, `gender`, `role` , `created_ip` , `latest_ip`) VALUES ('$membername','$memberemail','$memberpassword','$membergender','Member', '" . getuserip() . "', '" . getuserip() . "')";
			$memberid =    execQuery($sql) -> id;
			$sql = "select * from $databasename.$tablename where id ='$memberid' ";
			$outdata = runQuery($sql);
			sendEmail("system@tebah.net", "absunstar@gmail.com", "New User : $membername", "$memberemail \n $membername \n $membergender");

		}
	}

	if ($method == "add user" && $object == "site.member" && isset($_REQUEST["email"]) && isset($_REQUEST["password"]))
	{
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
		$sql = "select id from $databasename.$tablename where email ='$memberemail' ";
		$outdata = runQuery($sql);
		if ($outdata -> count == 0)
		{
			$sql = "INSERT INTO $databasename.$tablename( `name`, `email`, `password`, `gender`, `role` , `created_ip` , `latest_ip`) VALUES ('$membername','$memberemail','$memberpassword','$membergender','$memberrole', '" . getuserip() . "', '" . getuserip() . "')";
			$memberid =   execQuery($sql) -> id;
			$sql = "select * from $databasename.$tablename where id='$memberid'";
			$outdata = runQuery($sql);
		}
		
	}
	
	if ($method == "delete" && $object == "site.member")
	{
		$member_id = $_REQUEST["id"];
		$member_id = BlockSQL(unspy($member_id));
		$sql = "delete from $databasename.$tablename where id=" . $member_id;
		$outdata = execQuery($sql);
	}
?>