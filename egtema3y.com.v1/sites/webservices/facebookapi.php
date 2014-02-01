<?php

require 'shared/facebook.php';

define('GET_ACCESSTOKEN', 'CAAIklSTPmp4BANAZBQ8wgtOgnc74lwXgx5li1zuOjEXOJIDHxmJv2UvLLzfSVoKKpIJFLiLy1mTIi48EgVMfBByyCR1U4N3SxbGKwYGUaKxbS2Uz3pWy7eBco39Xndd1hr1ZB5PVbFFvSEvK0Pjv3CZCsnmIBwfN9lzjZB05v7g4FEq8jXIBdMRIZCcgY0DsZD');
$need= isset($_REQUEST['need']) ? $_REQUEST['need'] : '';
$objectid = isset($_REQUEST['objectid']) ? $_REQUEST['objectid'] : '';
$accesstoken = isset($_REQUEST['accesstoken']) ? $_REQUEST['accesstoken'] : GET_ACCESSTOKEN;
$facebook->setAccessToken($accesstoken);


$outdata->messages = array();

function _nullify($object, $key) {
    try
    {
        if($object == NULL)return NULL;
        if($key == NULL)return NULL;

        if (property_exists($object, $key))
            return empty($object->$key) ? NULL : $object->$key;
        else
            return NULL;
    }
    catch(Exception $ex)
    {
		return NULL;
    }
}

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
    }
    catch (Exception $ex) {
        $responseobject->errors = $ex;
        return null;
    }
}


function GetObjectInfo()
{
    global $outdata;
    global $objectid;
    
    $data = LoadJsonFromFacebook("https://graph.facebook.com/" . $objectid . "?access_token=" .GET_ACCESSTOKEN );

    $decoded = json_decode($data);
    if ($decoded != null)                       
    {
        $outdata->pageid =   _nullify($decoded, 'id');
        $outdata->pageusername =  _nullify($decoded, 'username');
        $outdata->pagename =  _nullify($decoded, 'name');
        $outdata->wallimageurl =  "https://graph.facebook.com/".$objectid."/picture?type=square";
        //$wallcoverurl = $decoded->cover->source;
    }

}


function GetObjectPosts()
{
    global $outdata;
    global $objectid;
    global $accesstoken;
    
    $fql_query_url = 'https://graph.facebook.com/'
     . "fql?q=SELECT+post_id,message+FROM+stream+WHERE+filter_key='owner'+and+source_id=$objectid+order+by+created_time+DESC+LIMIT+10"
     . '&access_token=' . $accesstoken;
    $fql_query_result = LoadJsonFromFacebook($fql_query_url);
    $outdata->result = json_decode($fql_query_result, true);
  

    
}


if($need == "objectinfo")
{
    GetObjectInfo();
}

if($need == "objectposts")
{
    GetObjectPosts();
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($outdata);
die();


?>