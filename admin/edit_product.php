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
 
  $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='tovar.php' >Товары</a> \ <a>Изменение товара</a>";
   
  include("include/db_connect.php");
  include("include/functions.php"); 
  $id = clear_string($_GET["id"]);
  $action = clear_string($_GET["action"]);
if (isset($action))
{
   switch ($action) {
 
        case 'delete':
         if (file_exists("../uploads_images/".$_GET["img"]))
        {
          unlink("../uploads_images/".$_GET["img"]);  
        }
        break;
 
    } 
}
    if ($_POST["submit_save"])
    {
    if ($_SESSION['edit_tovar'] == '1')
    { 
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
           
       if (!$_POST["form_category"])
      {
         $error[] = "Укажите категорию";         
      }else
      {
        $result = mysql_query("SELECT * FROM category WHERE id='{$_POST["form_category"]}'",$link);
        $row = mysql_fetch_array($result);
        $selectbrand = $row["brand"];
 
      }
  
  
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
       
 // Проверка чекбоксов
       
       if ($_POST["chk_visible"])
       {
          $chk_visible = "1";
       }else { $chk_visible = "0"; }
       
       if ($_POST["chk_new"])
       {
          $chk_new = "1";
       }else { $chk_new = "0"; }
       
       if ($_POST["chk_leader"])
       {
          $chk_leader= "1";
       }else { $chk_leader = "0"; }
       
       if ($_POST["chk_sale"])
       {
          $chk_sale = "1";
       }else { $chk_sale = "0"; }                   
       
                                       
       if (count($error))
       {           
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
             
       }else
       {
                            
       $querynew = "title='{$_POST["form_title"]}',price='{$_POST["form_price"]}',brand='$selectbrand',seo_words='{$_POST["form_seo_words"]}',seo_description='{$_POST["form_seo_description"]}',mini_description='{$_POST["txt1"]}',description='{$_POST["txt2"]}',mini_features='{$_POST["txt3"]}',features='{$_POST["txt4"]}',new='$chk_new',leader='$chk_leader',sale='$chk_sale',visible='$chk_visible',type_tovara='{$_POST["form_type"]}',brand_id='{$_POST["form_category"]}'"; 
            
       $update = mysql_query("UPDATE cars SET $querynew WHERE ID = '$id'",$link); 
                    
      $_SESSION['message'] = "<p id='form-success'>Товар успешно изменен!</p>";
                 
}
}
else
    {
       $msgerror = 'У вас нет прав на изменение товара!'; 
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
<?php
    $result = mysql_query("SELECT * FROM cars WHERE ID='$id'",$link);
     
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
     
echo '
 
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
';    
     
$category = mysql_query("SELECT * FROM models",$link);
     
If (mysql_num_rows($category) > 0)
{
$result_category = mysql_fetch_array($category);
 
if ($row["type_tovara"] == "mobile") $type_mobile = "selected";
if ($row["type_tovara"] == "notebook") $type_notebook = "selected";
if ($row["type_tovara"] == "notepad") $type_notepad = "selected";
 
 
 
echo '
<li>
<label>Тип товара</label>
<select name="form_type" id="type" size="1" >
 
<option '.$type_mobile.' value="mobile" >Мобильные телефоны</option>
<option '.$type_notebook.' value="notebook" >Ноутбуки</option>
<option '.$type_notepad.' value="notepad" >Планшеты</option>
 
</select>
</li>
 
<li>
<label>Категория</label>
<select name="form_category" size="10" >
';
 
 
do
{
   
  echo '
   
  <option value="'.$result_category["id"].'" >'.$result_category["type"].'-'.$result_category["brand"].'</option>
   
  ';
     
}
 while ($result_category = mysql_fetch_array($category));
}
echo '
</select>
</ul> 
';
 
   if  (strlen($row["Image"]) > 0 && file_exists("../uploads_images/".$row["Image"]))
{
$img_path = '../uploads_images/'.$row["Image"];
$max_width = 110; 
$max_height = 110; 
 list($width, $height) = getimagesize($img_path); 
$ratioh = $max_height/$height; 
$ratiow = $max_width/$width; 
$ratio = min($ratioh, $ratiow); 
// New dimensions 
$width = intval($ratio*$width); 
$height = intval($ratio*$height); 
 
echo '
<label class="stylelabel" >Основная картинка</label>
<div id="baseimg">
<img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
<a href="edit_product.php?id='.$row["ID"].'&img='.$row["Image"].'&action=delete" >Удалить</a>
</div>
 
';
    
}else
{  
echo '
<label class="stylelabel" >Основная картинка</label>
 
<div id="baseimg-upload">
<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
<input type="file" name="upload_image" />
 
</div>
';
}
 
echo '
 
<label class="stylelabel" >Галлерея картинок</label>
 
<div id="objects" >
 
<div id="addimage1" class="addimage">
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
<input type="file" name="galleryimg[]" />
</div>
 
</div>
 
<p id="add-input" >Добавить</p>
  
<ul id="gallery-img"> 
 ';
  
$query_img = mysql_query("SELECT * FROM uploads_images WHERE product_id='$id'",$link);
 
If (mysql_num_rows($query_img) > 0)
{
     
$result_img = mysql_fetch_array($query_img);
do
{
if  (strlen($result_img["image"]) > 0 && file_exists("../uploads_images/".$result_img["image"]))
{
$img_path = '../uploads_images/'.$result_img["image"];
$max_width = 100; 
$max_height = 100; 
 list($width, $height) = getimagesize($img_path); 
$ratioh = $max_height/$height; 
$ratiow = $max_width/$width; 
$ratio = min($ratioh, $ratiow); 
// New dimensions 
$width = intval($ratio*$width); 
$height = intval($ratio*$height);  
 
}else
{
$img_path = "./images/noimages.png";
$width = 80;
$height = 70;
}
 
echo ' 
 <li id="del'.$result_img["id"].'" >
 <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" title="'.$result_img["image"].'" />
 ';
 if ($_SESSION['edit_tovar'] == '1')
 {
  echo '
 <a class="del-img" img_id="'.$result_img["id"].'" ></a>       
';   
 }
echo '</li>';  
}while ($result_img = mysql_fetch_array($query_img));
}  
echo ' 
 </ul>  
';
if ($row["visible"] == '1') $checked1 = "checked";
echo ' 
<h3 class="h3title" >Настройки товара</h3>   
<ul id="chkbox">
<li><input type="checkbox" name="chk_visible" id="chk_visible" '.$checked1.' /><label for="chk_visible" >Показывать товар</label></li>
</ul> 
 
 
    <p align="right" ><input type="submit" id="submit_form" name="submit_save" value="Сохранить"/></p>     
</form>
';
 
}while ($row = mysql_fetch_array($result));
}
?> 
 
 
 
 
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