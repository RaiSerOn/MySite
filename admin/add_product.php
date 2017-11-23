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
 
  $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='tovar.php' >Товары</a> \ <a>Добавление товара</a>";
   
  include("include/db_connect.php");
  include("include/functions.php"); 
 
    if ($_POST["submit_add"])
    {
      $_POST["submit_add"]='';
      $error = array();
     
    // Проверка полей
         
       if (!$_POST["form_title"])
      {
         $error[] = "Укажите название товара";
      }
       
       if (!$_POST["form_price"])
      {
         $error[] = "Укажите цену";
      }
           
       if (!$_POST["form_scale"])
      {
         $error[] = "Укажите размеры";         
      }else
      {
        $result = mysql_query("SELECT scale FROM models WHERE id='{$_POST["form_scale"]}'",$link);
        $row = mysql_fetch_array($result);
        $selectscale = $row["scale"];
 
      }

      if (!$_POST["form_main_TYPE"])
      {
         $error[] = "Укажите Основную категорию";         
      }else
      {
        $result = mysql_query("SELECT main_category FROM models WHERE id='{$_POST["form_main_TYPE"]}'",$link);
        $row = mysql_fetch_array($result);
        $selec_main_TYPE = $row["main_category"];
 
      }

      if (!$_POST["form_brand"])
      {
         $error[] = "Укажите брэнд";         
      }else
      {
        $result = mysql_query("SELECT brand FROM models WHERE id='{$_POST["form_brand"]}'",$link);
        $row = mysql_fetch_array($result);
        $selectbrand = $row["brand"];
 
      }
      if (!$_POST["form_mark"])
      {
         $error[] = "Укажите марку";         
      }else
      {
        $result = mysql_query("SELECT mark FROM models WHERE id='{$_POST["form_mark"]}'",$link);
        $row = mysql_fetch_array($result);
        $selectmark = $row["mark"];
 
      }
      if (!$_POST["form_category"])
      {
         $error[] = "Укажите категорию";         
      }else
      {
        $result = mysql_query("SELECT category FROM models WHERE id='{$_POST["form_category"]}'",$link);
        $row = mysql_fetch_array($result);
        $selectcategory = $row["category"];
 
      }
       
 // Проверка чекбоксов
       
       if ($_POST["chk_visible"])
       {
          $chk_visible = "1";
       }else { $chk_visible = "0"; }    
       if (count($error))
       {           
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
             
       }else
       {
                            
                    mysql_query("INSERT INTO cars(Date,Title,Price,Scale,Producer,Model,main_TYPE,Type,Material,Limitation,Vendor_code,Production,Intro,visible,seo_description,seo_words,Howmany)
                        VALUES(
                            NOW(),                     
                            '".$_POST["form_title"]."',
                            '".$_POST["form_price"]."',
                            '".$selectscale."',
                            '".$selectbrand."',
                            '".$selectmark."',
                            '".$selec_main_TYPE."',
                            '".$selectcategory."',
                            '".$_POST["form_material"]."',
                            '".$_POST["form_limitation"]."',
                            '".$_POST["form_vendor_code"]."',
                            '".$_POST["form_seo_production"]."',
                            '".$_POST["form_seo_intro"]."',
                            '".$chk_visible."',
                            '".$_POST["form_seo_description"]."',
                            '".$_POST["form_seo_words"]."',
                            '".$_POST["form_count"]."'                           
                        )",$link);
                    
      $_SESSION['message'] = "<p id='form-success'>Товар успешно добавлен!</p>";
      $id = mysql_insert_id();
                  
       if (empty($_POST["upload_image"]))
      {        
      include("actions/upload-image.php");
      unset($_POST["upload_image"]);           
      } 
       
       if (empty($_POST["galleryimg"]))
      {        
      include("actions/upload-gallery.php"); 
      unset($_POST["galleryimg"]);                 
      }
}           
}   
 
?>
<!DOCTYPE html>
<html>
 
<head>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link href="css/style.css" rel="stylesheet" type="text/css" /> 
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/code.js"></script>  
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
<p id="title-page" >Добавление товара</p>
</div>
<?php
if (isset($msgerror)) echo '<p id="form-error" align="center">'.$msgerror.'</p>';
 
         if(isset($_SESSION['message']))
        {
        echo $_SESSION['message'];
        unset($_SESSION['message']);   
        }
         
     if(isset($_SESSION['answer']))
        {
        echo $_SESSION['answer'];
        unset($_SESSION['answer']);
        } 
?>
 
<form enctype="multipart/form-data" method="post">
<ul id="edit-tovar">
 
<li>
<label>Название товара</label>
<input type="text" name="form_title" />
</li>
 
<li>
<label>Цена</label>
<input type="text" name="form_price"  />
</li>

<li>
<label>Материалы</label>
<input type="text" name="form_material"  />
</li>

<li>
<label>Ограничение по возрасту</label>
<input type="text" name="form_limitation"  />
</li>

<li>
<label>Артикул</label>
<input type="text" name="form_vendor_code"  />
</li>
 
<li>
<label>Производитель(Страна)</label>
<input type="text" name="form_seo_production"  />
</li>

<li>
<label>СЕО-описание</label>
<input type="text" name="form_seo_description"  />
</li>

<li>
<label>СЕО-ключи</label>
<input type="text" name="form_seo_words"  />
</li>
 
<li>
<label>Описание</label>
<textarea name="form_seo_intro"></textarea>
</li>

<li>
<label>Количество моделей</label>
<input type="text" name="form_count"  />
</li>

<li>
<label>Размеры</label>
<select name="form_scale" id="type" size="5" >
 
<?php
$category = mysql_query("SELECT scale,ID FROM models",$link);
     
If (mysql_num_rows($category) > 0)
{
$result_category = mysql_fetch_array($category);
do
{
  if($result_category["scale"] != ''){  
  echo '<option value="'.$result_category["ID"].'" >'.$result_category["scale"].'</option>';
  }
}
 while ($result_category = mysql_fetch_array($category));
}
?> 
 
</select>
</li>

<li>
<label>Основная категория</label>
<select name="form_main_TYPE" id="main_category" size="5" >
 
<?php
$category = mysql_query("SELECT main_category,ID FROM models",$link);
     
If (mysql_num_rows($category) > 0)
{
$result_category = mysql_fetch_array($category);
do
{
  if($result_category["main_category"] != ''){  
  echo '<option value="'.$result_category["ID"].'" >'.$result_category["main_category"].'</option>';
  }
}
 while ($result_category = mysql_fetch_array($category));
}
?> 
 
</select>
</li>

<li>
<label>Брэнд</label>
<select name="form_brand" id="type" size="5" >
 
<?php
$category = mysql_query("SELECT brand,ID FROM models",$link);
     
If (mysql_num_rows($category) > 0)
{
$result_category = mysql_fetch_array($category);
do
{
   if($result_category["brand"] != ''){
  echo '<option value="'.$result_category["ID"].'" >'.$result_category["brand"].'</option>';
  }
}
 while ($result_category = mysql_fetch_array($category));
}
?> 
 
</select>
</li>

<li>
<label>Марка</label>
<select name="form_mark" id="type" size="5" >
 
<?php
$category = mysql_query("SELECT mark,ID FROM models",$link);
     
If (mysql_num_rows($category) > 0)
{
$result_category = mysql_fetch_array($category);
do
{
  if($result_category["mark"] != ''){
   
  echo '<option value="'.$result_category["ID"].'" >'.$result_category["mark"].'</option>';
  }
}
 while ($result_category = mysql_fetch_array($category));
}
?> 
 
</select>
</li>

 
<li>
<label>Категория</label>
<select name="form_category" size="5" >
 
<?php
$category = mysql_query("SELECT category,ID FROM models",$link);
     
If (mysql_num_rows($category) > 0)
{
$result_category = mysql_fetch_array($category);
do
{
  if($result_category["category"] != ''){
  echo '<option value="'.$result_category["ID"].'" >'.$result_category["category"].'</option>';
  }   
}
 while ($result_category = mysql_fetch_array($category));
}
?> 
 
</select>
</ul> 
<label class="stylelabel" >Основная картинка</label>
 
<div id="baseimg-upload">
<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
<input type="file" name="upload_image" />
 
</div>
 
<label class="stylelabel" >Галлерея картинок</label>
 
<div id="objects" >
 
<div id="addimage1" class="addimage">
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
<input type="file" name="galleryimg[]" />
</div>
 
</div>
 
<p id="add-input" >Добавить</p>
      
<h3 class="h3title" >Настройки товара</h3>   
<ul id="chkbox">
<li><input type="checkbox" name="chk_visible" id="chk_visible" /><label for="chk_visible" >Показывать товар</label></li>
</ul> 
    <p align="right" ><input type="submit" id="submit_form" name="submit_add" value="Добавить товар"/></p> 
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