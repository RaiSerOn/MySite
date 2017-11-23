<?php
	defined('lock_key') or die('В доступе отказано!');
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = '';
	$db_database = 'compstore';

	$link = mysql_connect("localhost","root","");

	mysql_select_db("compstore",$link) or die("Нет соединения с БД".mysql_error());

	mysql_query("SET names UTF-8");
?>