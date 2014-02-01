<?php

function getSiteOnline() {
    return FALSE;
}

function isDeveloperMode() {
    return TRUE;
}

if (getSiteOnline()) {
    define('DB_SERVER', 'localhost');
    define('DB_USER', 'egypt');
    define('DB_PASSWORD', '32733273');
    define('DB_NAME', 'chat');
} else {
    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'chat');
}
?>