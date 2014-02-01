<?php include("../content/start.php"); ?>
    
    <?php

require "../global/setting.php";



try {

    $responseobject->serviceurl = "api/get.php";

    
    
    
    $sql = "SELECT {$scope}  FROM {$databasename}.{$tablename}  where 1 ";
    
    $sql .= $where;
    if (isset($_GET['sort']) && $_GET['sort'] != "") {
        $sql .= " order by {$_GET['sort']}";
    }
    $sql .= $limit;

    //$responseobject->notes[] = "query = " . $sql;

    
   

     $rows=array();
   
       $result = mysql_query($sql,$con);
    if ($result != null) {
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        $responseobject->data = $rows;
        $responseobject->count = count($rows);
    }  
    
    

    if ( ($object == "facebook" || $object == "twitter" || $object == "youtube" || $object == "chating") && isset($rows) && count($rows) > 0) {

        $responseobject->count = count($rows);
        $responseobject->firstid = $rows[0]['id'];
        $responseobject->lastid = $rows[count($rows) - 1]['id'];
        $responseobject->maxtime = $rows[0]['time'];
        $responseobject->mintime = $rows[count($rows) - 1]['time'];
    }

    $responseobject->errors = mysql_error();
    mysql_close($con);
} catch (Exception $ex) {
    $responseobject->errors = $ex->getMessage();
     mysql_close($con);
}
 

$responseobject->timeexcuted = include("../content/end.php");;
header('Content-type: application/json; charset=utf-8');
if ($fullinfo == "no") {
    echo json_encode($responseobject->data);
} else if($fullinfo == "yes") {
    echo json_encode($responseobject);
}
?>