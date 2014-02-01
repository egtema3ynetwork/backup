<?php

require "core.php";

$responseobject;
$responseobject->serviceName = "get";
$responseobject->objectName = $object;
$responseobject->count = 0;
$responseobject->data = array();
$responseobject->errors = array();
$responseobject->messages = array();
$responseobject->lastmessageid = 0;
$responseobject->timeexcuted = 0;



if ($object == "site.user") {
    $tablename = "tb_user";
    $databasename = "tebah";

    $useremail = isset($_GET['useremail']) ? $_GET['useremail'] : '';
    $userpassword = isset($_GET['userpassword']) ? $_GET['userpassword'] : '';

    $where .= " and user_email='$useremail' and user_password='$userpassword' ";
}

if ($object == "site.menu") {
    $tablename = "tb_menu";
    $databasename = "tebah";
    $parentid = isset($_GET['parentid']) ? $_GET['parentid'] : '0';
    $where = " and menu_parentid = $parentid ";
}



if ($tablename != "" && $databasename != "") {

    $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
    mysql_set_charset('utf8', $con);



    try {

        $sql = "SELECT {$scope} FROM {$databasename}.{$tablename}  where 1 ";
        $sql .= $where;
        $sql .= $sort;
        $sql .= $limit;

        $rows = array();
        $responseobject->messages[] = $sql;
        $result = mysql_query($sql, $con);
        if ($result != null) {
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            $responseobject->data = $rows;
            $responseobject->count = count($rows);
        }



        if (($object == "chat.message") && isset($rows) && count($rows) > 0) {

            $responseobject->count = count($rows);
            $responseobject->lastmessageid = $rows[0]['id'];
        }

        $responseobject->errors[] = mysql_error();
        mysql_close($con);
    } catch (Exception $ex) {
        $responseobject->errors[] = $ex->getMessage();
        mysql_close($con);
    }
}

header('Content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-store,no-cache, must-revalidate"); // HTTP/1.1


echo json_encode($responseobject);
?>