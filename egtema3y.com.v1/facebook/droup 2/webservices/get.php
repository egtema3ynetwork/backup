<?php
    
     require "shared/start.php";
     require "shared/setting.php";
     require "shared/parameters.php";
   
     $responseobject->serviceName = "get";
     $responseobject->objectName = $object;
     $responseobject->count = 0;
     $responseobject->data = array();
     $responseobject->errors = array();
     $responseobject->messages = array();
     $responseobject->lastmessageid = 0;

     $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
     mysql_set_charset('utf8', $con);





try {

    $sql = "SELECT {$scope} FROM {$databasename}.{$tablename}  where 1 ";
    $sql .= $where;
    $sql .=  $sort;
    $sql .= $limit;

     $rows=array();
   $responseobject->messages[] = $sql ; 
       $result = mysql_query($sql,$con);
    if ($result != null) {
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        $responseobject->data = $rows;
        $responseobject->count = count($rows);
    }  
    
    

    if ( ($object == "chat.message") && isset($rows) && count($rows) > 0) {

        $responseobject->count = count($rows);
        $responseobject->lastmessageid = $rows[0]['id'];
    }

    $responseobject->errors[] = mysql_error();
    mysql_close($con);
} catch (Exception $ex) {
    $responseobject->errors[] = $ex->getMessage();
     mysql_close($con);
}
 

$responseobject->timeexcuted = include("shared/end.php");;
header('Content-type: application/json; charset=utf-8');
    echo json_encode($responseobject);

?>