<?php

	$htmldir = "html";
	$jsdir = "js";
	$cssdir = "css";

	$__ = array();
	$__['isOnlineMode'] = FALSE;
	$__['isDevelopmentMode'] = TRUE;
	$__['isDemoMode'] = FALSE;
	$__['useMiniCSS'] = FALSE;
    $__['useMiniJS'] = FALSE;
	$__['zip_output'] = FALSE;

	if ($__['isOnlineMode'] == TRUE)
	{
		$__['webSiteURL'] = "http://tebah.net";

		define('DB_SERVER', 'localhost');
		define('DB_USER', 'root');
		define('DB_PASSWORD', '32733273');
		define('DB_NAME', 'tebah');
	}
	else
	{
		$__['webSiteURL'] = "http://localhost/tebah";

		define('DB_SERVER', 'localhost');
		define('DB_USER', 'root');
		define('DB_PASSWORD', '');
		define('DB_NAME', 'tebah');
	}

	$__['webServicesURL'] = $__['webSiteURL'] . "/webservices";

	require_once dirname(__FILE__) . '/help.functions.php';

	$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
	mysql_set_charset('utf8', $con);

	require_once dirname(__FILE__) . '/help.mysql.php';
	
	if($__['zip_output'])
	{
		ob_start('zip_output');
	}
?>
