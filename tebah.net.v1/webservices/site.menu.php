<?php
ob_start();
require dirname(__FILE__) . '/core.php';

$outdata;
$outdata -> data = array();
$outdata -> errors = array();
$outdata -> messages = array();



foreach (ListFiles(dirname(__FILE__) . '/site.menu', 'php') as $key => $file) {
    include("$file");
}







header('Content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-store,no-cache, must-revalidate"); // HTTP/1.1
echo json_encode($outdata);

?>
