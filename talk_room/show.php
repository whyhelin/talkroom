<?php

	require_once 'outside.php';
	include './config/dbconfig.php';
	header("Content-type:text/html; charset=utf-8");
	checkUserValidate();

	$geter  = $_SESSION['nickname'];
	$sender = $_GET['f_nickname'];
	
	//echo $sender;
	
	$maxID  = 0;
	$sql1   = "select max(id) from message where mloop=0 and (sender='{$sender}' or sender='{$geter}') and (geter='{$geter}' or geter='{$sender}')";
	$res1   = mysql_query($sql1,$conn);								//$res 表示结果集	
	while($row1=mysql_fetch_array($res1)){
		$maxID = $row1[0]-5;								
	}
	//echo $maxID;
	if(!empty($_GET['maxID'])){
		$maxID = $_GET['maxID'];
	}

	$sql = "select * from message where id>'$maxID' and (sender='{$sender}' or sender='{$geter}') and (geter='{$geter}' or geter='{$sender}') ";
	$res   = mysql_query($sql,$conn);									//$res 表示结果集	
	$info  = array();
	while($row=mysql_fetch_assoc($res)){
		$info[] = $row;
		$sql2 = "update message set mloop=1 where id>'$maxID' and sender='{$sender}' and geter='{$geter}' ";
		mysql_query($sql2,$conn);						
	}
	$jn_info = json_encode($info);
	echo $jn_info;

	mysql_free_result($res);										//释放资源,关闭连接(必须)
	mysql_close($conn);												//这句话可以没有，建议有.

?>