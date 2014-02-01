<?php

	if ($method == "new.request" && $object == "service.order")
	{
		$tablename = "tebah_orders";
		$databasename = DB_NAME;

		$email = BlockSQL(unspy($_REQUEST["email"]));
		$name = BlockSQL(unspy($_REQUEST["name"]));
		$phone_code = BlockSQL(unspy($_REQUEST["phone_code"]));
		$phone = BlockSQL(unspy($_REQUEST["phone"]));
		$mobile = BlockSQL(unspy($_REQUEST["mobile"]));
		$service_provider = BlockSQL(unspy($_REQUEST["service_provider"]));
		$speed = BlockSQL(unspy($_REQUEST["speed"]));
		$address = BlockSQL(unspy($_REQUEST["address"]));

		$columns = "`id`, `email`, `name`, `phone_code`, `phone`, `mobile`, `service_provider`,`speed` , `address` ";
		$values = "NULL,'$email','$name','$phone_code','$phone','$mobile','$service_provider','$speed' , '$address' ";
		$sql = "INSERT INTO $databasename.$tablename ($columns) VALUES ($values)";
		$outdata = execQuery($sql);

	}
?>
