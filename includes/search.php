<?php
 if($_SERVER["REQUEST_METHOD"] == "POST")
{
 define('lock_key',true);
 include("db_connect.php");
 include("../functions/functions.php");
 
 $search = (clear_string($_POST['text']));
 $result = mysql_query("SELECT * FROM cars WHERE title LIKE '%$search%' AND visible = '1' LIMIT 10",$link);
 
 If (mysql_num_rows($result) > 0){
$result = mysql_query("SELECT * FROM cars WHERE title LIKE '%$search%'  AND visible = '1' LIMIT 10",$link);
$row = mysql_fetch_array($result);
do
	{
	echo '
	<li><a href="search.php?q='.$row[1].'">'.$row[1].'</a></li>
	<hr>
	';
}while ($row = mysql_fetch_array($result));
 
}
 }
?>