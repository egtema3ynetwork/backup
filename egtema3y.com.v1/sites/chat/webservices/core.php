<?php

require 'core.functions.php';

$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
mysql_set_charset('utf8', $con);
function runQuery($sql) {

	global $con; 
   // $result = json_decode(LoadPhp(getWebServicesUrl() . "/sql.php?sql=" . spy($sql)));
   $rows = array();
   $outdata;
   $outdata->data = array();
    $outdata->count = 0;
	
	
   $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $outdata->data = $rows;
            $outdata->count = count($rows);
        }
		
    return $outdata; 

	}
 

?>
