<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
define('lock_key',true);
include("db_connect.php");
include("../functions/functions.php");
         
$id = clear_string($_POST["id"]);
 
$result = mysql_query("SELECT * FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cart_id_product = '$id'",$link);
If (mysql_num_rows($result) > 0)
{
echo 'no';
}
else
{
    $result = mysql_query("SELECT * FROM cars WHERE ID = '$id'",$link);
    $row = mysql_fetch_array($result);
     
            mysql_query("INSERT INTO cart(cart_id_product,cart_price,cart_count,cart_datetime,cart_ip)
                        VALUES( 
                            '".$row['ID']."',
                            '".$row['Price']."',
                            '1',                    
                            NOW(),
                            '".$_SERVER['REMOTE_ADDR']."'                                                                       
                            )",$link);  
}
}
?>