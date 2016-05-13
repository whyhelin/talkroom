<?php
	
	require_once 'outside.php';
	include './config/dbconfig.php';
	header("Content-type:text/html; charset=utf-8");
	checkUserValidate();
		
	$id = $_GET['id'];

	$sql = "delete from friend where id='{$id}';";
	$res = mysql_query($sql,$conn);
	if($res){
		echo "<script type='text/javascript'> alert('已拒绝'); location.href='qingqiu.php'; </script>";
		exit();
	}

?>
