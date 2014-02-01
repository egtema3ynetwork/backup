<?php
ob_start();
  require ('../global/database.php');
?>


        <?php
//This is my skeleton template for a PHP SDK canvas app, use it if you find it useful.
//Lately I use iframe canvas apps so I used a javascript page redirect instead of fbjs ajax with require_login();
//Don't forget to change path to PHP SDK if necessary
        require 'facebook.php';
// Create our Application instance. Don't forget to change to your AppId and Secret

        $facebook = new Facebook(array(
                    'appId' => '129108667268260',
                    'secret' => 'aa9356e010da0ca1baf66ffd6fbac04c',
                    'cookie' => true,));

// Uncomment to debug post fields
// print_r($_REQUEST);
// Setting canvas to 1 and fbconnect to 0 fixes issues with being redirected back to your base domain instead of back to the canvas app on auth
        $loginUrl = $facebook->getLoginUrl($params = array('canvas' => 1, 'fbconnect' => 0, 'req_perms' => 'email,user_about_me,user_activities,user_birthday,user_groups,user_hometown,user_likes,user_location,user_events,user_games_activity,user_notes,user_photos,user_status,friends_about_me,friends_birthday,friends_groups,friends_hometown,friends_likes,friends_location,friends_events,friends_games_activity,friends_notes,friends_photos,friends_status,publish_actions,user_actions:twitter,friends_actions:twitter,manage_pages,publish_stream,read_mailbox,read_page_mailboxes,read_stream,export_stream,offline_access,status_update,photo_upload,video_upload,create_note,share_item,xmpp_login,sms,create_event,rsvp_event,read_friendlists,manage_friendlists,read_requests,manage_notifications,read_insights,ads_management,publish_checkins'));


        $me = null;

        if (isset($_GET['accesstoken'])) {
            try {
                 $facebook->setAccessToken($_GET['accesstoken']);
                 $me = $facebook->api('/me');

                $name = isset($me['name']) ? $me['name'] : "";
                $username = isset($me['username']) ? $me['username'] : "";
                $email = isset($me['email']) ? $me['email'] : "";
                $gender = isset($me['gender']) ? $me['gender'] : "";
                $userid = isset($me['id']) ? $me['id'] : "";
				 $birthday = isset($me['birthday']) ? $me['birthday'] : "hide";
                $location = "";
                $lo = isset($me['location']) ? $me['location'] : null;
                if ($lo) {
                    $location = isset($lo['name']) ? $lo['name'] : "";
                }
                $code = isset($_GET['code'])? $_GET['code'] : "";
                $member = isset($_GET['member'])? $_GET['member'] : "0";
                $accesstoken = $facebook->getAccessToken();
                $appid = $facebook->getAppId();
				 if (isset($_GET['appid'])) {
				 $appid = $_GET['appid'];
				 }
                $guid = generateRandomString();

                $expire = time() + 60 * 60 * 24 * 30;
                //setcookie("username", $name, $expire);

                // echo "First AccessToken : " . $facebook->getAccessToken() . "<hr>";
                // echo "me : ".$me."<hr>";
                $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
                mysql_set_charset('utf8', $con);

                $oldposts = mysql_query("select `userid` from " . DB_NAME_EGTEMA3Y . ".`facebookaccesstoken` where `userid`='$userid'  ", $con);

                $num_rows = mysql_num_rows($oldposts);
                if ($num_rows > 0) {
                    $r = mysql_fetch_assoc($oldposts);
                   // $guid = $r['guid'];
                    $sql = "update  egtema3y.`facebookaccesstoken` set `accesstoken` = '{$accesstoken}' , `member` = '{$member}', `appid` = '{$appid}' , `time`=CURRENT_TIMESTAMP , birthday = '$birthday' where `userid` = '{$userid}'  ";
                    mysql_query($sql, $con);

                    if($member == "0")
                    {
                         // LoadPhp("http://egtema3y.com/facebook/postwall.php?accesstoken=".$accesstoken);
                    }
                    
                    //header("Location: http://egtema3y.com/page/facebook.php?guid=" . $guid);
                    die("update");
                }


                $sql = "INSERT INTO egtema3y.`facebookaccesstoken`(`id`, `name`, `username`, `email`, `userid`, `code`, `accesstoken`, `appid`,`gender`,`location`,`guid`,`member` , `birthday`) VALUES";
                $sql .= "(null,'{$name}','{$username}','{$email}','{$userid}','{$code}','$accesstoken','{$appid}','{$gender}','{$location}','{$guid}', {$member} , '$birthday')";
                mysql_query($sql, $con);

                if($member == "0")
                    {
                         // LoadPhp("http://egtema3y.com/facebook/postwall.php?accesstoken=".$accesstoken);
                    }

                //If user has authed application, render a logout link.
               // echo '<hr><a class="btn btn-danger" href="' . $facebook->getLogoutUrl() . '">تسجيل الخروج</a>';
               // header("Location: http://egtema3y.com/page/facebook.php?guid=" . $guid);
            } catch (FacebookApiException $e) {
                //Uncomment the line below to have a user click to authorize the app instead of requesting permissions on page load.
                //echo '<a href="' . $loginUrl . '">Login</a>';
                //Request permissions on page load if app is not authed & cannot request user information.
                //echo "<script type='text/javascript'>top.location.href = '".$loginUrl."';</script>";
               // error_log($e);
            }
        } else {
            //Request permissions on page load if app is not authed & or session is invalid.
            //echo "<script type='text/javascript'>top.location.href = '" . $loginUrl . "';</script>";
			echo "no accesstoken ";
        }

// If you can hit user on the Graph API, do some stuff
        if ($me) {
            
        }

        function generateRandomString($length = 16) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }

         function LoadPhp($url) {
    try {

        global $responseobject;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: graph.facebook.com'));
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    } catch (Exception $ex) {
        $responseobject->errors = $ex;
        return null;
    }
}


        ?>


<?php
$stuff = ob_get_clean();
echo $stuff;
?>