<?php

require 'core.php';

$outdata;
$outdata->data = array();
$outdata->errors = array();
$outdata->error ="";


$sql = isset($_REQUEST['sql']) ?  $_REQUEST['sql'] : '';


    $sql = unspy($sql);


if (isDeveloperMode()) {
    $outdata->sql = $sql;
}


$rows = array();

try{
	$result = mysql_query($sql, $con);

if ($result != null) {
    while ($r = mysql_fetch_assoc($result)) {
        $rows[] = $r;
    }
}
}catch(Exception $ex)
{
	$outdata->error =$ex->getMessage();
}


$outdata->data = $rows;

$outdata->errors[] = mysql_error();


header('Content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-store,no-cache, must-revalidate"); // HTTP/1.1
echo json_encode($outdata);

?>
