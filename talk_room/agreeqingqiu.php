<?php
	
	require_once 'outside.php';
	include './config/dbconfig.php';
	header("Content-type:text/html; charset=utf-8");
	checkUserValidate();
	
	$id = $_GET['id'];
	$f_nickname = $_GET['f_nickname'];
	
	$nickname = $_SESSION['nickname'];//如果不是自己加自己则进行这步
	
	if($f_nickname!=$nickname){
		$sql = "update friend set fzt=1 where id='{$id}';";//同意添加
		$res = mysql_query($sql,$conn);//并将对方加为好友
		
		$sql = "insert into friend (nickname,f_nickname,fzt) value ('{$nickname}','{$f_nickname}','1');";
		$res = mysql_query($sql,$conn);
		if($res){
			echo "<script type='text/javascript'> alert('操作成功'); location.href='qingqiu.php'; </script>";
			exit();
		}else{
			echo "<script type='text/javascript'> alert('操作失败'); location.href='qingqiu.php'; </script>";
			exit();
		}
	}else{
		echo "<script type='text/javascript'> alert('不能添加自己为好友'); location.href='qingqiu.php'; </script>";
		exit();
	}
	

?>
