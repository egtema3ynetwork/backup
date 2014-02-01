<?php

require ('../global/database.php');

define('GET_ACCESSTOKEN', '362076570512100|SqcPV6yIBq6eVZr54SCoqJ6pQDc'); //https://graph.facebook.com/oauth/access_token?client_id=362076570512100&client_secret=7f35789bb5b287e0dfd3c5b468966ee8&grant_type=client_credentials

$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
$link = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);



$fullinfo = isset($_GET['_fullinfo']) ? $_GET['_fullinfo'] : 'no';
$object = isset($_GET['object']) ? $_GET['object'] : ' setting ';
$scope = isset($_GET['scope']) ? $_GET['scope'] : " * ";
$maxrownum = isset($_GET['limit']) ? $_GET['limit'] : VIEW_FEED_LIMIT;
$startfromrow = isset($_GET['start']) ? $_GET['start'] : "0";
$limit = " limit " . $startfromrow . "," . $maxrownum . " ";


if ($object == "facebook") {
    $tablename = TABLE_NAME_FACEBOOKFEED;
    $databasename = DB_NAME_FACEBOOK;
    $where = "";
} else if ($object == "facebookuser") {
    $tablename = TABLE_NAME_FACEBOOKUSER;
    $databasename = DB_NAME_FACEBOOK;
    $where = "";
} else if ($object == "facebooktags") {
    $tablename = TABLE_NAME_FACEBOOKTAGS;
    $databasename = DB_NAME_FACEBOOK;
    $where = "";
} else if ($object == "twitter") {
    $tablename = TABLE_NAME_TWITTERFEED;
    $databasename = DB_NAME_TWITTER;
    $where = "";
} else if ($object == "twitteruser") {
    $tablename = TABLE_NAME_TWITTERUSER;
    $databasename = DB_NAME_TWITTER;
    $where = "";
} else if ($object == "twittertags") {
    $tablename = TABLE_NAME_TWITTERTAGS;
    $databasename = DB_NAME_TWITTER;
    $where = "";
} else if ($object == "youtube") {
    $tablename = TABLE_NAME_YOUTUBEFEED;
    $databasename = DB_NAME_YOUTUBE;
    $where = "";
} else if ($object == "youtubeuser") {
    $tablename = TABLE_NAME_YOUTUBEUSER;
    $databasename = DB_NAME_YOUTUBE;
    $where = "";
} else if ($object == "youtubetags") {
    $tablename = TABLE_NAME_YOUTUBETAGS;
    $databasename = DB_NAME_YOUTUBE;
    $where = "";
} else if ($object == "facebookloginuser") {
    $tablename = 'facebookloginuser';
    $databasename = DB_NAME_EGTEMA3Y;
    $where = "";
    if (isset($_GET['guid'])) {
        $where .= " and `accesstoken`='{$_GET['guid']}' ";
    }
} else if ($object == "egtema3y") {
    $tablename = "wallfeed";
    $databasename = DB_NAME_EGTEMA3Y;
    $where = "";
} else if ($object == "user") {
    $tablename = "user";
    $databasename = DB_NAME_EGTEMA3Y;
    $where = "";
    if (isset($_GET['useremail']) && $_GET['useremail'] != "" && isset($_GET['userpassword']) && $_GET['userpassword'] != "") {
        $where .= " and `useremail`='{$_GET['useremail']}' and `userpassword` = '{$_GET['userpassword']}'";
    } else {
        $where .= " and `useremail` = 'absunstar' ";
    }
} else if ($object == "chatroomuser") {
    $tablename = "room";
    $databasename = "chat";
    $where = "";
} else if ($object == "chating") {
    $tablename = "room_messages";
    $databasename = "chat";
    $where = "";
    $scope .= " ,TIMESTAMPDIFF(SECOND,time,CURRENT_TIMESTAMP()) as timeago ";

    if (isset($_GET['tags']) && $_GET['tags'] != "") {
        $tablename .= $_GET['tags'];
    }

    if (isset($_GET['wallid'])) {
        $where .= " and `roomid`='{$_GET['wallid']}' ";
    }

    if (isset($_GET['minid'])) {
        $where .= " and `id` > '{$_GET['minid']}' ";
    }
} else {
    $tablename = $object;
    $databasename = DB_NAME_EGTEMA3Y;
    $where = "";
}

mysql_set_charset('utf8', $con);





if ($object === "facebookuser" || $object === "twitteruser" || $object === "youtubeuser") {

    $scope .= " ,TIMESTAMPDIFF(SECOND,time,CURRENT_TIMESTAMP()) as timeago ";
    if (isset($_GET['tags']) && $_GET['tags'] != "") {
        $where .= " and `tags` like '%{$_GET['tags']}%' ";
    }
}
// ---------------------------------------------------------------->

if ($object === "facebook") {

    $scope .= " ,TIMESTAMPDIFF(SECOND,time,CURRENT_TIMESTAMP()) as timeago ";

    if (isset($_GET['id']) && $_GET['id'] != "") {
        $where .= " and `id`='{$_GET['id']}' ";
    }

    if (isset($_GET['postid']) && $_GET['postid'] != "") {
        $where .= " and `postid` = '{$_GET['postid']}' ";
    }
    if (isset($_GET['wallid']) && $_GET['wallid'] != "") {
        $where .= " and `wallid` = '{$_GET['wallid']}' ";
    }
    if (isset($_GET['posttype']) && $_GET['posttype'] != "") {
        $where .= " and `posttype` like '%[{$_GET['posttype']}]%' ";
    }
    if (isset($_GET['maxid']) && $_GET['maxid'] != "") {
        $where .= " and `id` < {$_GET['maxid']} ";
    }
    if (isset($_GET['maxtime']) && $_GET['maxtime'] != "" & $_GET['maxtime'] != "undefined") {
        $where .= " and `time` <= '{$_GET['maxtime']}' ";
    }
    if (isset($_GET['search']) && $_GET['search'] != "") {
        $where .= " and `postmessage` like '%{$_GET['search']}%' ";
    }
    if (isset($_GET['tags']) && $_GET['tags'] != "" & $_GET['tags'] != "undefined") {
        $tablename = $tablename . $_GET['tags'];
    } else {
        if (isset($_GET['publicview']) && $_GET['publicview'] != "" & $_GET['publicview'] != "undefined") {
            $where .= " and `publicview` = {$_GET['publicview']}  ";
        } else {
            $where .= " and `publicview` = 1  ";
        }
    }
}
// ---------------------------------------------------------------->

if ($object === "twitter") {
    $scope .= " ,TIMESTAMPDIFF(SECOND,time,CURRENT_TIMESTAMP()) as timeago ";

    if (isset($_GET['id']) && $_GET['id'] != "") {
        $where .= " and `id`='{$_GET['id']}' ";
    }

    if (isset($_GET['postid']) && $_GET['postid'] != "") {
        $where .= " and `postid` like '{$_GET['postid']}' ";
    }
    if (isset($_GET['wallid']) && $_GET['wallid'] != "") {
        $where .= " and `wallid` like '{$_GET['wallid']}' ";
    }
    if (isset($_GET['posttype']) && $_GET['posttype'] != "") {
        $where .= " and `posttype` like '%[{$_GET['posttype']}]%' ";
    }
    if (isset($_GET['maxid']) && $_GET['maxid'] != "") {
        $where .= " and `id` < {$_GET['maxid']} ";
    }
    if (isset($_GET['maxtime']) && $_GET['maxtime'] != "" & $_GET['maxtime'] != "undefined") {
        $where .= " and `time` <= '{$_GET['maxtime']}' ";
    }
    if (isset($_GET['search']) && $_GET['search'] != "") {
        $where .= " and `postmessage` like '%{$_GET['search']}%' ";
    }
    if (isset($_GET['tags']) && $_GET['tags'] != "" & $_GET['tags'] != "undefined") {
        $tablename = $tablename . $_GET['tags'];
    } else {
        if (isset($_GET['publicview']) && $_GET['publicview'] != "" & $_GET['publicview'] != "undefined") {
            $where .= " and `publicview` = {$_GET['publicview']}  ";
        } else {
            $where .= " and `publicview` = 1  ";
        }
    }
}
// ---------------------------------------------------------------->

if ($object === "youtube") {
    $scope .= " ,TIMESTAMPDIFF(SECOND,time,CURRENT_TIMESTAMP()) as timeago ";

    if (isset($_GET['id']) && $_GET['id'] != "") {
        $where .= " and `id`='{$_GET['id']}' ";
    }

    if (isset($_GET['videoid']) && $_GET['videoid'] != "") {
        $where .= " and `videoid` like '{$_GET['videoid']}' ";
    }
    if (isset($_GET['channelname']) && $_GET['channelname'] != "") {
        $where .= " and `channelname` like '{$_GET['channelname']}' ";
    }
    if (isset($_GET['maxid']) && $_GET['maxid'] != "") {
        $where .= " and `id` < {$_GET['maxid']} ";
    }
    if (isset($_GET['maxtime']) && $_GET['maxtime'] != "" & $_GET['maxtime'] != "undefined") {
        $where .= " and `time` <= '{$_GET['maxtime']}' ";
    }
    if (isset($_GET['search']) && $_GET['search'] != "") {
        $where .= " and `title` like '%{$_GET['search']}%' ";
    }
    if (isset($_GET['tags']) && $_GET['tags'] != "" & $_GET['tags'] != "undefined") {
        $tablename = $tablename . $_GET['tags'];
    } else {
        if (isset($_GET['publicview']) && $_GET['publicview'] != "" & $_GET['publicview'] != "undefined") {
            $where .= " and `publicview` = {$_GET['publicview']}  ";
        } else {
            $where .= " and `publicview` = 1  ";
        }
    }
}

// ---------------------------------------------------------------->






function BlockSQL($str) {
    if ($str == null) {
        return null;
    }

    $str = mysql_real_escape_string($str); //Escapes special characters in a string for use in an SQL statement
    $str = htmlspecialchars($str); // will convert special chars like < to &lt;
    $str = strip_tags($str); //  strip all tags out.
    return $str;
}

// ---------------------------------------------------------------->

function _nullify($object, $key) {
    try {
        if ($object == NULL)
            return NULL;
        if ($key == NULL)
            return NULL;

        if (property_exists($object, $key))
            return empty($object->$key) ? NULL : $object->$key;
        else
            return NULL;
    } catch (Exception $ex) {
        return NULL;
    }
}

// ---------------------------------------------------------------->

class ResponseClass {

    public $timeexcuted;
    public $maxtime;
    public $mintime;
    public $count;
    public $count2;
    public $errors;
    public $firstid;
    public $lastid;
    public $serviceurl;
    public $timestamp;
    public $data;
    public $notes;

    public function __construct() {

    }

}

// ---------------------------------------------------------------->

$responseobject = new ResponseClass();
$responseobject->count = 0;
$responseobject->count2 = 0;
$responseobject->data = array();

function LoadJsonFromFacebook($url) {
    try {

        global $responseobject;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: graph.facebook.com'));
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    } catch (Exception $ex) {
        $responseobject->errors = $ex;
        return null;
    }
}

// ---------------------------------------------------------------->

function LoadJsonFromTwitter($url) {
    try {

        global $responseobject;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: graph.facebook.com'));
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    } catch (Exception $ex) {
        $responseobject->errors = $ex;
        return null;
    }
}

// ---------------------------------------------------------------->

function LoadJsonFromYoutube($url) {
    try {

        global $responseobject;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: graph.facebook.com'));
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    } catch (Exception $ex) {
        $responseobject->errors = $ex;
        return null;
    }
}

// ---------------------------------------------------------------->


function LoadJson($url) {
    try {

        global $responseobject;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: graph.facebook.com'));
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    } catch (Exception $ex) {
        $responseobject->errors = $ex;
        return null;
    }
}

// ---------------------------------------------------------------->

function spy($data) {
    return base64_encode($data);
}

function unspy($data) {
    try {
        return base64_decode($data);
    } catch (Exception $ex) {
        return "";
    }
}

?>