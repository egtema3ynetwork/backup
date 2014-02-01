<?php


if ($method == "addtoservicelookup" && $object == "site.lookup") {

	$tablename = "tebah_service_lookup";
	$databasename = DB_NAME;
	
	$region_id = isset($_REQUEST['region_id']) ? unspy($_REQUEST['region_id']) : '0';
	$central_id = isset($_REQUEST['central_id']) ? unspy($_REQUEST['central_id']) : '0';
	$provider_id = isset($_REQUEST['provider_id']) ? unspy($_REQUEST['provider_id']) : '0';
	$limit_id = isset($_REQUEST['limit_id']) ? unspy($_REQUEST['limit_id']) : '0';
	$speed_id = isset($_REQUEST['speed_id']) ? unspy($_REQUEST['speed_id']) : '0';
	$price_id = isset($_REQUEST['price_id']) ? unspy($_REQUEST['price_id']) : '0';
	

	$sql = "INSERT INTO `$databasename`.`$tablename`(`id`, `region_id`, `central_id`, `provider_id`, `limit_id`, `speed_id`, `price`) VALUES (null,'$region_id','$central_id','$provider_id','$limit_id','$speed_id','$price_id') ";
	$outdata = execQuery($sql);
	

}


if ($method == "allservicelookup" && $object == "site.lookup") {

	$tablename = "tebah_service_lookup_view";
	$databasename = DB_NAME;
	
	$sql = "select * from  `$databasename`.`$tablename` where 1 order by id desc limit 50 ";
	$outdata = runQuery($sql);
	

}

if ($method == "all" && $object == "site.offer") {

	$tablename = "tebah_offer";
	$databasename = DB_NAME;

	$sql = "select *   from $databasename.$tablename  limit 100 ";
	$outdata = runQuery($sql);
	
	$rows;
		foreach($outdata->data as $row)
		{
			$row['text']=$row['name'];
			$row['value']=$row['id'];
			$rows[]=$row;
		}
		$outdata->data=$rows;

}

if ($method == "all" && $object == "site.region") {

	$tablename = "tebah_region";
	$databasename = DB_NAME;

	$sql = "select *   from $databasename.$tablename  limit 100 ";
	$outdata = runQuery($sql);
	

}

if ($method == "all" && $object == "site.central") {

	$tablename = "tebah_central";
	$databasename = DB_NAME;

	$sql = "select *   from $databasename.$tablename  limit 100 ";
	$outdata = runQuery($sql);

}

if ($method == "all" && $object == "site.provider") {

	$tablename = "tebah_provider";
	$databasename = DB_NAME;

	$sql = "select *   from $databasename.$tablename  limit 100 ";
	$outdata = runQuery($sql);

}

if ($method == "all" && $object == "site.limit") {

	$tablename = "tebah_limit";
	$databasename = DB_NAME;

	$sql = "select *   from $databasename.$tablename  limit 100 ";
	$outdata = runQuery($sql);

}

if ($method == "all" && $object == "site.speed") {

	$tablename = "tebah_speed";
	$databasename = DB_NAME;

	$sql = "select *   from $databasename.$tablename  limit 100 ";
	$outdata = runQuery($sql);

}



if ($method == "all" && $object == "site.ip_count") {

	$tablename = "tebah_ip_count";
	$databasename = DB_NAME;

	$sql = "select *   from $databasename.$tablename  limit 100 ";
	$outdata = runQuery($sql);

}




if ($method == "all" && $object == "site.payment_type") {

	$tablename = "tebah_payment_type";
	$databasename = DB_NAME;

	$sql = "select *   from $databasename.$tablename  limit 100 ";
	$outdata = runQuery($sql);

}


if ($method == "all" && $object == "site.offer") {

	$tablename = "tebah_offer";
	$databasename = DB_NAME;

	$sql = "select *   from $databasename.$tablename  limit 100 ";
	$outdata = runQuery($sql);

}

if ($method == "all" && $object == "site.branch") {

	$tablename = "tebah_branch";
	$databasename = DB_NAME;

	$sql = "select *   from $databasename.$tablename  limit 100 ";
	$outdata = runQuery($sql);

}





?>