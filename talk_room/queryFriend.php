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

	function showpage(url){
		//onreadystatechange : 事件,当 ajax 状态的 readyState 改变时触发事件
		//responseText : 以字符串形式返回服务器端的信息
		//readyState : ajax 状态信息
				//0 :刚创建 ajax 对象
				//1 :已经调用 open 函数
				//2 :已经调用 send 函数
				//3 :已经返回服务器部分数据信息
				//4 :请求完成,数据返回完整
		
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function()
		{
			if (xhr.readyState == 4)
			{
				document.getElementById('result').innerHTML = xhr.responseText;
			}
		}
		xhr.open('get',url);//以get方式创建一个对php文件的新的http请求
		xhr.send(null);//把请求发送给服务器端
	}

	
	window.onload = function()
	{
		showpage('./queryFriendProcess.php');
	}

//-->
</script>
</head>
<body>
<?php

	require_once 'outside.php';
	header("Content-type:text/html; charset=utf-8");
	checkUserValidate();

?>
<P><a href="userview.php">返回主页</a></P>
<hr/>
<p>您的好友</p>
<div id='result'> </div>
</body>
</html>