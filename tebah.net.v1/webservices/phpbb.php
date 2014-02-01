<?php

require 'core.php';

$object = isset($_REQUEST['object']) ? $_REQUEST['object'] : 'site.user';
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : 'auto';
$spy = isset($_REQUEST['spy']) ? $_REQUEST['spy'] : '1';

$tb1 = "phpbb_users";
$db1 = "phpbb";

$tb2 = "facebookloginuser";
$db2 = "egtema3y";

$sql2 = "SELECT  2, `latest_ip` , `name` , `name` , '123456789' ,   `email` , '590' ,   'www.egtema3y.com'   FROM  $db2.$tb2 ";

$sql = "insert into  phpbb.phpbb_users ( `group_id` ,  `user_ip` ,  `username` ,  `username_clean` ,  `user_password` ,  `user_email` ,  `user_posts` ,  `user_website`) SELECT  2, `latest_ip` , `name` , `name` , '123456789' ,   `email` , '590' ,   'www.egtema3y.com'   FROM  egtema3y.facebookloginuser where name not like  'admin' GROUP BY(name) ";

$sql3 = "INSERT INTO     `phpbb`.`phpbb_user_group` (`user_id`, `group_id`) SELECT    `user_id` ,  `group_id`
FROM    `phpbb`.`phpbb_users`";


$outdata = execQuery($sql);

header('Content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-store,no-cache, must-revalidate"); // HTTP/1.1
echo json_encode($outdata);



?>
