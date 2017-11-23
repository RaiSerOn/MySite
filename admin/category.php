<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth")
{
    define('lock_key', true);
        
       if (isset($_GET["logout"]))
    {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }
 
  $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='category.php' >Категории</a>";
   
  include("include/db_connect.php");
  include("include/functions.php");
if ($_POST["submit_cat"])
{
     $cat_type = clear_string($_POST["cat_type"]);
     $cat_brand = clear_string($_POST["cat_brand"]);
     
                    mysql_query("INSERT INTO category(type,brand)
                        VALUES(                     
                            '".$cat_type."',
                            '".$cat_brand."'                             
                        )",$link);
                    
     $_SESSION['message'] = "<p id='form-success'>Категория успешно добавлена!</p>";   
}
 
 
?>
<!DOCTYPE html>
<html>
 
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link href="css/style.css" rel="stylesheet" type="text/css" /> 
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/code.js"></script> 
    <title>Панель Управления - Категории</title>
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
<p id="title-page" >Категории</p>
</div>
<?php
if (isset($msgerror)) echo '<p id="form-error" align="center">'.$msgerror.'</p>';
 
        if(isset($_SESSION['message']))
        {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        }
?>
<form method="post">
<ul id="cat_products">
<li>
<label>Категории</label>
<div>
<?php
       echo '<a class="delete-cat">Удалить</a>';  

?>
 
</div>
<select name="cat_type" id="cat_type" size="10">
 
<?php
$result = mysql_query("SELECT category FROM models ORDER BY category DESC",$link);
  
 If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
    echo '
     
       <option value="'.$row["ID"].'" >'.$row["category"].'</option>
     
    ';
}
 while ($row = mysql_fetch_array($result));
}    
?>
 
</select>
</li>
<li>
<label>Тип товара</label>
<input type="text" name="cat_type" />
</li>
<li>
<label>Бренд</label>
<input type="text" name="cat_brand" />
</li>
</ul>
<p align="right"><input type="submit" name="submit_cat" id="submit_form" /></p>
</form>
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