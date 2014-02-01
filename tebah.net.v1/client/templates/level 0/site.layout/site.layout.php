<script>
$(function(){
	__.tmp.site_layout_div_tmp = unhash('<?php echo spy( file_get_contents( dirname(__FILE__)."/$htmldir/site.layout.html")); ?>');
});
</script>

<script id="site_layout_div_tmp" type="text/x-jquery-tmpl">
<?php include(dirname(__FILE__)."/$htmldir/site.layout.html"); ?>
</script>
