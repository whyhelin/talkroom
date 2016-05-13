<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/main.css" type="text/css" rel="stylesheet" />
<title>好友消息</title>
</head>
<body>
<?php
	
	header("Content-type:text/html; charset=utf-8");
	require_once 'outside.php';
	include './config/dbconfig.php';
	
	checkUserValidate();

	$nickname = $_SESSION['nickname'];
	
	$sql = "select f_nickname from friend where nickname='{$nickname}' and fzt=1;";
	$res = mysql_query($sql,$conn);
	
	$messageFriend = array();
	$num = array();
	$sum = 0;
	$info = array();

	while($row = mysql_fetch_assoc($res)){
		if(isMessage($row['f_nickname'])){
			$messageFriend[] = $row['f_nickname'];
			$num[] = isMessage($row['f_nickname']);
			$sum  += isMessage($row['f_nickname']);
		}
	}
	
	$info[0] = count($messageFriend);
	$info[1] = $sum;

	if($info[1]>0){
		echo "<span><a href='newMessage.php' style='color:#c00'>&nbsp;您有(".$info[1].")条好友请求</span></a> 在线 <a href='userview.php'>主界面</a>";
	}else{
		echo " 在线 <a href='userview.php'>主界面</a>";
	}

?>
<div id="message">			
	<hr/>
	<p><span style="font-weight:bold">好友消息</span></p>
	<?php
		if($info[1]<1){
			echo "没有好友消息";
			exit();
		}else{
			for($i=0;$i<$info[0];$i++){
				echo "<div style='float:left;margin-left:30px;'><span style='color:#00a;font-weight:bold;'>";
				echo $messageFriend[$i]."</span> ".$num[$i]."条新消息&nbsp;<a href='talkroom.php?f_nickname=".$messageFriend[$i]."'>查看</a></div>";
				echo '<br/><br/>';
			}
		}
		
	?>
</div>
</body>
</html>