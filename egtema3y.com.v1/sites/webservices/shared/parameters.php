<?php


  //---------------------------------------> Parameters
     $scope = isset($_GET['scope']) ? $_GET['scope'] : " * ";
     $object = isset($_GET['object']) ? $_GET['object'] : ' setting ';
     $tablename = isset($_GET['tablename']) ? $_GET['tablename'] : '';
     $databasename = isset($_GET['databasename']) ? $_GET['databasename'] : '';

     $limit = isset($_GET['limit']) ? $_GET['limit'] : "30";
     $start = isset($_GET['start']) ? $_GET['start'] : "0" ;
     $limit = " LIMIT ".$start.",".$limit." ";

     $where = "";
     $sort = isset($_GET['sort']) ? " ORDER BY {$_GET['sort']}" : "";

     $all = isset($_GET['all']) ? $_GET['all'] : '0';
     $appid = isset($_GET['appid']) ? $_GET['appid'] : '';
     $appaccesstoken = isset($_GET['appaccesstoken']) ? $_GET['appaccesstoken'] : '';
     //---------------------------------------End Parameters







     
     //-------------------------------------- Database & Table

     if($object == "facebooky")
{
    $tablename = "facebooky_users";
    $databasename = "apps";
    $appid = '603172939733662';
    $appaccesstoken = '603172939733662|vt-x4dxtKu3LEjEvP82BT4tNgME';
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

       $accesstoken = isset($_GET['accesstoken']) ? $_GET['accesstoken'] : '';
       if($accesstoken != "")
       {
           $where .= " and accesstoken='".$accesstoken."' ";
       }

}


     if($object == "chat.message")
{
  
       $roomid = isset($_GET['roomid']) ? $_GET['roomid'] : '';
       $key = isset($_GET['key']) ? $_GET['key'] : '';
       $lastmessageid = isset($_GET['lastmessageid']) ? $_GET['lastmessageid'] : '';

       if($roomid != "" && $key !="")
       {
             $key =  base64_decode($key);
             $tablename = "chat_message";
             $databasename = "chat";
          
           $where .= " AND ID > $lastmessageid AND roomid in ( SELECT id from chat.chat_room WHERE id=$roomid AND password ='$key') ";
           $sort = " order by id desc ";
       }

}

 if($object == "chat.room")
{
    $tablename = "chat_room";
    $databasename = "chat";
    $appid = '144172049118162';
    $appsecret = "57b6c918a643f733ba020ddb57fc80f8";
    $appaccesstoken = '144172049118162|cgMO54cFduA6humhMM3QegaoXZY';

       

}

     // ------------------------------------- End Database & Tables





?>
