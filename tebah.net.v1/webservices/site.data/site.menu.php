<?php


$outdata -> site_menu_list = array();

$outdata -> site_menu_list  = runQuery("select * from tebah.site_menu where 1")->data;




?>