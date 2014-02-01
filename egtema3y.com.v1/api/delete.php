<?php
	include("../content/start.php"); 
	include("../global/setting.php");



	
	try {

		$responseobject->serviceurl = "api/delete.php";

		
		if($object == "facebookuser")
		{
			$wallid = isset($_GET['wallid']) ? $_GET['wallid'] : '';
			$sql = "delete  FROM {$databasename}.{$tablename}  where wallid='{$wallid}'";
		}
		if($object == "twitteruser")
		{
			$twitterscreenname = isset($_GET['twitterscreenname']) ? $_GET['twitterscreenname'] : '';
			$sql = "delete  FROM {$databasename}.{$tablename}  where twitterscreenname='{$twitterscreenname}'";
		}
		if($object == "youtubeuser")
		{
			$channelname = isset($_GET['channelname']) ? $_GET['channelname'] : '';
			$sql = "delete  FROM {$databasename}.{$tablename}  where channelname='{$channelname}'";
		}
		
		$responseobject->notes[] = "query = " . $sql;

		if (mysql_query($sql)) {
			$responseobject->count += 1;
		} else {
			$responseobject->errors[] = mysql_error();
		}
		
		
		mysql_close($con);
	} catch (Exception $ex) {
		$responseobject->errors = $ex->getMessage();
		mysql_close($con);
	}



	mysql_close($con);
	$responseobject->timeexcuted = include("../content/end.php"); ;

	header('Content-type: application/json; charset=utf-8');
	echo json_encode($responseobject);
?>