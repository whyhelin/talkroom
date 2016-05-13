<?php
	
	require_once 'outside.php';
	include './config/dbconfig.php';
	header("Content-type:text/html; charset=utf-8");
	checkUserValidate();
	
	$nickname = $_SESSION['nickname'];
	$f_nickname = $_GET['f_nickname'];

	
	//判断是该用户id是否存在
	$sql = "select id from user where nickname='{$f_nickname}';";
	$res = mysql_query($sql,$conn);
	if(mysql_num_rows($res)<1){
		echo "<script type='text/javascript'> alert('不存在该用户'); location.href='addfriend.php'; </script>";
		exit();
	}
	
	//判断是否已经加过该好友
	$sql = "select fzt from friend where f_nickname='{$f_nickname}' and nickname='{$nickname}';";
	$res = mysql_query($sql,$conn);
	$row = mysql_fetch_assoc($res);
	if($row['fzt'] == 1){
		echo "<script type='text/javascript'> alert('您已经添加了该好友'); location.href='addfriend.php'; </script>";
		exit();
	}

	$sql = "select * from friend where f_nickname='{$f_nickname}' and nickname='{$nickname}';";
	$res = mysql_query($sql,$conn);
	$row = mysql_fetch_assoc($res);
	if($row['fzt'] == 0 && $row['f_nickname'] == $f_nickname){
		echo "<script type='text/javascript'> alert('您已经发出了该好友的添加请求'); location.href='addfriend.php'; </script>";
		exit();
	}
	
	$nickname = $_SESSION['nickname'];//如果不是自己加自己则进行这步
	
	if($f_nickname!=$nickname){
		
		$sql = "insert into friend (nickname,f_nickname,fzt) value ('{$nickname}','{$f_nickname}',0);";
		$res = mysql_query($sql,$conn);
		if($res){
			echo "<script type='text/javascript'> alert('好友请求发送成功，请等待对方确认'); location.href='addfriend.php'; </script>";
			exit();
		}else{
			echo "<script type='text/javascript'> alert('好友请求发送成功失败'); location.href='addfriend.php'; </script>";
			exit();
		}
	}else{
		echo "<script type='text/javascript'> alert('不能添加自己为好友'); location.href='addfriend.php'; </script>";
		exit();
	}

?>
