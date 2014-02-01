<?php
	$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : "select";

	if ($method == "save")
	{
		$tablename = "site_menu";
		$databasename = DB_NAME;

		$id = BlockSQL(unspy($_REQUEST["id"]));
		$parent_id = BlockSQL(unspy($_REQUEST["parent_id"]));
		$menu_text = BlockSQL(unspy($_REQUEST["menu_text"]));
		$menu_text_ar = BlockSQL(unspy($_REQUEST["menu_text_ar"]));
		$menu_func = BlockSQL(unspy($_REQUEST["menu_func"]));
		$menu_css = BlockSQL(unspy($_REQUEST["menu_css"]));
		$menu_tooltip = BlockSQL(unspy($_REQUEST["menu_tooltip"]));
		$menu_tooltip_ar = BlockSQL(unspy($_REQUEST["menu_tooltip_ar"]));
		$menu_hint = BlockSQL(unspy($_REQUEST["menu_hint"]));

		$condition = " and id= '{$id}' ";
		$sql = "UPDATE $databasename.$tablename SET `id`='{$id}',`parent_id`='{$parent_id}',`menu_text`='{$menu_text}',`menu_text_ar`='{$menu_text_ar}' ,`menu_func`='{$menu_func}' ,`menu_css`='{$menu_css}' ,`menu_tooltip`='{$menu_tooltip}' ,`menu_tooltip_ar`='{$menu_tooltip_ar}',`menu_hint`='{$menu_hint}' WHERE 1 " . $condition . " ";
		$outdata = execQuery($sql);

	}
	
	
	if ($method == "add")
	{
		$tablename = "site_menu";
		$databasename = DB_NAME;

		$id = BlockSQL(unspy($_REQUEST["id"]));
		$parent_id = BlockSQL(unspy($_REQUEST["parent_id"]));
		$menu_text = BlockSQL(unspy($_REQUEST["menu_text"]));
		$menu_text_ar = BlockSQL(unspy($_REQUEST["menu_text_ar"]));
		$menu_func = BlockSQL(unspy($_REQUEST["menu_func"]));
		$menu_css = BlockSQL(unspy($_REQUEST["menu_css"]));
		$menu_tooltip = BlockSQL(unspy($_REQUEST["menu_tooltip"]));
		$menu_tooltip_ar = BlockSQL(unspy($_REQUEST["menu_tooltip_ar"]));
		$menu_hint = BlockSQL(unspy($_REQUEST["menu_hint"]));

		$id = execQuery("insert into $databasename.$tablename(parent_id) values(0) ")-> id;
		$condition = " and id= '{$id}' ";
		$sql = "UPDATE $databasename.$tablename SET `id`='{$id}',`parent_id`='{$parent_id}',`menu_text`='{$menu_text}',`menu_text_ar`='{$menu_text_ar}' ,`menu_func`='{$menu_func}' ,`menu_css`='{$menu_css}' ,`menu_tooltip`='{$menu_tooltip}' ,`menu_tooltip_ar`='{$menu_tooltip_ar}',`menu_hint`='{$menu_hint}' WHERE 1 " . $condition . " ";
		$outdata = execQuery($sql);

	}
	
	
?>