<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth")
{
    define('lock_key',true);
        
       if (isset($_GET["logout"]))
    {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }
 
  $_SESSION['urlpage'] = "<a href='index.php' >Главная</a>";
   
  include("include/db_connect.php");
  include("../includes/show_views.php");
?>
<!DOCTYPE html>
<html>
 
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <title>Панель Управления</title>
</head>
<body>
<div id="block-body">
<?php
     
     $result1 = mysql_query("SELECT * FROM orders WHERE order_confirmed='yes'",$link);
    $count1 = mysql_num_rows($result1);
     
    if ($count1 > 0) { $count_str1 = '<p>+'.$count1.'</p>'; } else { $count_str1 = ''; }
  
    $result2 = mysql_query("SELECT * FROM table_reviews WHERE moderate='0'",$link);
    $count2 = mysql_num_rows($result2);
     
    if ($count2 > 0) { $count_str2 = '<p>+'.$count2.'</p>'; } else { $count_str2 = ''; }
  
?>
<div id="block-header">
 
<div id="block-header1" >
<h3>E-SHOP. Панель Управления</h3>
<p id="link-nav" ><?php echo $_SESSION['urlpage']; ?></p> 
</div>
 
<div id="block-header2" >
<p align="right"><a href="administrators.php" >Администраторы</a> | <a href="?logout">Выход</a></p>
<p align="right">Вы - <span><?php echo $_SESSION['admin_role']; ?></span></p>
</div>
 
</div>
 
<div id="left-nav">
<ul>
<li><a href="orders.php">Заказы</a><?php echo $count_str1; ?></li>
<li><a href="tovar.php">Товары</a></li>
<li><a href="reviews.php">Отзывы</a><?php echo $count_str2; ?></li>
<li><a href="category.php">Категории</a></li>
<li><a href="clients.php">Клиенты</a></li>
<li><a href="news.php">Новости</a></li>
</ul>
</div>
<?php
     
     // Общее количество заказов 
 $query1 = mysql_query("SELECT * FROM orders",$link);
 $result1 = mysql_num_rows($query1);
 // Общее количество товаров 
 $query2 = mysql_query("SELECT * FROM cars",$link);
 $result2 = mysql_num_rows($query2);   
 // Общее количество отзывов 
 $query3 = mysql_query("SELECT * FROM table_reviews",$link);
 $result3 = mysql_num_rows($query3);
  // Общее количество клиентов 
 $query4 = mysql_query("SELECT * FROM reg_user",$link);
 $result4 = mysql_num_rows($query4);
?>
<div id="block-content">
<div id="block-parameters">
<p id="title-page" >Общая статистика</p>
</div>
 
<ul id="general-statistics">
<li><p>Всего заказов - <span><?php echo $result1; ?></span></p></li>
<li><p>Товаров - <span><?php echo $result2; ?></span></p></li>
<li><p>Отзывы - <span><?php echo $result3; ?></span></p></li>
<li><p>Клиенты - <span><?php echo $result4; ?></span></p></li>
</ul>
 
<h3 id="title-statistics">Статистика продаж</h3>
 
<TABLE align="center" CELLPADDING="10" WIDTH="100%">
<TR>
<TH>Дата</TH>
<TH>Товар</TH>
<TH>Цена</TH>
<TH>Статус</TH>
</TR>
 
 
<?php
 
$result = mysql_query("SELECT * FROM orders,buy_products WHERE orders.order_confirmed='null' AND orders.order_id=buy_products.buy_id_order",$link);
  
 If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
 
 $result2 = mysql_query("SELECT * FROM cars WHERE ID='{$row["buy_id_product"]}'",$link);   
  If (mysql_num_rows($result2) > 0)
{
 $row2 = mysql_fetch_array($result2);
}
     
$statuspay = "";
if ($row["order_pay"] == "accepted") $statuspay = "Оплачено";
 
echo '
 <TR>
<TD  align="CENTER" >'.$row["order_datetime"].'</TD>
<TD  align="CENTER" >'.$row2["Title"].'</TD>
<TD  align="CENTER" >'.$row2["Price"].'</TD>
<TD  align="CENTER" >'.$statuspay.'</TD>
</TR>
';
 
    }
     while ($row = mysql_fetch_array($result));
}     
?>
 
</TABLE>
</div>
</div>
</body>
</html>
<?php
}else
{
    header("Location: login.php");
}
?>