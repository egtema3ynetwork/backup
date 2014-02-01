<?php
	if($method=="all"&&$object=="site.role")
	{
		$tablename="site_role";
		$databasename=DB_NAME;
		$condition="";
		$sql="select * from $databasename.$tablename where 1 ".$condition." order by `order`  limit 100 ";
		$outdata=runQuery($sql);
		$rows;
		foreach($outdata->data as $row)
		{
			$row['text']=$row['name'];
			$row['value']=$row['id'];
			$rows[]=$row;
		}
		$outdata->data=$rows;
	}
?>