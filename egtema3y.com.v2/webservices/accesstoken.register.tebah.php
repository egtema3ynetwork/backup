<?php
ob_start();

define('TABLE_NAME', 'tebah_member');

define('APP_ID', '603172939733662');
//	 Chat Mobile

define('APP_SECRET', '15e6674c60e50e6b05136d7d13f10cbc');
define('APP_SCOPE', 'email,user_about_me,user_birthday,user_groups,user_hometown,user_likes,user_location,user_notes,user_photos,user_status,friends_about_me,friends_birthday,friends_groups,friends_hometown,friends_likes,friends_location,friends_notes,friends_photos,friends_status,publish_actions,manage_pages,publish_stream,read_mailbox,read_page_mailboxes,read_stream,export_stream,status_update,photo_upload,video_upload,create_note,share_item,xmpp_login,sms,read_friendlists,manage_friendlists,read_requests,manage_notifications,read_insights,publish_checkins');

define('APPACCESSTOKEN', '129108667268260|lP2hMIB6apXSiRaEpafw8nnA9Fk');
//https://graph.facebook.com/oauth/access_token?client_id=129108667268260&client_secret=aa9356e010da0ca1baf66ffd6fbac04c&grant_type=client_credentials

define('GOURL', 'http://tebah.net/');

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

		$loginUrl = $facebook -> getLoginUrl($params = array('scope' => APP_SCOPE, 'redirect_uri' => 'http://egtema3y.com/sites/v2/webservices/accesstoken.register.tebah.php'));

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

				$oldusers = mysql_query("select `userid` from `tebah`.`" . TABLE_NAME . "` where `faceid`='$userid'  ", $con);

				$num_rows = mysql_num_rows($oldusers);
				if ($num_rows > 0) {
					$r = mysql_fetch_assoc($oldusers);

					$sql = "update  `tebah`.`" . TABLE_NAME . "` set `accesstoken` = '{$accesstoken}' ,  `time`=CURRENT_TIMESTAMP where `faceid` = '{$userid}'  ";
					mysql_query($sql, $con);

					//LoadPhp("http://egtema3y.com/facebook/postwall.php?accesstoken=" . $accesstoken);
					header("Location: " . GOURL . "?did=update&accesstoken=" . $accesstoken);
					return;
				}

				$sql = "INSERT INTO `tebah`.`" . TABLE_NAME . "`(`id`, `name`, `email`, `faceid`, `accesstoken`, `gender`,`location`,`birthday`) VALUES";
				$sql .= "(null,'{$name}', '{$email}','{$userid}','{$accesstoken}','{$gender}','{$location}','{$birthday}')";
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