<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'egypt');
define('DB_PASSWORD', '32733273');
define('DB_NAME', 'egtema3y');
define('TABLE_NAME', 'app_users');
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
mysql_set_charset('utf8', $con);


define ('APP_NAME','دروب الخير');
define('APP_ID', '667343489949098'); 
define('APP_SECRET', '3089730f8d593c0ef755eb2216fbe5b7');
define('APPACCESSTOKEN', '667343489949098|1iQURBWxdv-G1h6qFAgc0nV4bng');//https://graph.facebook.com/oauth/access_token?client_id=667343489949098&client_secret=3089730f8d593c0ef755eb2216fbe5b7&grant_type=client_credentials



define('APP_SCOPE', 'email,user_about_me,user_birthday,user_groups,user_hometown,user_likes,user_location,user_notes,user_photos,user_status,friends_about_me,friends_birthday,friends_groups,friends_hometown,friends_likes,friends_location,friends_notes,friends_photos,friends_status,publish_actions,manage_pages,publish_stream,read_mailbox,read_page_mailboxes,read_stream,export_stream,status_update,photo_upload,video_upload,create_note,share_item,xmpp_login,sms,read_friendlists,manage_friendlists,read_requests,manage_notifications,read_insights,publish_checkins');

define('GOURL', 'http://egtema3y.com/facebook/app1/app_auto_post.php');


//define('APPACCESSTOKEN', '129108667268260|t8cW9_GIZLnehbfmtp9bsrVOliM');//https://graph.facebook.com/oauth/access_token?client_id=129108667268260&client_secret=5a82c7f8c00e2f75f31313f947cd8446&grant_type=client_credentials

?>

