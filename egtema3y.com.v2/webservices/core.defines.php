<?php

function IsOnlineMode() {
    return TRUE;
}

function isDeveloperMode() {
    return TRUE;
}

if (IsOnlineMode()) {
    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '32733273');
    define('DB_NAME', 'egtema3y');
} else {
    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'egtema3y');
}
?>