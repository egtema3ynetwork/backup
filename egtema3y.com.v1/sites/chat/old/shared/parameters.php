<?php


  //---------------------------------------> Parameters
     $scope = isset($_GET['scope']) ? $_GET['scope'] : " * ";
     $object = isset($_GET['object']) ? $_GET['object'] : ' setting ';
       $tablename = isset($_GET['tablename']) ? $_GET['tablename'] : '';
       $databasename = isset($_GET['databasename']) ? $_GET['databasename'] : '';

     $maxrownum = isset($_GET['limit']) ? $_GET['limit'] : "30";
     $startfromrow = isset($_GET['start']) ? $_GET['start'] : "0" ;
     $limit = " limit ".$startfromrow.",".$maxrownum." ";

     $where = "";

     $fullinfo = isset($_GET['_fullinfo']) ? $_GET['_fullinfo'] : 'no';
     $appid = isset($_GET['appid']) ? $_GET['appid'] : '';
      $appaccesstoken = isset($_GET['appaccesstoken']) ? $_GET['appaccesstoken'] : '';
     //---------------------------------------End Parameters







     
     //-------------------------------------- Database & Table

     if($object == "facebooky")
{
    $tablename = "facebooky_users";
    $databasename = "apps";
    $appid = '555334907846944';
    $appaccesstoken = '555334907846944|g43hVmwWLxqawGBNkgfEzde7cpU';
}

     if($object == "facebookloginuser")
{
    $tablename = "facebookloginuser";
    $databasename = "egtema3y";
    $appid = '129108667268260';
    $appaccesstoken = '129108667268260|lP2hMIB6apXSiRaEpafw8nnA9Fk';
}

     if($object == "chat.user")
{
    $tablename = "chat_user";
    $databasename = "chat";
    $appid = '144172049118162';
    $appsecret = "57b6c918a643f733ba020ddb57fc80f8";
    $appaccesstoken = '144172049118162|cgMO54cFduA6humhMM3QegaoXZY';
}


     // ------------------------------------- End Database & Tables





?>
