<?php

	require_once 'outside.php';
	include './config/dbconfig.php';
	header("Content-type:text/html; charset=utf-8");
	checkUserValidate();
	
	$f_nickname = $_GET['f_nickname'];
	$sql = "delete from friend where nickname='".$_SESSION['nickname']."' and f_nickname='{$f_nickname}'";
	if(mysql_query($sql,$conn)){
		echo "<script type='text/javascript'> alert('删除成功'); location.href='queryFriend.php'; </script>";	
	}else{
		echo "<script type='text/javascript'> alert('删除失败'); location.href='queryFriend.php'; </script>";
	}
	

?>
