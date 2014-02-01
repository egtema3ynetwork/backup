<?php

	$outdata;
	$outdata -> data = array();
	$outdata -> errors = array();
	$outdata -> messages = array();

	$object = isset($_REQUEST['object']) ? $_REQUEST['object'] : 'site.customer';
	$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : 'select';
	$spy = isset($_REQUEST['spy']) ? $_REQUEST['spy'] : '1';

	$tablename = "tebah_customer";
	$databasename = DB_NAME;

	
	
	
?>