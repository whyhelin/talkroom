<?php
	
	$DBHOST     = "localhost";
	$DBUSER     = "root";
	$DBPASSWORD = "root";
	$DBNAME     = "talkroom";


	$conn = mysql_connect($DBHOST,$DBUSER,$DBPASSWORD) or die("连接失败".mysql_error());				//1. 获取连接
	mysql_select_db($DBNAME);																			//2. 选择数据库
	mysql_query("set names utf8");																		//3. 设置操作编码(建议有)!!!
										

?>