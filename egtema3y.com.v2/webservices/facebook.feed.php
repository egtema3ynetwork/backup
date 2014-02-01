<?php
set_time_limit(0);
require 'core.php';
$outdata;
$outdata -> data = array();
$outdata -> errors = array();
$outdata -> newPostCount = 0;

function LoadJsonFromFacebook($url) {
	try {
		global $outdata;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: graph.facebook.com'));
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	} catch (Exception $ex) {
		$outdata -> errors[] = $ex;
		return null;
	}
}

function addfeedfromfacebook($feed, $tags, $publicview) {
	global $outdata;
	global $con;
	try {
		$fromid = $feed -> from -> id;
		$fromname = $feed -> from -> name;
		$created_time = getJsonValue($feed, 'created_time');
		$postmessage = getJsonValue($feed, 'message');
		$story = getJsonValue($feed, 'story');
		$postimage = getJsonValue($feed, 'picture');
		if ($postimage) {
			$postimage = preg_replace("/_s./", "_n.", $postimage);
		}
		$postlinkname = getJsonValue($feed, 'name');
		$postlinkurl = getJsonValue($feed, 'link');
		$postcaption = getJsonValue($feed, 'caption');
		$postdescription = getJsonValue($feed, 'description');
		$frompicture = "";
		$postid = getJsonValue($feed, 'id');
		if (strpos($postmessage, '/fanned_pages/') !== false) {
			return;
		}
		$postmessage = shortenAllLinks($postmessage);
		$postlinkurl = getShortenUrl($postlinkurl);
		$fromid = BlockSQL($fromid);
		$fromname = BlockSQL($fromname);
		$postmessage = BlockSQL($postmessage);
		$story = BlockSQL($story);
		$postimage = BlockSQL($postimage);
		$postlinkname = BlockSQL($postlinkname);
		$postlinkurl = BlockSQL($postlinkurl);
		$postcaption = BlockSQL($postcaption);
		$postdescription = BlockSQL($postdescription);
		$oldposts = runQuery("select postid from facebook.facebookfeed" . $tags . "  where postid='$postid'  ");
		if (count($oldposts -> data) > 1) {
			$outdata -> messages[] = "post $postid Exist";
			return;
		}
		$sql = "INSERT INTO facebook.facebookfeed" . $tags . "  (
				id ,
				time ,
				wallid ,
				wallname ,
				wallimageurl ,
				postid ,
				postmessage ,
				postmessage2 ,
				postlinkname ,
				postlinkurl ,
				postcaption ,
				postdescription ,
				postimage ,
				tags,
				publicview
				)
				VALUES (
				NULL ,
				'{$created_time}' , '{$fromid}', '{$fromname}', '{$frompicture}', '{$postid}',
				'{$postmessage}' , '{$story}' , '{$postlinkname}','{$postlinkurl}' , '{$postcaption}' , '{$postdescription}' , '{$postimage}','{$tags}','{$publicview}'
				)
				";
		mysql_query($sql, $con);
		$outdata -> errors[] = mysql_error();
		$outdata -> newPostCount += 1;
	} catch (Exception $ex) {
		$outdata -> errors[] = $ex -> getMessage();
	}
}

function AutoLoadFeedsFromFacebook() {
	try {
		global $outdata;
		$outdata -> messages[] = 'AutoLoadFeedsFromFacebook';
		$access_token = "362076570512100|SqcPV6yIBq6eVZr54SCoqJ6pQDc";
		$sql = "select wallid,tags,wallpublicview from facebook.facebookuser where 1 and wallautoupdate = 1 limit 15";
		if (isset($_REQUEST['wallid']) && $_REQUEST['wallid'] != '') {
			$sql .= " and wallid='" . $_REQUEST['wallid'] . "' ";
		}
		if (isset($_REQUEST['tags']) && $_REQUEST['tags'] != '') {
			$sql .= " and tags='" . $_REQUEST['tags'] . "' ";
		}
		$allpage = runQuery($sql);
		foreach ($allpage->data as $row) {
			$pageid = $row -> wallid;
			$data = LoadJsonFromFacebook("https://graph.facebook.com/" . $pageid . "/feed/?access_token=" . $access_token . "&limit=2");
			$decoded = json_decode($data);
			if ($decoded != null) {
				if (getJsonValue($decoded, 'data')) {
					foreach ($decoded->data as $feed) {
						if ($feed -> from -> id == $pageid) {
							addfeedfromfacebook($feed, $r["tags"], $r["wallpublicview"]);
						}
					}
				}
			}
		}
	} catch (Exception $ex) {
		$outdata -> errors[] = $ex -> getMessage();
	}
}

$object = isset($_REQUEST['object']) ? $_REQUEST['object'] : 'facebook';
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : 'newfeeds';
$spy = isset($_REQUEST['spy']) ? $_REQUEST['spy'] : '1';

$tablename = "facebookfeed";
$databasename = "facebook";

if ($object == "facebook" && $method == "newfeeds") {

    try {
        
	$columns = " * ,TIMESTAMPDIFF(SECOND,time,CURRENT_TIMESTAMP()) as timeago ";
	$maxrownum = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : "30";
	$startfromrow = isset($_REQUEST['start']) ? $_REQUEST['start'] : "0";
	$limit = " limit " . $startfromrow . "," . $maxrownum . " ";
	$where = " where 1 ";
	if (isset($_REQUEST['id']) && $_REQUEST['id'] != "") {
		$where .= " and id='{$_REQUEST['id']}' ";
	}
	if (isset($_REQUEST['postid']) && $_REQUEST['postid'] != "") {
		$where .= " and postid = '{$_REQUEST['postid']}' ";
	}
	if (isset($_REQUEST['wallid']) && $_REQUEST['wallid'] != "") {
		$where .= " and wallid = '{$_REQUEST['wallid']}' ";
	}
	if (isset($_REQUEST['posttype']) && $_REQUEST['posttype'] != "") {
		$where .= " and posttype like '%[{$_REQUEST['posttype']}]%' ";
	}
	if (isset($_REQUEST['maxid']) && $_REQUEST['maxid'] != "") {
		$where .= " and id < {$_REQUEST['maxid']} ";
	}
	if (isset($_REQUEST['maxtime']) && $_REQUEST['maxtime'] != "" & $_REQUEST['maxtime'] != "undefined") {
		$where .= " and time <= '{$_REQUEST['maxtime']}' ";
	}
	if (isset($_REQUEST['search']) && $_REQUEST['search'] != "") {
		$where .= " and postmessage like '%{$_REQUEST['search']}%' ";
	}
	if (isset($_REQUEST['tags']) && $_REQUEST['tags'] != "" & $_REQUEST['tags'] != "undefined") {
		$tablename = $tablename . $_REQUEST['tags'];
	} else {
		if (isset($_REQUEST['publicview']) && $_REQUEST['publicview'] != "" & $_REQUEST['publicview'] != "undefined") {
			$where .= " and publicview = {$_REQUEST['publicview']}  ";
		} else {
			$where .= " and publicview = 1  ";
		}
	}
	$sql = "select $columns from $databasename.$tablename  $where order by time desc $limit";
	//$newdata = runQuery($sql);

	$rows = array();
    	$result = mysql_query($sql, $con);

if ($result != null) {
    while ($r = mysql_fetch_assoc($result)) {
        $rows[] = $r;
    }
}


   
         $outdata->count =count($rows);
          $outdata->data =$rows;
        

	 if($outdata->count > 0)
	 {
	 	$outdata->firstid = $outdata->data[0]['id'];
        $outdata->lastid = $outdata->data[$outdata->count- 1]['id'];
        $outdata->maxtime = $outdata->data[0]['time'];
        $outdata->mintime = $outdata->data[$outdata->count - 1]['time'];
	 }

    
	 }catch(Exception $ex)
     {
        
         $outdata->errors[] = $ex->getMessage();
     }

        
        
}
if ($object == "facebook" && $method == "updatefeeds") {
	while (TRUE) {
		AutoLoadFeedsFromFacebook();
		$sql = "select loop from egtema3y.service where actionname='update_facebook'";
		$allServices = runQuery($sql);
		if (!$allServices || $allServices == null) {
			$outdata -> messages[] = 'All Services Error Run Query';
			break;
		}
		if (count($allServices -> data) == 0) {
			$outdata -> messages[] = 'Facebook Setting service Not Found';
			break;
		} elseif (count($allServices -> data) == 1) {
			if ($allServices -> data[0] -> loop == 1) {
				$outdata -> messages[] = 'Facebook Still in loop';
				//AutoLoadFeedsFromFacebook();
				break;
			} else {
				$outdata -> messages[] = 'Facebook Out off loop';
				break;
			}
		}
	}
}
header('Content-type: application/json; charset=utf-8');
echo json_encode($outdata);
?>
