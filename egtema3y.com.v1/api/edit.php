<?php include("../content/start.php"); ?>
    
<?php

	require "../global/setting.php";



	try {

		$responseobject->serviceurl = "api/edit.php";

		
		
		if($_GET['object'] == "facebookuser")
		{
			$wallid = isset($_GET['wallid']) ? $_GET['wallid'] : '';
			$tags = isset($_GET['tags']) ? $_GET['tags'] : '0';
			$publicview = isset($_GET['publicview']) ? $_GET['publicview'] : '0';
			$sql = "UPDATE {$databasename}.{$tablename} SET `tags`='{$tags}' , `wallpublicview`='{$publicview}' where `wallid`='{$wallid}'  ";
		}
		else if($_GET['object'] == "twitteruser")
		{
			$twitterscreenname = isset($_GET['twitterscreenname']) ? $_GET['twitterscreenname'] : '';
			$tags = isset($_GET['tags']) ? $_GET['tags'] : '0';
			$publicview = isset($_GET['publicview']) ? $_GET['publicview'] : '0';
			$sql = "UPDATE {$databasename}.{$tablename} SET `tags`='{$tags}' , `publicview`='{$publicview}'  where `twitterscreenname`='{$twitterscreenname}' ";
		}
		else if($_GET['object'] == "youtubeuser")
		{
			$channelname = isset($_GET['channelname']) ? $_GET['channelname'] : '';
			$tags = isset($_GET['tags']) ? $_GET['tags'] : '0';
			$publicview = isset($_GET['publicview']) ? $_GET['publicview'] : '0';
			$sql = "UPDATE {$databasename}.{$tablename} SET `tags`='{$tags}' , `publicview`='{$publicview}'  where `channelname`='{$channelname}' ";
		}
		
		
		$responseobject->notes[] = "query = " . $sql;

		if (mysql_query($sql)) {
			$responseobject->count += 1;
		} else {
			$responseobject->errors[] = mysql_error();
		}
		

		$responseobject->errors = mysql_error();
		mysql_close($con);
	} catch (Exception $ex) {
		$responseobject->errors = $ex->getMessage();
		mysql_close($con);
	}
	

	$responseobject->timeexcuted = include("../content/end.php");;
	header('Content-type: application/json; charset=utf-8');
	if ($fullinfo == "no") {
		echo json_encode($responseobject->data);
	} else if($fullinfo == "yes") {
		echo json_encode($responseobject);
	}
?>