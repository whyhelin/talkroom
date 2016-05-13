<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>web聊天_用户注册</title>
<script type="text/javascript">
<!--
	//window.onload=function(){
		
		//checkpwd();
	//}
	
	function checkname(){	
		var nickname = document.getElementById('nickname').value;
		nickname = encodeURIComponent(nickname);//对信息进行编码防止特殊字符的干扰

		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4){
				document.getElementById('namespan').innerHTML = xhr.responseText;
			}
		}
		xhr.open('get','./checkName.php?nickname='+nickname);//随机数防止浏览器缓存动态文件造成的后果
		xhr.send(null);//把请求发送给服务器端
	}

	function checkpwd(){	
		var pwd  = document.getElementById('password').value;
		var pwd2 = document.getElementById('password2').value;
		if(pwd=='' || pwd2==''){
			document.getElementById('pwd2span').innerHTML = '<font color=red>密码不能为空！</font>';
		}else{
			if(pwd==pwd2){
				document.getElementById('pwd2span').innerHTML = '<font color=green>密码一致</font>';
			}else{
				document.getElementById('pwd2span').innerHTML = '<font color=red>两次输入的密码不一致,请重新输入！</font>';
			}
		}
	}

	function refresh(){
		window.location.href = window.location.href;
	}

//-->
</script>
</head>
<body>
<P><a href="exit.php">退出系统</a>&nbsp;&nbsp;<a href='login.php'>登录</a></P>
<hr/>
<form action="registCheck.php" method="post">
<table id="table1">
	<tr>
		<td class="td1">昵称:</td>
		<td><input type="text"  name="nickname" id="nickname" value='' onblur='checkname()'/><span id='namespan'></span></td>
	</tr>

	<tr>
		<td class="td1">密码:</td>
		<td><input type="password" name="password" id="password" value='' /><span id='pwdspan'></span></td>
	</tr>

	<tr>
		<td class="td1">确认密码:</td>
		<td><input type="password" name="password2" id="password2" value='' onblur='checkpwd()'/><span id='pwd2span'></span></td>
	</tr>
	<tr>
		<td class="td1">性别:</td>
		<td><input type="radio" value='男' name="sex" checked="checked" />男<input type="radio" value='女' name="sex" />女</td>
	</tr>
	<tr>
		<td class="td1">出生日期:</td>
		<td>
		<select name="yyyy">
		<?php
			for($i=2015;$i>1900;$i--){
				echo "<option value='{$i}'>$i</option>";
			}
		?>
		</select>年 
		<select name="mm">
		<?php
			for($i=1;$i<=12;$i++){
				echo "<option value='{$i}'>$i</option>";
			}
		?>
		</select>月 
		<select name="dd">
		<?php
			for($i=1;$i<=31;$i++){
				echo "<option value='{$i}'>$i</option>";
			}
		?>
		</select>日 
		</td>
	</tr>
	<tr>
		<td class="td1">居住地:</td>
		<td><input type="text" name="address" /></td>
	</tr>
	<tr>
		<td class="td1">问题提示:</td>
		<td><input type="text" name="question" /></td>
	</tr>
	<tr>
		<td class="td1">问题回答:</td>
		<td><input type="text" name="answer" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value=" 注册 " id="submit" />&nbsp;&nbsp;<input type="button" value=" 重置 " id="reset" onclick='refresh()'/></td>	
	</tr> 
</table>
</form>
</body>
</html>
