<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<script type="text/javascript">
<!--
	window.onload=function(){
		setInterval('friendCheck()',500);
		setInterval('messageCheck()',500);
	}

	function friendCheck(){
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4){
				if(xhr.responseText == 0){
					document.getElementById('xiaoxi1').innerHTML = '您没有新的好友请求';
				}else{
					document.getElementById('xiaoxi1').innerHTML = "您有<a href='qingqiu.php'>&nbsp;&nbsp;<font color=red>"+xhr.responseText+"</font>&nbsp;&nbsp;</a>个新的好友请求";
				}
			}
		}
		xhr.open('get','./friendCheck.php');//以get方式创建一个对php文件的新的http请求
		//xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');//设置post请求头
		xhr.send(null);
	}


	function messageCheck(){
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4){
				//alert(xhr.responseText);
				eval("var jn_info="+xhr.responseText);
				if(jn_info[1] == 0){
					document.getElementById('xiaoxi2').innerHTML = '您没有新的好友消息';
				}else{
					document.getElementById('xiaoxi2').innerHTML = "您有<a href='newMessage.php'>&nbsp;&nbsp;<font color=red>"+jn_info[1]+"</font>&nbsp;&nbsp;</a>个新的好友消息";
				}
			}
		}
		xhr.open('get','./messageCheck.php');//以get方式创建一个对php文件的新的http请求
		//xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');//设置post请求头
		xhr.send(null);
	}



//-->
</script>
</head>
<?php
	
	require_once 'outside.php';
	header("Content-type:text/html; charset=utf-8");
	checkUserValidate();
	
	date_default_timezone_set('PRC'); 

	$name=getCookie('name');
	getLastTime($name);
	
	//setcookie("lastvisit",date('Y-m-d H:i:s'),time()+3600*24*30);

	echo "<hr/>欢迎{$name}登陆成功&nbsp;&nbsp;<span id='xiaoxi1'></span>&nbsp;&nbsp;<span id='xiaoxi2'></span><hr/>";
	
?>

<h1>主界面</h1>
<a href="talk.php">聊天</a><br/>
<a href="addfriend.php">添加好友</a><br/>
<a href="delfriend.php">删除好友</a><br/>
<a href="queryFriend.php">查询好友</a><br/>
<a href="exit.php">退出系统</a><br/>
</html>