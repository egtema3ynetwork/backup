<?php

$htmldir = "html";
$jsdir = "js";
$cssdir = "css";

function sanitize_output($buffer) {

    $search = array(
        "/\>[^\S ]+/s", // strip whitespaces after tags, except space
        "/[^\S ]+\</s", // strip whitespaces before tags, except space
        "/(\s)+/s"       // shorten multiple whitespace sequences
    );

    $replace = array(
        ">",
        "<",
        "\\1"
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}
function IsDeveloperMode() {
    return TRUE;
}
if (!IsDeveloperMode()) {
    ob_start("sanitize_output");
}



function IsOnlineMode() {
    return FALSE;
}
if (IsOnlineMode()) {
    define("DB_SERVER", "localhost");
    define("DB_USER", "egypt");
    define("DB_PASSWORD", "32733273");
    define("DB_NAME", "egtema3y");
} else {
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");
    define("DB_NAME", "egtema3y");
}
function IsDeomMode() {
    return false;
}

if (!IsDeomMode()) {
    $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
}
function IsMiniMode() {
    return FALSE;
}


function ListFiles($dir, $exx) {


    if ($dh = opendir($dir)) {

        $files = Array();
        $inner_files = Array();

        while ($file = readdir($dh)) {
            if ($file != "." && $file != ".." && $file[0] != '.') {
                if (is_dir($dir . "/" . $file)) {
                    $inner_files = ListFiles($dir . "/" . $file, $exx);
                    if (is_array($inner_files))
                        $files = array_merge($files, $inner_files);
                } else {
                    if (strtolower(substr($file, strrpos($file, '.') + 1)) == strtolower($exx)) {
                        array_push($files, $dir . "/" . $file);
                    }
                }
            }
        }

        closedir($dh);
        sort($files);
        return $files;
    }
}



?>
