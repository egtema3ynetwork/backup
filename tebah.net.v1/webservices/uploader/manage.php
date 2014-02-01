<?php
$outdata -> files = array();
$outdata -> errors = array();

$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "0";
$outdata -> id = $id;


function ListFiles($dir, $exx) {

	try {

		if ($dh = opendir($dir)) {

			$files = Array();
			$inner_files = Array();

			while ($file = readdir($dh)) {
				if ($file != "." && $file != ".." && $file[0] != '.') {
					if (is_dir($dir . "/" . $file)) {
						
					} else {
						array_push($files, $file);

					}
				}
			}

			closedir($dh);
			sort($files);
			return $files;
		}
	} catch(Exception $ex) {
		$outdata -> errors[] = $ex -> getMessage();
	}
}


foreach (ListFiles('files/'.$id.'/', '*') as $key => $file) {
	$outdata -> files[] = $file;
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($outdata);
?>