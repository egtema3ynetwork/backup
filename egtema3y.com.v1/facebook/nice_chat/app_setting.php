<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'egypt');
define('DB_PASSWORD', '32733273');
define('DB_NAME', 'apps');
define('TABLE_NAME', 'app_users');
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
mysql_set_charset('utf8', $con);



define('APP_ID', '144172049118162');    //	Egtema3y.com - شبكة إجتماعى

define('APP_SECRET', '57b6c918a643f733ba020ddb57fc80f8');
define('APP_SCOPE', 'email,user_about_me,user_birthday,user_groups,user_hometown,user_likes,user_location,user_notes,user_photos,user_status,friends_about_me,friends_birthday,friends_groups,friends_hometown,friends_likes,friends_location,friends_notes,friends_photos,friends_status,publish_actions,manage_pages,publish_stream,read_mailbox,read_page_mailboxes,read_stream,export_stream,status_update,photo_upload,video_upload,create_note,share_item,xmpp_login,sms,read_friendlists,manage_friendlists,read_requests,manage_notifications,read_insights,publish_checkins');

define('APPACCESSTOKEN', '144172049118162|cgMO54cFduA6humhMM3QegaoXZY');//https://graph.facebook.com/oauth/access_token?client_id=144172049118162&client_secret=57b6c918a643f733ba020ddb57fc80f8&grant_type=client_credentials

define('GOURL', 'http://egtema3y.com/page/chatrooms.php');

function getcurrentpath()
{
    $curPageURL = "";
    //if ($_SERVER["HTTPS"] != "on")
        $curPageURL .= "http://";
    //else
    //    $curPageURL .= "https://" ;
    //if ($_SERVER["SERVER_PORT"] == "80")
        $curPageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    //else
    //    $curPageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    $count = strlen(basename($curPageURL));
    $path = substr($curPageURL,0, -$count);
    return $path ;
}

?>

