<?php


	function list_auto_js_files($dir , $exx)
	{
		if ($dir == null)
		{
			$dir = "./client/templates";
		}
		if ($exx == null)
		{
			$exx = "auto.js";
		}
		

		if ($dh = opendir($dir))
		{
			$files = Array();
			$inner_files = Array();
			while ($file = readdir($dh))
			{
				if ($file != "." && $file != ".." && $file[0] != '.')
				{
					if (is_dir($dir . "/" . $file))
					{
						$inner_files = list_auto_js_files($dir . "/" . $file , $exx);
						if (is_array($inner_files))
							$files = array_merge($files, $inner_files);
					}
					else
					{

						if (strtolower(substr($file, strrpos($file, '.') - 4)) == strtolower($exx))
						{
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

	function get_php_templates()
	{
		return ListFiles('./client/templates', 'php');
	}

	function get_js_template()
	{
		return list_auto_js_files(null , null);
		return ListFiles('./client/templates', 'js');
	}

	foreach (get_php_templates() as $key => $file)
	{
		include ("$file");
	}
?>

<?php foreach (get_js_template() as $key => $file) {
?>

<script><?php
	include ("$file");
 ?></script>
<?php } ?>

