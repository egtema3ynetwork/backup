<!DOCTYPE >
<?php
	require_once './webservices/core.php';
?>
<html>
	<head>

		<?php
			include_once ("./server/meta.php");

			include_once ("./server/css.php");
			include_once ("./server/hash.php");
			include_once ("./webservices/site.data.php");
		?>

		<script type="text/javascript">
			var __SITEDATA  = JSON.parse( unhash('<?php echo get_all_site_data(); ?>'));
		</script>
	</head>

	<body  >

		<div id="body_content" align="center">
			<img src='./client/images/load.gif' alt='loading...' />
		</div>

		<?php
			include_once ("./server/js.php");
		
			include_once ("./server/templates.php");
		?>
		<script>
			$(function()
			{
				__.data = __SITEDATA;
				__.trigger('site/data');
			});

		</script>
	</body>
</html>