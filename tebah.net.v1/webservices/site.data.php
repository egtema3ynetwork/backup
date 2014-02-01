<?php
	ob_start();
	require_once dirname(__FILE__) .'/core.php';

	$outdata= new stdClass();
	$outdata -> data = array();
	$outdata -> errors = array();
	$outdata -> messages = array();

	$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : 'select';

	foreach (ListFiles(dirname(__FILE__).'/site.data', 'php') as $key => $file)
	{
		require ("$file");
	}

	

	function get_all_site_data()
	{
		global $outdata;
		$json =  json_encode($outdata);
		
		return spy($json);
	}
	
	if ($method == "all")
	{
		header('Content-type: application/json; charset=utf-8');
		header("Access-Control-Allow-Origin: *");
		header("Cache-Control: no-store,no-cache, must-revalidate");
		
		echo unspy(get_all_site_data());
	}
?>
