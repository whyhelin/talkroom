<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>web聊天_查询好友</title>
<script type="text/javascript">
<!--
	function sure(name){
		if(confirm('确定删除该好友？')){
			window.location.href = "queryToDelfriendProcess.php?f_nickname="+ name;
		}else{
			window.location.href = window.location.href;
		}
	}
//-->
</script>
</head>
<body>
<?php
	

	require_once 'outside.php';
	include './config/dbconfig.php';
	include 'fenye.class.php';
	header("Content-type:text/html; charset=utf-8");
	checkUserValidate();
	
	$nickname = $_SESSION['nickname'];
	
	$sql   = "select f_nickname from friend";						//4. 发送指令sql
	$res   = mysql_query($sql,$conn);									//$res 表示结果集	
	$total = mysql_num_rows($res);
	$per   = 2;
	
	$data['total_rows'] = $total;
	$data['list_rows']  = $per;
	$data['method']     = 'ajax';
	
	$page_obj = new Pager($data);
	$pagelist = $page_obj->show(1);

	$nickname = $_SESSION['nickname'];
	
	$sql = "select f_nickname from friend where nickname='{$nickname}' and fzt=1 ".$page_obj->limit;//判断是否有好友请求
	$res = mysql_query($sql,$conn);

	while($row=mysql_fetch_assoc($res)){								
		$f_nickname = $row['f_nickname'];
		echo "<li>".$row['f_nickname']."&nbsp;|&nbsp;<span><input type='button' value='删除好友' onclick='sure(\"$f_nickname\")'/></span></a></li>";
	}

	echo $pagelist;
	
	mysql_free_result($res);										//释放资源,关闭连接(必须)
	mysql_close($conn);
	
?>