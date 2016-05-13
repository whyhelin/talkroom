<?php

	include './config/dbconfig.php';
	header("Content-type:text/html;charset=utf-8");
	
	if(!empty($_POST['nickname']) && !empty($_POST['password'])){
		$nickname = $_POST['nickname'];
		$password = $_POST['password'];
	}else{
		echo "<script type='text/javascript'> alert('信息不完整!'); history.back();</script>";
	}
	
	$sex      = $_POST['sex'];
	$yyyy     = $_POST['yyyy'];
	$mm       = $_POST['mm'];
	$dd       = $_POST['dd'];
	$birthday = $yyyy."-".$mm."-".$dd;
	$address  = $_POST['address'];
	$question = $_POST['question'];
	$answer   = $_POST['answer'];
	$age = intval(date("Y"))-intval($yyyy);

	
	$sql = "select * from user where nickname='$nickname'";
	$res = mysql_query($sql,$conn);
	$row = mysql_num_rows($res);
	
	if ($row >= 1){
		echo "<script type='text/javascript'> alert('该用户名已经被注册!'); history.back();</script>";
	}else if($row == 0){
		$sql2 = "insert into user (nickname,password,address,sex,age,birthday,reg_time,question,answer) values ('{$nickname}',md5($password),'{$address}','{$sex}','{$age}','{$birthday}',now(),'{$question}','{$answer}');";
		$res2 = mysql_query($sql2,$conn);
		
		if($res2){
			echo "恭喜！注册成功！！<p>马上<a href='login.php' target='_blank'>登陆</a></p>";
		}else{
			echo "<script type='text/javascript'> alert('对不起！注册失败！');history.back(); </script>";
		}
	}
	
	

?>
