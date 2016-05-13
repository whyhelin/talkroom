<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>web聊天</title>
<script type="text/javascript">
<!--
	function sure(name){
		if(confirm('确定？')){
			window.location.href = "talkroom.php?f_nickname="+ name;
		}else{
			window.location.href = window.location.href;
		}
	}
//-->
</script>
</head>
<body>
<P><a href="userview.php">返回主页</a></P>
<hr/>
<form action="talkroom.php" method="get">
对方的昵称:<input type="text" name="f_nickname" />
<input type="submit" value="聊天" />
</form>
<hr/>
<p>您的好友</p>
<?php
	
	require_once 'outside.php';
	include './config/dbconfig.php';
	header("Content-type:text/html; charset=utf-8");
	checkUserValidate();

	
	$sql = "select f_nickname from friend where fzt=1 and nickname='".$_SESSION['nickname']."' order by id desc limit 0,10;";
	$res = mysql_query($sql,$conn);
	
	while($row = mysql_fetch_array($res)){
		$f_nickname = $row['f_nickname'];
		echo "<li>".$row['f_nickname']."&nbsp;|&nbsp;<span><input type='button' value='聊天' onclick='sure(\"$f_nickname\")'/></span></a></li>";
	}
	mysql_free_result($res);

?>
</body>
</html>