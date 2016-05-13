<?php
	
	require_once 'outside.php';
	
	header("Content-Type: text/html; charset=utf-8");
	date_default_timezone_set('PRC'); 

	$nickname=$_POST['nickname'];
	$password=$_POST['password'];
	$checkcode=$_POST['checkcode'];
	$checkcode = strtolower($checkcode);
	//echo $checkcode;
	if(empty($_POST['save'])){	
			if(!empty($_COOKIE['nickname'])){
				setcookie("nickname","",time()-100);
				setcookie("password","",time()-100);
			}
	}else{
		setcookie("nickname",$nickname,time()+3600*24*30);
		setcookie("password",$password,time()+3600*24*30);
	}
	//setcookie("name",$nickname,time()+3600*24*30);
	//setcookie("lastvisit",date('Y-m-d H:i:s'),time()+3600*24*30);
	

	
	
	
//为什么我们需要验证码
//1.防止登录时，恶意攻击
//2.防止灌水.

	session_start();
	if($checkcode!=$_SESSION['checkcode']){
		header("Location:login.php?errno=2");
		exit();
	}



	$name = checkuser($nickname,$password);
	
	if($name){
		//把登陆信息写入cookie 'loginname':$name
			//把登陆表 把登陆的人ip id..
			//合法
			session_start();
			$_SESSION['nickname']=$name;
	
			setcookie("name",$nickname,time()+3600*24*30);
			setcookie("lastvisit",date('Y-m-d H:i:s'),time()+3600*24*30);
			header("Location:userview.php"); 
			exit();
	}else{
		header("location:login.php?errno=1");
	}
	
	
	


?>