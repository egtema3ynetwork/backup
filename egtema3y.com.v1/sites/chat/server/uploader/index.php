<?php
/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');




class CustomUploadHandler extends UploadHandler {
    protected function get_user_id() {
    	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"]: "0";
              return $id;
    }
}

$upload_handler = new CustomUploadHandler(array(
    'user_dirs' => true
));
