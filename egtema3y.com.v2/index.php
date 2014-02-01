<?php
require_once './server/site.setting.php';
function getuserip() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if (getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if (getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if (getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if (getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if (getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';

	return $ipaddress;
};

?>
<html>
	<head>

		<?php
	include ("./server/meta.php");
		?>
		<?php
			include ("./server/css.php");
		?>
	</head>

	<body  >
		<?php
		include ("./server/google.php");
		?>
		<div align="center" class="mustdelete">
			Loading ....
		</div>
		<input type="hidden" id="userrealip" value="<?php echo getuserip(); ?>" />
		<?php
			include ("./server/js.php");
		?>
		<?php
			include ("./server/templates.php");
		?>
	</body>
</html>