<?php
	
	header("Content-type:text/html; charset=utf-8");
	include './config/dbconfig.php';
	require_once 'outside.php';
	checkUserValidate();
	
	echo isFriend();

?>