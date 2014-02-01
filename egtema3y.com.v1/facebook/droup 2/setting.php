<?php

define('DB_SERVER', 'localhost');
define('DB_USER', 'droob_egypt');
define('DB_PASSWORD', '987654321');
define('DB_NAME', 'droob_apps');
define('TABLE_NAME', 'app_users');
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
mysql_set_charset('utf8', $con);


define('APP_NAME', 'دروب الخير');
define('APP_ID', '667343489949098');
define('APP_SECRET', '3089730f8d593c0ef755eb2216fbe5b7');
define('APPACCESSTOKEN', '667343489949098|1iQURBWxdv-G1h6qFAgc0nV4bng'); //https://graph.facebook.com/oauth/access_token?client_id=667343489949098&client_secret=3089730f8d593c0ef755eb2216fbe5b7&grant_type=client_credentials

define('APP_SCOPE', 'email,user_about_me,user_birthday,user_location,user_status,publish_actions,publish_stream,status_update,share_item,publish_checkins');

define('GOURL', 'http://www.droup.net/vb');
?>

