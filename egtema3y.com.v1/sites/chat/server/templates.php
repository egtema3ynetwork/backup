<?php

require_once './server/site.setting.php';

foreach (ListFiles('./client/templates', 'php') as $key => $file) {
    include("$file");
}
?>
