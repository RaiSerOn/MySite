<?php 
    defined('lock_key') or die('В доступе отказано!');
?>
<hr style="margin-bottom: 0;margin-top: 0;border: 1px solid #bbb;">
<div id="block-random-tovar" style=" margin:auto ;margin-top: 60px; margin-bottom: 60px;">
	<ul >
		<?php    
		$query_random = mysql_query("SELECT DISTINCT * FROM cars WHERE visible='1' ORDER by RAND() LIMIT 6",$link);  
		If (mysql_num_rows($query_random) > 0){
			$res_query = mysql_fetch_array($query_random);
			do{
				$img_path = "/uploads_images/".$res_query[Image];
				$width = 120;
				$height = 120;    
				echo '
				<li style="text-align: center;">
				<img alt="'.$res_query["Title"].'" oncontextmenu="return false;" src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
				<a class="random-title" href="view_content.php?id='.$res_query["ID"].'">'.$res_query["Title"].'</a><br><br>
				<span class="random-price">'.group_numerals($res_query["Price"]).' руб</span>
				';
				If($res_query["Howmany"] > 0){
					echo '<a class="random-add-cart btn btn-danger btn-xs" tird="'.$res_query["ID"].'">Купить</a>
					';
				}
				echo '</li>';
			} while($res_query = mysql_fetch_array($query_random));
		}
		?>
	</ul>
</div>