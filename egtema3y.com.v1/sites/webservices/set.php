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

      $columns ="";
      $values ="";

     if($object == "chat.message")
{
  
       $roomid = isset($_GET['roomid']) ? $_GET['roomid'] : '';
       $key = isset($_GET['key']) ? $_GET['key'] : '';
       $message = isset($_GET['msg']) ? $_GET['msg'] : '';
       $fromid = isset($_GET['fromid']) ? $_GET['fromid'] : '';
       $fromname = isset($_GET['fromname']) ? $_GET['fromname'] : '';
       $faceid = isset($_GET['faceid']) ? $_GET['faceid'] : '';

       if($fromid == NULL || $fromid == "undefined")
       {
           $fromid = 0;
       }
       $columns = " `roomid`, `fromid`, `fromname`, `faceid`, `message`";
       $values = "$roomid,$fromid,'$fromname','$faceid','$message'";

}


try {

    $sql = "INSERT INTO {$databasename}.{$tablename}($columns) VALUES ($values)";
   
     $rows=array();
   
    $result = mysql_query($sql,$con);
 $responseobject->messages[] = "send succeed ...";
    
    mysql_close($con);
} catch (Exception $ex) {
    $responseobject->errors[] = $ex->getMessage();
     mysql_close($con);
}
 

$responseobject->timeexcuted = include("shared/end.php");;
header('Content-type: application/json; charset=utf-8');
    echo json_encode($responseobject);

?>