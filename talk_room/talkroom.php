<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<style type="text/css">
	div{
		width:600px;
		height:300px;
		background-color:pink;
		overflow:scroll;
		
	}
</style>
<script type="text/javascript">
<!--

	window.onload=function(){	
		f_nickname = "<?php	echo $_GET['f_nickname']; ?>";
		window.setInterval('showmessage()',1000);
		setInterval('friendCheck()',500);
	}
	
	var flag = 0;
	function sendmessage(){
		var fm = document.getElementsByTagName('form')[0];
		fm.onsubmit = function(evt){
			var info = new FormData(fm);
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function(){
				if (xhr.readyState == 4){
					if(xhr.responseText == '1'){
						alert('请填写完整信息！');
					}else{
						document.getElementById('respond').innerHTML += xhr.responseText;
						flag = 1;//表明发送了新的数据
						window.setTimeout('clr()',50);
					}
					
				}
			}
			xhr.open("post","./send.php?f_nickname="+f_nickname);//以get方式创建一个对php文件的新的http请求
			//xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');//设置post请求头
			xhr.send(info);//把post请求发送给服务器端
			evt.preventDefault();//阻止浏览器默认动作
		}
		
	}
	
	function clr(){
		document.getElementById('respond').innerHTML = '';
		document.getElementById('smooth').value      = '微笑地';
		document.getElementById('content').value     = '';
	}

	var maxID = 0;//设置全局变量，控制聊天内容的现实条数
	var sum   = 0;//设置显示的聊天内容的总条数
	function showmessage(){
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4){
				//document.getElementById('talkcontent').innerHTML = xhr.responseText;
				eval("var jn_info="+xhr.responseText);//将json字符串信息转化为对象
				var s = '';
				for(var k=0;k<jn_info.length;k++){
					s += '<span>';
					s += jn_info[k].stime+'<br/>';
					s += jn_info[k].sender+'&nbsp';
					s += jn_info[k].smooth+'对';
					s += '&nbsp'+jn_info[k].geter+'&nbsp';
					s += '说'+':&nbsp'+jn_info[k].content+'&nbsp'+'<br/><br/>';
					s += '</span>';
					maxID = jn_info[k].id;//获取当前聊天内容的最大 ID 
				}
				
				sum += jn_info.length;//当显示的条数多于5条，清屏再显示
				//console.log(sum);
				if(sum>=100){
					document.getElementById('talkcontent').innerHTML = s;
					sum = 0;
				}else{
					document.getElementById('talkcontent').innerHTML += s;
				}
				//sum = 0;
				//如果发送了信息，则将滚动条置于底部
				if(flag==1){
					document.getElementById('talkcontent').scrollTop = document.getElementById('talkcontent').scrollHeight;
					flag = 0;//标志位置0，防止不能人为控制滚动条
				}
			}
		}
		xhr.open("get","./show.php?maxID="+maxID+"&f_nickname="+f_nickname);//以get方式创建一个对php文件的新的http请求
		xhr.send(null);
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



//-->
</script>
</head>
<body>
<?php
	require_once 'outside.php';
	header("Content-type:text/html; charset=utf-8");
	checkUserValidate();
?>
<P><a href="userview.php">主页</a>&nbsp;&nbsp;<a href="talk.php">聊天</a>&nbsp;&nbsp;
<span id='xiaoxi1'></span></P>
<hr/>
<h1>聊天室——<?php	echo $_GET['f_nickname']; ?></h1>
<div id='talkcontent'> </div>
<p><form>
<select name="smooth" id='smooth'>
<option value="微笑地" checked>微笑地</option>
<option value="悲伤地">悲伤地</option>
<option value="不屑地">不屑地</option>
</select><br/><br/>
<textarea name="content" rows="3" cols="80" id='content'></textarea><span id='respond'></span><br/><br/>
<input type='submit' value='发送' onclick='sendmessage()'/>
</form></p>
</body>
</html>