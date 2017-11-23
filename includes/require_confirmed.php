<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	  	define('lock_key',true);
		include("db_connect.php");
		include("../functions/functions.php");
		 
		$name = clear_string($_POST["name"]);
		$id = clear_string($_POST["id"]);
		 
		   
		   $result = mysql_query("SELECT order_confirmed FROM orders WHERE order_ip='$id' AND order_specialname='$name'",$link);
		If (mysql_num_rows($result) > 0)
		{
		    $results = mysql_query("UPDATE orders SET order_confirmed = '1' WHERE order_ip='$id' AND order_specialname='$name'",$link);
		    echo 'yes';    
		}


	 
	}
	 
 
 
?>