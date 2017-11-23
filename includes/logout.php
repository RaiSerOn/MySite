<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		session_start();
		unset( $_SESSION['auth']);
		unset($_SESSION['auth_pass']);
		unset($_SESSION['auth_login']);
		unset($_SESSION['auth_surname']);
		unset($_SESSION['auth_name']);
		unset($_SESSION['auth_patronymic']);
		unset($_SESSION['auth_phone']);
		unset($_SESSION['auth_email']);
		setcookie('rememberme','',0,'/');
		echo'logout';
	}
?>