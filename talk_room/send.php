<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<?php

	require_once 'outside.php';
	include './config/dbconfig.php';
	header("Content-type:text/html; charset=utf-8");
	checkUserValidate();

	//session_start();
	$sender = $_SESSION['nickname'];
	$geter  = $_GET['f_nickname'];
	//echo $geter;

	
	if(!empty($_POST['smooth']) && !empty($_POST['content'])){
		$smooth  = $_POST['smooth'];
		$content = $_POST['content'];
		$sql     = "insert into message (sender,geter,smooth,content,stime) values('{$sender}','{$geter}','{$smooth}','{$content}',now())";
		$res     = mysql_query($sql,$conn);						//如果是dml操作，则返回bool
		if(!$res){
			die("发送失败".$geter.mysql_error());	
		}

		if(mysql_affected_rows($conn)>0){
			echo "发送成功";
		}else{
			echo "发送失败";
		}	
	}else{
		echo '请输入内容';
	}

	mysql_close($conn);												//这句话可以没有，建议有.


?>
</head>
</html>