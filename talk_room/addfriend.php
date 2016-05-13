<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>web聊天_添加好友</title>
</head>
<body>
<P><a href="userview.php">返回主页</a></P>
<hr/>
<form action="addfriendProcess.php" method="get">
对方的昵称:<input type="text" name="f_nickname" />
<input type="submit" value="添加" />
</form>
<hr/>
<p>最新注册会员</p>
<?php
	
	require_once 'outside.php';
	include './config/dbconfig.php';
	header("Content-type:text/html; charset=utf-8");
	checkUserValidate();
	
	
	$sql = "select nickname from user order by reg_time desc limit 0,10;";
	$res = mysql_query($sql,$conn);
	
	while($row = mysql_fetch_array($res)){
		if($row['nickname'] != $_SESSION['nickname']){
			echo "<li>".$row['nickname']."&nbsp;|&nbsp;<a href='addfriendProcess.php?f_nickname=".$row['nickname']."'>添加好友</a></li>";
		}
	}
	mysql_free_result($res);

?>
</body>
</html>
