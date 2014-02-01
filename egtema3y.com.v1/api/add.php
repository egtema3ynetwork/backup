<?php 
	include("../content/start.php"); 
	include("../global/setting.php");

 

	function AddFacebookUser()
	{
		
		global $responseobject;
		global $access_token;
		global $databasename;
		global $tablename;
		global $con;
		
		$responseobject->data="";
		$pageid = isset($_GET['pageid']) ? $_GET['pageid'] : '';
		$pagetags = isset($_GET['pagetags']) ? $_GET['pagetags'] : '0';
		
		$data = LoadJsonFromFacebook("https://graph.facebook.com/" . $pageid . "?access_token=" .GET_ACCESSTOKEN );
		
		$decoded = json_decode($data);
		if ($decoded != null)                       
		{
			$pageid =   _nullify($decoded, 'id');
			$pageusername =  _nullify($decoded, 'username');
			$pagedisplayname =  _nullify($decoded, 'name');
			$wallimageurl =  "https://graph.facebook.com/".$pageid."/picture?type=square";
			//$wallcoverurl = $decoded->cover->source;
		}
		
		$q = "select `wallid` from `{$databasename}`.`{$tablename}` where `wallid`='$pageid'";
		$oldwall = mysql_query($q,$con) or die(mysql_error()) ;
		$responseobject->notes[]  = "sql = ".  $q;
		if($oldwall == null)
		{
			$responseobject->errors[] = ' null oldwall return';
			return;
		}
		$num_rows = mysql_num_rows($oldwall);
		if ($num_rows > 0) {
			$responseobject->notes[] = $pageid . ' exists';
			mysql_free_result($oldwall);
			return;
		}
		
		$sql = "insert into `{$databasename}`.`{$tablename}`  (wallid,wallusername,wallname,wallimageurl,tags) values('{$pageid}','{$pageusername}','{$pagedisplayname}','{$wallimageurl}','{$pagetags}')";
		$responseobject->notes[] = 'sql2 = '.$sql;
		
		$result2 = mysql_query($sql,$con) or die(mysql_error()) ;
		if($result2 == null)
		{
			$responseobject->data = 'error';
			$responseobject->errors[] = mysql_error();
		}
		else
		{
			$responseobject->count = mysql_affected_rows($con);
			if($responseobject->count > 0 )
				$responseobject->data = 'succeed';
			else                 $responseobject->data = 'error';
			
		}
		
		
	}

	function AddtwitterUser()
	{
		
		global $responseobject;
		global $access_token;
		global $databasename;
		global $tablename;
		global $con;
		
		$responseobject->data="";
		$userid = isset($_GET['userid']) ? $_GET['userid'] : '';
		
		$data = LoadJsonFromTwitter("https://api.twitter.com/1/statuses/user_timeline/" . $userid . ".json?callback=?&count=1");
		
		$decoded = json_decode($data);
		if ($decoded != null)                       
		{
			$feed = $decoded[0];
			
			$twitterscreenname = _nullify($feed->user, 'screen_name');
			$twittername = _nullify($feed->user, 'name');
			$twiiterimageurl = _nullify($feed->user, 'profile_image_url');
			
		}
		
		
		$q = "select `twitterscreenname` from `{$databasename}`.`{$tablename}` where `twitterscreenname`='$userid'";
		$oldwall = mysql_query($q,$con) or die(mysql_error()) ;
		$responseobject->notes[]  = "sql = ".  $q;
		if($oldwall == null)
		{
			$responseobject->errors[] = ' null old twitter user return';
			return;
		}
		$num_rows = mysql_num_rows($oldwall);
		if ($num_rows > 0) {
			$responseobject->notes[] = $userid . ' exists';
			mysql_free_result($oldwall);
			return;
		}
		
		$sql = "insert into `{$databasename}`.`{$tablename}`  (twitterscreenname,twittername,twitterimageurl) values('{$twitterscreenname}','{$twittername}','{$twiiterimageurl}')";
		$responseobject->notes[] = 'sql2 = '.$sql;
		
		$result2 = mysql_query($sql,$con) or die(mysql_error()) ;
		if($result2 == null)
		{
			$responseobject->data = 'error';
			$responseobject->errors[] = mysql_error();
		}
		else
		{
			$responseobject->count = mysql_affected_rows($con);
			if($responseobject->count > 0 )
				$responseobject->data = 'succeed';
			else                 $responseobject->data = 'error';
			
		}
		
		
	}



	
	function AddyoutubeUser()
	{
		
		global $responseobject;
		global $access_token;
		global $databasename;
		global $tablename;
		global $con;
		
		$responseobject->data="";
		$userid = isset($_GET['channelname']) ? $_GET['channelname'] : '';
		
		$data = LoadJsonFromYoutube("http://gdata.youtube.com/feeds/api/users/".$userid."?fields=media:thumbnail&alt=json");
		$channelname = $userid;
		//$responseobject->notes[] = "data -> ".$data;
		$decoded = json_decode($data);
		if ($decoded != null)                       
		{
			$feed = $decoded->entry;
			$media = _nullify($feed, 'media$thumbnail');
			$imageurl = _nullify($media, 'url');
		}
		
		
		$q = "select `channelname` from `{$databasename}`.`{$tablename}` where `channelname`='$channelname'";
		$oldwall = mysql_query($q,$con) or die(mysql_error()) ;
		$responseobject->notes[]  = "sql = ".  $q;
		if($oldwall == null)
		{
			$responseobject->errors[] = ' null old channelname user return';
			return;
		}
		$num_rows = mysql_num_rows($oldwall);
		if ($num_rows > 0) {
			//$responseobject->notes[] = $userid . ' exists';
			mysql_free_result($oldwall);
			return;
		}
		
		$sql = "insert into `{$databasename}`.`{$tablename}`  (channelname,youtubeimageurl) values('{$channelname}','{$imageurl}')";
		$responseobject->notes[] = 'sql2 = '.$sql;
		
		$result2 = mysql_query($sql,$con) or die(mysql_error()) ;
		if($result2 == null)
		{
			$responseobject->data = 'error';
			$responseobject->errors[] = mysql_error();
		}
		else
		{
			$responseobject->count = mysql_affected_rows($con);
			if($responseobject->count > 0 )
				$responseobject->data = 'succeed';
			else                 $responseobject->data = 'error';
			
		}
		
		
	}
	

    function Addchatmessage()
	{
		
		global $responseobject;
		global $access_token;
		global $databasename;
		global $tablename;
		global $con;
		
		$responseobject->data="";

		$roomid = isset($_GET['wallid']) ? $_GET['wallid'] : '1';
		$fromid = isset($_GET['fromid']) ? $_GET['fromid'] : '1';
        $fromname = isset($_GET['fromname']) ? $_GET['fromname'] : 'غير معروف';
        $fromimageurl = isset($_GET['fromimageurl']) ? $_GET['fromimageurl'] : '';
        $message = isset($_GET['msg']) ? $_GET['msg'] : '';
        
		$sql = "insert into `{$databasename}`.`{$tablename}`  (`id`,`roomid`, `fromid`, `fromname`, `fromimageurl`, `message`, `time`) values(null,'{$roomid}','{$fromid}','{$fromname}','{$fromimageurl}','{$message}',CURRENT_TIMESTAMP)";
		$responseobject->notes[] = 'sql2 = '.$sql;
		
		$result2 = mysql_query($sql,$con) or die(mysql_error()) ;
		if($result2 == null)
		{
			$responseobject->data = 'error';
			$responseobject->errors[] = mysql_error();
		}
		else
		{
			$responseobject->count = mysql_affected_rows($con);
			if($responseobject->count > 0 )
				$responseobject->data = 'succeed';
			else                 $responseobject->data = 'error';
			
		}
		
		
	}
	
	
	if($_GET['object'] == 'facebookuser')
	{
		AddFacebookUser();
		
	}
	else if($_GET['object'] == 'twitteruser')
	{
		AddtwitterUser();
		
	}
	else if($_GET['object'] == 'youtubeuser')
	{
		AddyoutubeUser();
		
	}
    else if($_GET['object'] == 'chating')
	{
		Addchatmessage();
		
	}


	mysql_close($con);
	$responseobject->timeexcuted = include("../content/end.php"); ;

	header('Content-type: application/json; charset=utf-8');
	echo json_encode($responseobject);
?>