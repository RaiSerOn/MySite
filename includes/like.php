<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		session_start();
		define('lock_key',true);
		if($_SESSION["likeid"] != (int)$_POST["id"]){
			include("db_connect.php");
			$id = (int)$_POST["id"];
			$result = mysql_query("SELECT * FROM cars WHERE ID = '$id'",$link);
			If(mysql_num_rows($result) > 0){
				$row = mysql_fetch_array($result);
				$new_count = $row["yes_like"] + 1;
				$update = mysql_query("UPDATE cars SET yes_like = '$new_count' WHERE ID = '$id'",$link);
				echo $new_count;
			}
			$_SESSION["likeid"] = (int)$_POST["id"];
		} else {
			echo 'no';
		}
	} else {
		echo "В доступе отказано";
	}
?>