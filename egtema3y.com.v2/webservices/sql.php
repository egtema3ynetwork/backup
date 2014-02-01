<?php

require 'core.php';

$outdata;
$outdata->data = array();
$outdata->errors = array();
$outdata->error ="";


$sql = isset($_REQUEST['sql']) ?  $_REQUEST['sql'] : '';
$spy = isset($_REQUEST['spy']) ?  $_REQUEST['spy'] : 'on';

if($spy == "on")
{
     $sql = unspy($sql);
}
   


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
	$outdata->errors[] = $ex->getMessage();
}


$outdata->data = $rows;

$outdata->errors[] = mysql_error();


header('Content-type: application/json; charset=utf-8');
echo json_encode($outdata);

?>
