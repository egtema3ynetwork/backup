<?php include("../content/start.php"); ?>

<html>
<head>
	<?php include("../content/meta.html"); ?>
        
	
	<link rel="stylesheet" type="text/css" href="../sdk/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../sdk/easyui/themes/icon.css">
	
        <style >
            .statusbar {
    border: thin solid #000000;
    padding: 1px;
    background-color: #333;
    position: fixed;
    height: 20px;
    right: 0px;
    left: 0px;
    z-index: 1000000000;
    display: block;
    bottom: 0px;
    color: #FFFFFF;
}
        </style>
        
	<script type="text/javascript" src="../sdk/easyui/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="../sdk/easyui/jquery.easyui.min.js"></script>
</head>
<body style="direction: ltr;">
	
   
        
        
	<div style="margin:10px 0;"></div>
	
        
        
	<table class="easyui-datagrid" title="wall type info" style="height:300;width:800"
			data-options="singleSelect:true,collapsible:true,url:'http://localhost/egtema3ynetwork/php/service/global/dataview-service.php?tablename=walltypeinfo&dataonly=yes'">
		<thead>
			<tr>
				<th data-options="field:'id'">ID</th>
				<th data-options="field:'wallname'">wall name</th>
				
			</tr>
		</thead>
	</table>
	
        <div style="margin:10px 0;"></div>
        
        <table class="easyui-datagrid" title="wall face info" style="height:300;width:800"
			data-options="singleSelect:true,collapsible:true,url:'http://localhost/egtema3ynetwork/php/service/global/dataview-service.php?tablename=wallfaceinfo&dataonly=yes'">
		<thead>
			<tr>
				<th data-options="field:'id'">ID</th>
				<th data-options="field:'wallid'">wall id</th>
				
			</tr>
		</thead>
	</table>
        
        <div style="margin:10px 0;"></div>
        
         <table class="easyui-datagrid" title="wall face info" style="height:300;width:800"
			data-options="rownumbers:true,pagination:true,singleSelect:true,collapsible:true,url:'http://localhost/egtema3ynetwork/php/service/global/dataview-service.php?tablename=wallfacefeed&dataonly=yes&limit=100'">
		<thead>
			<tr>
				<th data-options="field:'id'">ID</th>
				<th data-options="field:'wallname'">wall name</th>
				<th data-options="field:'message'">message</th>
			</tr>
		</thead>
	</table>
        
        
        
        
        
        
        <div class="row-fluid statusbar">
    <div id="statusinfodiv">
<?php include("../content/end.php"); ?>
</div>
</div>
        
        
</body>
</html>