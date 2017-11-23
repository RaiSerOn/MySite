<?php
	$res = mysql_query("SELECT Views, Hosts FROM visits",$link);
	$row = mysql_fetch_array($res);
	echo'<p>Уникальных посетителей: '. $row['Hosts'] .'<br/>';
	echo 'Просмотров: '. $row['Views'] .'</p>';
?>