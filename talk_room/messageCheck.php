<?php
	
	header("Content-type:text/html; charset=utf-8");
	require_once 'outside.php';
	include './config/dbconfig.php';
	checkUserValidate();

	//session_start();
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
	
	echo json_encode($info);

?>