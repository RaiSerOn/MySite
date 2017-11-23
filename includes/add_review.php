<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
 define('lock_key',true);   
 include("db_connect.php");
 include("../functions/functions.php");
 
 $comment =  clear_string($_POST['comment']);
 $nick = clear_string($_POST['nick']);
 
            mysql_query("INSERT INTO table_reviews(nick,comment,date)
                        VALUES(                     
                            '".$nick."',
                            '".$comment."',
                             NOW()                          
                        )",$link);  
 
echo 'yes';
}
?>