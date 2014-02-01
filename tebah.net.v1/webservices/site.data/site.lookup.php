<?php


$outdata -> offer_view_list = array();

$outdata -> offer_view_list  = runQuery("select * from tebah.tebah_offer_view where 1")->data;


$outdata -> region_view_list = array();

$outdata -> region_view_list  = runQuery("select * from tebah.tebah_region_view where 1")->data;


$outdata -> central_view_list = array();

$outdata -> central_view_list  = runQuery("select * from tebah.tebah_central_view where 1")->data;


$outdata -> branch_view_list = array();

$outdata -> branch_view_list  = runQuery("select * from tebah.tebah_branch_view where 1")->data;


$outdata -> ip_count_view_list = array();

$outdata -> ip_count_view_list  = runQuery("select * from tebah.tebah_ip_count_view where 1")->data;



$outdata -> limit_view_list = array();

$outdata -> limit_view_list  = runQuery("select * from tebah.tebah_limit_view where 1")->data;



$outdata -> payment_type_view_list = array();

$outdata -> payment_type_view_list  = runQuery("select * from tebah.tebah_payment_type_view where 1")->data;


$outdata -> provider_view_list = array();

$outdata -> provider_view_list  = runQuery("select * from tebah.tebah_provider_view where 1")->data;



$outdata -> site_role_view_list = array();

$outdata -> site_role_view_list  = runQuery("select * from tebah.site_role_view where 1")->data;


$outdata -> speed_view_list = array();

$outdata -> speed_view_list  = runQuery("select * from tebah.tebah_speed_view where 1")->data;


$outdata -> reseller_view_list = array();

$outdata -> reseller_view_list  = runQuery("select * from tebah.site_member_reseller where 1")->data;



$outdata -> isp_view_list = array();

$outdata -> isp_view_list  = runQuery("select * from tebah.site_member_isp where 1")->data;



?>