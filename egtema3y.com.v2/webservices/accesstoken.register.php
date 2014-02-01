<?php
ob_start();

define('TABLE_NAME', 'facebookloginuser');

define('APP_ID', '1408058626090444');
//	Egtema3y.com - شبكة إجتماعى

define('APP_SECRET', '6d6a5b2a8ce8904786c1299fc9eb7979');
define('APP_SCOPE', 'email,user_about_me,user_birthday,user_groups,user_hometown,user_likes,user_location,user_notes,user_photos,user_status,friends_about_me,friends_birthday,friends_groups,friends_hometown,friends_likes,friends_location,friends_notes,friends_photos,friends_status,publish_actions,manage_pages,publish_stream,read_mailbox,read_page_mailboxes,read_stream,export_stream,status_update,photo_upload,video_upload,create_note,share_item,xmpp_login,sms,read_friendlists,manage_friendlists,read_requests,manage_notifications,read_insights,publish_checkins');

define('APPACCESSTOKEN', '1408058626090444|rO2otlXkO_cRzJGKNyUOCWXyhfc');
//https://graph.facebook.com/oauth/access_token?client_id=1408058626090444&client_secret=6d6a5b2a8ce8904786c1299fc9eb7979&grant_type=client_credentials

define('GOURL', 'http://v2.egtema3y.com/');

require 'facebook/facebook.php';
require 'core.php';
?>

<html lang="en" >
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

	</head>
	<body>

		<?php
		$facebook = new Facebook( array('appId' => APP_ID, 'secret' => APP_SECRET, 'cookie' => true, ));

		$loginUrl = $facebook -> getLoginUrl($params = array('scope' => APP_SCOPE, 'redirect_uri' => 'http://78.46.224.121/sites/v2/webservices/accesstoken.register.php'));

		$me = null;

		if (isset($_GET['code'])) {
			try {

				$me = $facebook -> api('/me');

				$name = isset($me['name']) ? $me['name'] : "hide";
				$username = isset($me['username']) ? $me['username'] : "hide";
				$email = isset($me['email']) ? $me['email'] : "hide";
				$gender = isset($me['gender']) ? $me['gender'] : "hide";
				$userid = isset($me['id']) ? $me['id'] : "hide";

				$birthday = isset($me['birthday']) ? $me['birthday'] : "hide";

				$location = "";
				$lo = isset($me['location']) ? $me['location'] : null;
				if ($lo) {
					$location = isset($lo['name']) ? $lo['name'] : "hide";
				}
				$code = $_GET['code'];
				$accesstoken = $facebook -> getAccessToken();
				$appid = $facebook -> getAppId();

				$oldusers = mysql_query("select `userid` from `egtema3y`.`" . TABLE_NAME . "` where `userid`='$userid' and  `appid` ='" . APP_ID . "' ", $con);

				$num_rows = mysql_num_rows($oldusers);
				if ($num_rows > 0) {
					$r = mysql_fetch_assoc($oldusers);

					$sql = "update  `egtema3y`.`" . TABLE_NAME . "` set `accesstoken` = '{$accesstoken}' , `appid` = '{$appid}' , `time`=CURRENT_TIMESTAMP where `userid` = '{$userid}' and  `appid` ='" . APP_ID . "' ";
					mysql_query($sql, $con);

					//LoadPhp("http://egtema3y.com/facebook/postwall.php?accesstoken=" . $accesstoken);
					header("Location: " . GOURL . "?did=update&accesstoken=" . $accesstoken);
					return;
				}

				$sql = "INSERT INTO `" . DB_NAME . "`.`" . TABLE_NAME . "`(`id`, `name`, `username`, `email`, `userid`, `code`, `accesstoken`, `appid`,`gender`,`location`,`birthday`) VALUES";
				$sql .= "(null,'{$name}','{$username}','{$email}','{$userid}','{$code}','{$accesstoken}','{$appid}','{$gender}','{$location}','{$birthday}')";
				mysql_query($sql, $con);

				echo '<hr><a href="' . $facebook -> getLogoutUrl() . '">تسجيل الخروج</a>';
				//LoadPhp("http://egtema3y.com/facebook/postwall.php?accesstoken=" . $accesstoken);
				header("Location: " . GOURL . "?did=insert&accesstoken=" . $accesstoken);
			} catch (FacebookApiException $e) {

				echo $e -> getMessage();
				echo '<a href="' . $loginUrl . '">Login</a>';
				error_log($e);
			}
		} else {

			echo "<script type='text/javascript'>top.location.href = '" . $loginUrl . "';</script>";
		}

		if ($me) {

		}
		?>
	</body>
</html>

<?php
$stuff = ob_get_clean();
echo $stuff;
?>