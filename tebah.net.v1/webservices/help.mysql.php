<?php


$lastsqls = array();

function runQuery($sql) {

	global $con;
	global $__;
	global $lastsqls;
	
	
	
	$rows = array();
	$outdata;
	$outdata -> data = array();
	$outdata -> count = 0;
	
	if($__['isDevelopmentMode'] == TRUE)
	{
		$lastsqls[] = $sql;
		$outdata -> sql = $sql;
		$outdata -> sqls = $lastsqls;
	}
	
	$outdata -> success = false;
	$outdata -> error = "";

	try {
		$result = mysql_query($sql, $con);
		if (!!$result) {

			while ( $row = mysql_fetch_assoc($result) ) {
				$rows[] = $row;
				
			}

			$outdata -> data = $rows;
			$outdata -> count = mysql_num_rows($result);
			$outdata -> success = true;
		}

	} catch(Exception $ex) {
		$outdata -> error = $ex -> getMessage();
	}
	return $outdata;

}

function execQuery($sql) {

	global $con;
	global $__;
	global $lastsqls;
	
	$rows = array();
	$outdata;
	$outdata -> data = array();
	$outdata -> count = 0;
	
	if($__['isDevelopmentMode'] == TRUE)
	{
		$lastsqls[] = $sql;
		$outdata -> sql = $sql;
		$outdata -> sqls = $lastsqls;
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