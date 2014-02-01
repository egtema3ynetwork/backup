<?php

function getcurrentpath(){
    $curPageURL = "";
    //if ($_SERVER["HTTPS"] != "on")
        $curPageURL .= "http://";
    //else
    //    $curPageURL .= "https://" ;
    //if ($_SERVER["SERVER_PORT"] == "80")
        $curPageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    //else
    //    $curPageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    $count = strlen(basename($curPageURL));
    $path = substr($curPageURL,0, -$count);
    return $path ;
}

 function LoadPhp($url) {
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



?>
