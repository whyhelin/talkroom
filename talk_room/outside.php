<?php
	
	//include './config/dbconfig.php';
	
	function checkuser($nickname,$password){
		include './config/dbconfig.php';
		$sql="select password,nickname from user where nickname='$nickname'";
		$res=mysql_query($sql,$conn) or die(mysql_error());
		
		if($row=mysql_fetch_assoc($res)){
			if(md5($password)==$row['password']){
				return $row['nickname'];
				mysql_free_result($res);			
				mysql_close($conn);
				exit();
			}
		}
		return 0;
		mysql_free_result($res);
		mysql_close($conn);
	}


	function checkUserValidate(){
		session_start();
		//先写在封
		if(empty($_SESSION['nickname'])){
			header("Location: login.php?errno=1");
			exit();
		}
	}
	
	function getCookie($key){
		if(empty($_COOKIE[$key])){
			return "";
		}else{
			return $_COOKIE[$key];
		}
	}

		
	function getLastTime($id){	

		if(!empty($_COOKIE['lastvisit'])){
			echo "<h4>{$id}您上一次登陆时间:{$_COOKIE['lastvisit']}</h4>";
		}else{
			echo "<h4>欢迎{$id}登陆</h4>";
		}
	}


	function isFriend(){
		//session_start();
		include './config/dbconfig.php';

		if(empty($_SESSION['nickname'])){
			header("Location:login.php");
			exit();
		}else{
			$nickname = $_SESSION['nickname'];
			$sql = "select id from friend where f_nickname='{$nickname}' and fzt='0';";//判断是否有好友请求
			$res = mysql_query($sql,$conn);
			$fnum = mysql_num_rows($res);
			if($fnum>0){
				return $fnum;
			}else{
				return 0;
			}
			mysql_free_result($res);	
		}
	}


	function isMessage($f_nickname){
		//session_start();
		include './config/dbconfig.php';

		if(empty($_SESSION['nickname'])){
			header("Location:login.php");
			exit();
		}else{
			$nickname = $_SESSION['nickname'];
			$sql = "select id from message where sender='{$f_nickname}' and geter='{$nickname}' and mloop=0;";
			$res = mysql_query($sql,$conn);
			$fnum = mysql_num_rows($res);
			if($fnum>0){
				return $fnum;
			}else{
				return 0;
			}
			mysql_free_result($res);	
		}
	}

?>