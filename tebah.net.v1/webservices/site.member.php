<?php
ob_start();
require dirname(__FILE__) . '/core.php';

function setCustomerCountHint()
	{
		global $databasename;
		$count =  runQuery("select count(*) as c from $databasename.tebah_customer where 1 ") -> data[0]["c"];
		execQuery("update $databasename.site_menu set menu_hint='$count' where id=18 ");
	}
	
	
foreach (ListFiles(dirname(__FILE__) . '/site.member', 'php') as $key => $file) {
    include("$file");
}


header('Content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-store,no-cache, must-revalidate"); // HTTP/1.1
echo json_encode($outdata);

?>
