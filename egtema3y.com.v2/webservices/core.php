<?php

require 'core.functions.php';

$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
mysql_set_charset('utf8', $con);

function runQuery($sql) {

	global $con;
	global $__;

	$rows = array();
	$outdata;
	$outdata -> data = array();
	$outdata -> count = 0;

	if ($__['isDevelopmentMode'] == TRUE) {
		$outdata -> sql = $sql;
	}

	$outdata -> success = 0;
	$outdata -> error = "";

	try {
		$result = mysql_query($sql, $con);
		if (!!$result) {

			while ($row = mysql_fetch_assoc($result)) {
				$rows[] = $row;
			}

			$outdata -> data = $rows;
			$outdata -> count = mysql_num_rows($result);
		}

	} catch(Exception $ex) {
		$outdata -> error = $ex -> getMessage();
	}
	return $outdata;

}

function execQuery($sql) {

	global $con;
	global $__;

	$rows = array();
	$outdata;
	$outdata -> data = array();
	$outdata -> count = 0;

	if ($__['isDevelopmentMode'] == TRUE) {
		$outdata -> sql = $sql;
	}

	$outdata -> success = 0;
	$outdata -> error = "";
	$outdata -> id = 0;
	try {
		$result = mysql_query($sql, $con);
		$outdata -> count = mysql_affected_rows($con);
		$outdata -> id = mysql_insert_id($con);
		if ($outdata -> count > 0) {
			$outdata -> success = 1;
		}

	} catch(Exception $ex) {
		$outdata -> error = $ex -> getMessage();
	}

	return $outdata;

}
?>
