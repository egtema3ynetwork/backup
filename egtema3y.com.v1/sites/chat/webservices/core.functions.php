<?php

require 'core.defines.php';

function getuserip() {
    $ipaddress = '';

    if ($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

function BlockSQL($str) {
    if ($str == null) {
        return null;
    }

    $str = mysql_real_escape_string($str); //Escapes special characters in a string for use in an SQL statement
    $str = htmlspecialchars($str); // will convert special chars like < to &lt;
    $str = strip_tags($str); //  strip all tags out.
    return $str;
}

function n2s($number) {
    $hexvalues = array('0', '1', '2', '3', '4', '5', '6', '7',
        '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', /* 'G', 'H', 'I', 'J', 'K',
              'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S' . 'T', 'U', 'V',  'W', 'X', 'Y', 'Z' */);
    $hexval = '';
    while ($number != '0') {
        $hexval = $hexvalues[bcmod($number, '16')] . $hexval;
        $number = bcdiv($number, '16', 0);
    }
    return $hexval;
}

function s2n($number) {
    $decvalues = array('0' => '0', '1' => '1', '2' => '2',
        '3' => '3', '4' => '4', '5' => '5',
        '6' => '6', '7' => '7', '8' => '8',
        '9' => '9', 'a' => '10', 'b' => '11',
        'c' => '12', 'd' => '13', 'e' => '14',
        'f' => '15', /* 'G' => '16', 'H' => '17',
              'I' => '18', 'J' => '19', 'K' => '20',
              'L' => '21', 'M' => '22', 'N' => '23',
              'O' => '24', 'P' => '25', 'Q' => '26',
              'R' => '27', 'S' => '28', 'T' => '29',
              'U' => '30', 'V' => '31',  'W' => '32',
              'X' => '33', 'Y' => '34', 'Z' => '35' */);
    $decval = '0';
    $number = strrev($number);
    for ($i = 0; $i < strlen($number); $i++) {
        $decval = bcadd(bcmul(bcpow('16', $i, 0), $decvalues[$number{$i}]), $decval);
    }
    return (int) $decval;
}

function getcurrentpath() {
    $curPageURL = "";
    //if ($_SERVER["HTTPS"] != "on")
    $curPageURL .= "http://";
    //else
    //    $curPageURL .= "https://" ;
    //if ($_SERVER["SERVER_PORT"] == "80")
    $curPageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    //else
    //    $curPageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    $count = strlen(basename($curPageURL));
    $path = substr($curPageURL, 0, -$count);
    return $path;
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

function getJsonValue($object, $key) {
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

function getWebServicesUrl() {
    if (getSiteOnline()) {
        return "http://arabicchat.us/webservices";
    } else {
        return "http://localhost/chat/webservices";
    }
}

function getSiteUrl() {
    if (getSiteOnline()) {
        return "http://arabicchat.us";
    } else {
        return "http://localhost/chat/";
    }
}

?>
