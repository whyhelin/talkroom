<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/main.css" type="text/css" rel="stylesheet" />
<title>好友请求</title>
</head>
<body>
<?php
	
	header("Content-type:text/html; charset=utf-8");
	require_once 'outside.php';
	include './config/dbconfig.php';
	checkUserValidate();

	if(empty($_SESSION['nickname'])){
		header("Location:login.php");
		exit();
	}else{
		$nickname = $_SESSION['nickname'];
		
		$sql = "select id from friend where f_nickname='{$nickname}' and fzt='0';";//判断是否有好友请求
		$res = mysql_query($sql,$conn);
		$fnum = mysql_num_rows($res);
		if($fnum>0){
			echo "<span ><a href='qingqiu.php' style='color:#c00'>&nbsp;您有(".$fnum.")条好友请求</span></a> 在线 <a href='userview.php'>主界面</a>";
		}else{
			echo " 在线 <a href='userview.php'>主界面</a>";
		}
		mysql_free_result($res);	
	}
?>
<div id="message">
				
	<hr/>
	<p><span style="font-weight:bold">好友请求</span></p>
	<?php
		$sql = "select id,nickname,f_nickname from friend where f_nickname='{$nickname}' and fzt='0';";
		$res = mysql_query($sql,$conn);
		if(mysql_num_rows($res)<1){
			echo "没有好友请求";
			exit();
		}
		while($row = mysql_fetch_array($res)){
			echo "<div style='float:left;margin-left:30px;'><span style='color:#00a;font-weight:bold;'>";
			echo $row['nickname']."</span> 请求加为好友&nbsp;<a href='agreeqingqiu.php?f_nickname=";
			echo $row['nickname']."&id=".$row['id']."'>同意并添加</a>&nbsp;<a href='refuseqingqiu.php?id=".$row['id']."'>拒绝</a></div>";
			echo '<br/><br/>';
		}
		mysql_free_result($res);
	?>
</div>
</body>
</html>
