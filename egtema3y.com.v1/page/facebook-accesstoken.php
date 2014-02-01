<?php
	require "../global/setting.php";
	require("../sdk/facebook/facebook.php");


	$config = array();
	$config['appId'] = '362076570512100';
	$config['secret'] = '7f35789bb5b287e0dfd3c5b468966ee8';
	$config['fileUpload'] = false; // optional

	$facebook = new Facebook($config);
	
	$facebook->setAccessToken("CAACEdEose0cBALmzZB2BMZCSgxZA97k7F9wf2y4tXlASnzjl6hKKJHfLUNKEkV3K1GTG6a9gaJUc2jcfbjT7MZAcxIG1ccrVR7MkAJXhsMA4V9UdVUKB78ZAXHfFZAXeTYGQ80RolM1cNEVxqlqZBX2QDrZAjZBaLy3CCZBO6sCT3MlwZDZD");
	$ret_obj = $facebook->api('/me/accounts');
	print_r( $ret_obj);

?>