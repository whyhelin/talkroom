<?php
	
	header("Content-type:text/html;charset=utf-8");
	include './config/dbconfig.php';

	$nickname = '';
	if(!empty($_GET['nickname'])){
		$nickname = $_GET['nickname'];
		
		$sql = "select * from user where nickname='$nickname'";
		$res = mysql_query($sql,$conn);
		$row = mysql_num_rows($res);
		//$row = mysql_affected_rows($res);
		
		if ($row >= 1){
			echo '<font color=red>该用户名已经被注册！</font>';
		}else{
			echo '<font color=green>该用户名可以使用！</font>';
		}
	}else{
		echo '<font color=red>请输入正确的用户名！</font>';
	}

?>