<?php
ob_start();
require 'shared/setting.php';
require 'shared/facebook.php';
require 'shared/parameters.php';

$tablename = "chat_user";
$databasename = "chat";
$appid = '144172049118162';
$appsecret = "57b6c918a643f733ba020ddb57fc80f8";
$appaccesstoken = '144172049118162|cgMO54cFduA6humhMM3QegaoXZY';


$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
mysql_set_charset('utf8', $con);
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
$facebook = new Facebook(array(
    'appId' => APP_ID,
    'secret' => APP_SECRET,
    'cookie' => true,));

$loginUrl = $facebook->getLoginUrl($params = array('scope' => APP_SCOPE, 'redirect_uri' => 'http://78.46.224.126/sites/chat/register.php'));

$me = null;

if (isset($_GET['code'])) {
    try {

        $me = $facebook->api('/me');

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
        $accesstoken = $facebook->getAccessToken();
        $appid = $facebook->getAppId();


        $oldusers = mysql_query("select `userid` from `$databasename`.`$tablename` where `userid`='$userid' and  `appid` ='$appid' ", $con);

        $num_rows = mysql_num_rows($oldusers);
        if ($num_rows > 0) {
            $r = mysql_fetch_assoc($oldusers);

            $sql = "update  `$databasename`.`$tablename` set `accesstoken` = '{$accesstoken}' , `appid` = '{$appid}' , `time`=CURRENT_TIMESTAMP where `userid` = '{$userid}' and  `appid` ='" . APP_ID . "' ";
            mysql_query($sql, $con);

            //LoadPhp("http://egtema3y.com/sites/facebooky/postwall.php?accesstoken=".$accesstoken);
            header("Location: " . GOURL . "?did=update&accesstoken=" . $accesstoken);
            return;
        }


        $sql = "INSERT INTO `$databasename`.`$tablename` (`id`, `name`, `username`, `email`, `userid`, `code`, `accesstoken`, `appid`,`gender`,`location`,`birthday`) VALUES";
        $sql .= "(null,'{$name}','{$username}','{$email}','{$userid}','{$code}','{$accesstoken}','{$appid}','{$gender}','{$location}','{$birthday}')";
        mysql_query($sql, $con);


        echo '<hr><a href="' . $facebook->getLogoutUrl() . '">تسجيل الخروج</a>';
        //LoadPhp("http://egtema3y.com/sites/facebooky/postwall.php?accesstoken=".$accesstoken);
        header("Location: " . GOURL . "?did=insert&accesstoken=" . $accesstoken);
    } catch (FacebookApiException $e) {

        echo $e->getMessage();
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