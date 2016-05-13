<?php
	require_once 'outside.php';
	header("Content-type:text/html; charset=utf-8");
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
</head>
<body>
<P><a href="exit.php">退出系统</a>&nbsp;&nbsp;<a href='regist.php'>注册</a></P>
<hr/>
<h1>用户登录系统</h1>
<form action="loginProcess.php" method="post">
<table>
<tr><td>用户名:</td><td><input type="text" name="nickname" value="<?php echo getCookie('nickname'); ?>"/></td></tr>
<tr><td>密&nbsp;码:</td><td><input type="password" name="password"/></td></tr>
<tr><td>验证码</td><td><input type="text" name="checkcode"/></td>
<td><img src="checkCode.php" onclick="this.src='checkCode.php?aa='+Math.random()"/></td></tr>
<tr><td colspan="2">是否保存用户名与密码<input type="checkbox" name="save" value="save"/></td></tr>
<tr><td><input type="submit" value="用户登录"/></td><td><input type="reset" value="重新填写"/></td></tr>
</table>
</form>
<?php
	//echo getCookie('id');
    if(!empty($_GET['errno'])){   
        $errno=$_GET['errno'];
        if($errno==1) echo "<br/><font color='red' size=3>用户名或密码错误</font>";
        else if($errno==2) echo "<br/><font color='red' size=3>验证码错误</font>";
    }
?>
</body>
</html>