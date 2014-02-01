<?php
    
     require "core.php";
   
     $responseobject ;
     $responseobject->serviceName = "set";
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

     if($object == "site.user")
{
  
    $user_name = isset($_REQUEST['user_name']) ? unspy( $_REQUEST['user_name']) : '';
    $user_password = isset($_REQUEST['user_password']) ?unspy( $_REQUEST['user_password'] ): '';
    $user_email = isset($_REQUEST['user_email']) ?unspy( $_REQUEST['user_email'] ): '';
    $user_level = isset($_REQUEST['user_level']) ? unspy($_REQUEST['user_level'] ): '';
    $user_phone = isset($_REQUEST['user_phone']) ?unspy( $_REQUEST['user_phone'] ): '';
    $user_mobile1 = isset($_REQUEST['user_mobile1']) ?unspy( $_REQUEST['user_mobile1'] ): '';
    $user_mobile2 = isset($_REQUEST['user_mobile2']) ? unspy($_REQUEST['user_mobile2'] ): '';
    $user_nationalid = isset($_REQUEST['user_nationalid']) ?unspy( $_REQUEST['user_nationalid']) : '';
    $user_city = isset($_REQUEST['user_city']) ? unspy($_REQUEST['user_city'] ): '';
    $user_address = isset($_REQUEST['user_address']) ?unspy( $_REQUEST['user_address']) : '';
    $user_notes = isset($_REQUEST['user_notes']) ? unspy($_REQUEST['user_notes']) : '';

  
    
       $columns = " `user_name`, `user_password`, `user_email`, `user_level`, `user_phone`, `user_mobile1`, `user_mobile2`, `user_nationalid`, `user_city`, `user_address`, `user_notes`";
       $values = "'$user_name','$user_password','$user_email','$user_level','$user_phone','$user_mobile1','$user_mobile2','$user_nationalid','$user_city','$user_address','$user_notes'";

     // $responseobject->messages[] = $databasename;
    // $responseobject->messages[] = $tablename;
     // $responseobject->messages[] = $columns;
     // $responseobject->messages[] = $values;
     }


try {
   

        $sql = "INSERT INTO {$databasename}.{$tablename}($columns) VALUES ($values)";
     
        $result = mysql_query($sql,$con);
        if($result)
        {
            $responseobject->messages[] = "succeed";
        }
        else
        {
            $responseobject->messages[] = "error";
        }
        mysql_close($con);
        
        $responseobject->errors[] =  mysql_error();
           
} catch (Exception $ex) {
    $responseobject->messages = array();
    $responseobject->errors[] = "error";
    $responseobject->errors[] = $ex->getMessage();
     mysql_close($con);
}
 


header('Content-type: application/json; charset=utf-8');
    echo json_encode($responseobject);

?>