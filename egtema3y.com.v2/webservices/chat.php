<?php

require 'core.php';

$outdata;
$outdata -> data = array();
$outdata -> errors = array();

$object = isset($_REQUEST['object']) ? $_REQUEST['object'] : 'chat.room';
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : 'select';
$spy = isset($_REQUEST['spy']) ? $_REQUEST['spy'] : '1';

$tablename = "chat_room";
$databasename = "mobile_chat";


if ($method == "select" && $object == "chat.room.all") {

	
	$sql = "select *,TIMESTAMPDIFF(SECOND,time,CURRENT_TIMESTAMP()) as timeago from $databasename.$tablename where 1 " . $condition . " order by time desc limit 100 ";

	$outdata = runQuery($sql);
	
}

if ($method == "delete" && $object == "site.member") {

	$member_id = $_REQUEST["id"];
	$member_id = BlockSQL(unspy($member_id));

	$sql = "delete from $databasename.$tablename where id=" . $member_id;
	$outdata = runQuery($sql);
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($outdata);
?>
