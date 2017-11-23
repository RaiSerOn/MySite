<?php
	defined('lock_key') or die('В доступе отказано!');
	include("db_connect.php");
	$visitor_ip = $_SERVER['REMOTE_ADDR'];
	$date = date("Y-m-d");
	$res = mysql_query("SELECT id FROM visits WHERE Date_NOW = '".$date."'",$link);
	if(mysql_num_rows($res) == 0){
		echo 'HELLO';
		mysql_query("DELETE FROM ips",$link);
		mysql_query("INSERT INTO ips (ip_address) VALUES ('".$visitor_ip."')",$link);
		$res_count = mysql_query("INSERT INTO visits (Date_NOW, Hosts, Views) VALUES('".$date."',1,1)",$link);
	} else{
		$current_ip = mysql_query("SELECT ip_id FROM ips WHERE ip_address = '".$visitor_ip."'",$link);
		if(mysql_num_rows($current_ip) == 1){
			mysql_query("UPDATE visits SET Views = Views + 1 WHERE Date_NOW = '".$date."'",$link);
		} else{
			mysql_query("INSERT INTO ips (ip_address) VALUES('" . $current_ip . "')",$link);
			mysql_query("UPDATE visits SET Hosts = Hosts + 1, Views = Views + 1 WHERE Date_NOW = '".$date."'",$link);
		}
	}
?>