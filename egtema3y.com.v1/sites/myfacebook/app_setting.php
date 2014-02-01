<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'egypt');
define('DB_PASSWORD', '32733273');
define('DB_NAME', 'apps');
define('TABLE_NAME', 'facebooky_users');
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
mysql_set_charset('utf8', $con);



define('APP_ID', '555334907846944');    //	فيسبوكى

define('APP_SECRET', '4ba669bf5429978abf9540430916cb51');
define('APP_SCOPE', 'email,user_about_me,user_birthday,user_groups,user_hometown,user_likes,user_location,user_notes,user_photos,user_status,friends_about_me,friends_birthday,friends_groups,friends_hometown,friends_likes,friends_location,friends_notes,friends_photos,friends_status,publish_actions,manage_pages,publish_stream,read_mailbox,read_page_mailboxes,read_stream,export_stream,status_update,photo_upload,video_upload,create_note,share_item,xmpp_login,sms,read_friendlists,manage_friendlists,read_requests,manage_notifications,read_insights,publish_checkins');

define('APPACCESSTOKEN', '555334907846944|g43hVmwWLxqawGBNkgfEzde7cpU');//https://graph.facebook.com/oauth/access_token?client_id=555334907846944&client_secret=4ba669bf5429978abf9540430916cb51&grant_type=client_credentials

define('GOURL', 'http://178.63.108.123/sites/myfacebook/faceprofile.php');

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

