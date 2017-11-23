<?php
  define('lock_key',true);
	include("includes/db_connect.php");
  include("functions/functions.php");
  session_start();
  include("includes/auth_cookie.php");
  include("includes/count.php");

  $id = clear_string($_GET["id"]);
  $action = clear_string($_GET["actionz"]);

  switch($action){
    case 'clear':
      $clear = mysql_query("DELETE FROM cart WHERE cart_ip ='{$_SERVER['REMOTE_ADDR']}'",$link);
      break;
    case 'delete':
      $clear = mysql_query("DELETE FROM cart WHERE cart_id ='$id' AND cart_ip ='{$_SERVER['REMOTE_ADDR']}'",$link);
      break;
  }
  if (isset($_POST["submitdata"]))
  {
    
    $_SESSION["order_delivery"] = $_POST["order_delivery"];
    $_SESSION["order_address"] = $_POST["order_address"];
    $_SESSION["order_note"] = $_POST["order_note"]; 
  if ( $_SESSION['auth'] == 'yes_auth' ) 
  {
         
    mysql_query("INSERT INTO orders(order_datetime,order_dostavka,order_fio,order_phone,order_note,order_address,order_email,order_ip,order_specialname,order_type)
                        VALUES( 
                             NOW(),
                            '".$_POST["order_delivery"]."',                 
                            '".$_SESSION['auth_surname'].' '.$_SESSION['auth_name'].' '.$_SESSION['auth_patronymic']."',
                            '".$_SESSION['auth_phone']."',
                            '".$_POST['order_note']."',
                            '".$_POST["order_address"]."',
                            '".$_SESSION['auth_email']."',
                            '".$_SERVER['REMOTE_ADDR']."',
                            '".$_SESSION['auth_name']."', 
                            '".$_SESSION["order_type"]."'
                            )",$link);         
 
 }                        
$_SESSION["order_id"] = mysql_insert_id(); 
                        
                             
$result = mysql_query("SELECT * FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}'",$link);
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);    
 
do{
 
    mysql_query("INSERT INTO buy_products(buy_id_order,buy_id_product,buy_count_product,buy_name)
                        VALUES( 
                            '".$_SESSION["order_id"]."',                    
                            '".$row["cart_id_product"]."',
                            '".$row["cart_count"]."',
                            '".$_SESSION["order_type"]."'                  
                            )",$link);
   
 
 
 
} while ($row = mysql_fetch_array($result));


}
                             
header("Location: cart.php?action=completion");
}  
$result = mysql_query("SELECT * FROM cart,cars WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cars.ID = cart.cart_id_product",$link);
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
 
do
{ 
$int = $int + ($row["Price"] * $row["cart_count"]); 
}
 while ($row = mysql_fetch_array($result));
  
 
   $itogpricecart = $int;
}         

?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корзина</title>
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="/js/code.js"></script> 
    <script type="text/javascript" src="/js/TextChange.js"></script>
    <link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox.css" />
    <script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="js/jTabs.js"></script>
     <script type="text/javascript" src="/js/jcarousellite_1.0.1.js"></script>
  </head>
  <body>
  </head>
  <body>
  <header>
    <div id="block-user">
      <ul>
        <li><i class="fa fa-cog fa-fw" aria-hidden="true"></i><a class="profile" href="profile.php">Кабинет</a></li>
        <li><i class="fa fa-caret-square-o-right" aria-hidden="true"></i><a id="logout">Выход</a></li>
      </ul>
    </div>
    <div class="container header-main">
      <div class="row header-line">
        <div class="col-lg-2 hidden-xs logotype">
          <a href="index.php"><img src="img/logo.png" alt="Логотип сайта" class="img-responsive visible-lg"></a>
        </div>
          <?php
                if($_SESSION['auth'] == 'yes_auth'){
                  echo'<div class="col-xs-6 visible-xs descriptor-3" style="padding-bottom: 8px !important;"><a class="auth-user-info">'.$_SESSION['auth_name'].'</a><br><a class="profile btn btn-warning btn-xs" href="profile.php"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>Кабинет</a>
          <a id="logout" class="btn btn-danger btn-xs"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i>Выход</a><br></div>';
                } else {
                  echo'<div class="col-xs-6 visible-xs descriptor-3" style="padding-bottom: 9px !important;"><h5 style="margin-top: 0 !important;">личный кабинет</h5><a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">войти</a>
                      <a class="btn btn-success btn-xs" href="registration.php">создать</a></div>';
                }
              ?>
        <div class="col-xs-6 visible-xs descriptor-4">
          <h5>ваш заказ</h5>
          <p id="block-basket"><a href="cart.php?action=onclick">корзина пуста</a></p>
        </div>
        <div class="col-lg-3 col-xs-5 user-info-header hidden-xs">
          <div class="row">
            <div class="col-lg-3 text-center descriptor1">
              <i class="fa fa-user fa-5x visible-lg" aria-hidden="true"></i>
            </div>

              <?php
                if($_SESSION['auth'] == 'yes_auth'){
                  echo'<div class="col-lg-9 descriptor2" style="text-align: center;padding-bottom: 8px !important;"><a class="auth-user-info">'.$_SESSION['auth_name'].'</a><br><br><a class="profile btn btn-warning btn-xs" href="profile.php"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>Кабинет</a>
          <a id="logout" class="btn btn-danger btn-xs"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i>Выход</a></div>';
                } else {
                  echo'<div class="col-lg-9 descriptor2" style="text-align: center;padding-bottom: 9px !important;"><h4 style="text-align: center;">личный кабинет</h4><a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">вход</a>
               | 
              <a class="btn btn-success btn-xs" href="registration.php">регистрация</a></div>';
                }
              ?>
          </div>
        </div>
        <div class="col-lg-3 col-xs-5 cart-header col-xs-offset-1 col-lg-offset-1 hidden-xs" style="text-align: center;">
          <div class="row">
            <div class="col-lg-4 text-center description-main ">
              <i id="arrow1" class="fa fa-shopping-cart fa-5x visible-lg" aria-hidden="true"></i>
            </div>
            <div class="col-lg-8 description-second">
              <h4>ваш заказ</h4>
              <p id="block-basket"><a href="cart.php?action=onclick"> ваша корзина пуста</a></p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 visible-lg phone_number">
          <div class="row">
            <div class="col-lg-11 col-lg-offset-1 phone-number">
              <h3><a href="tel:+79881848057">8 (988) 184-80-57</a></h3>
              <p>Режим работы с 9 <sup>00</sup> до 18 <sup>00</sup> </p>
            </div>
            <div class="col-lg-1"></div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Войти в профиль</h4>
        </div>
        <div class="modal-body">
        <form method="POST" action="">
          <ul id="input-email-pass">
            <div class="text-center" style="padding:50px 0">
              <div class="logo">Вход</div>
              <!-- Main Form -->
              <div class="login-form-1">
                  <div class="login-form-main-message"></div>
                  <div class="main-login-form">
                    <div class="login-group">
                      <div class="form-group">
                      <p id="message-auth">неверный логин и(или) пароль</p>
                        <label for="auth_login" class="sr-only">Логин</label>
                        <input type="text" class="form-control" id="auth_login" name="auth_login" placeholder="Логин">
                      </div>
                      <div class="form-group">
                        <label for="auth_pass" class="sr-only">Пароль</label>
                        <input type="password" class="form-control" id="auth_pass" name="auth_pass" placeholder="Пароль">
                      </div>
                      <div class="form-group login-group-checkbox">
                        <input type="checkbox" id="rememberme" name="rememberme">
                        <label for="rememberme">Запомнить меня</label>
                      </div>
                    </div>
                    <p class="button-auth" id="button-auth"><i class="fa fa-chevron-right"></i></p>
                  </div>
                  <div class="etc-login-form">
                    <p>Забыли пароль? <a id="remindpass">Нажмите сюда</a></p>
                    <p>Новый пользователь? <a href="registration.php">Создайте новый аккаунт</a></p>
                  </div>
              </div>
              <!-- end:Main Form -->
            </div>
            </ul>
          </form>
          <!-- FORGOT PASSWORD FORM -->
          <div class="text-center" id="block-remind" style="padding:50px 0;">
            <div class="logo">Восстанавливаем пароль</div>
            <!-- Main Form -->
            <div class="login-form-1">
              <form id="forgot-password-form" class="text-left">
                <div class="etc-login-form">
                  <p id="message-remind" class="message-remind-success"></p>
                  <p>Как только вы введёте свой почтовый адрес, вы получите на него уведомление с новым паролем</p>
                </div>
                <div class="login-form-main-message"></div>
                <div class="main-login-form">
                  <div class="login-group">
                    <div class="form-group">

                      <label for="fp_email" class="sr-only">E-mail почта</label>
                      <input type="text" class="form-control remind-email" id="remind-email" name="remind-email" placeholder="E-mail почта">
                    </div>
                  </div>
                  <p class="login-button" id="button-remind"><i style="margin-left: 15px;" class="fa fa-chevron-right"></i></p>
                </div>
                <div class="etc-login-form">
                  <p>Уже есть аккаунт? <a id="prev-auth">Войдите здесь</a></p>
                  <p>Новый пользователь? <a href="registration.php">Создайте новый аккаунт</a></p>
                </div>
              </form>
            </div>
            <!-- end:Main Form -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        </div>
      </div>
    </div>
  </div>

 <div class="container searcher">
    <div class="row">
      <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <a href="index.php"><img src="img/logo.png" alt="Логотип сайта" class="img-responsiv img-responsiv-xs hidden-lg hidden-md hidden-sm"></a>
          <div class="navbar-toggle" style="border: 0; padding: 0;">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu" style="margin: 0;">
              <span class="sr-only">Вход в меню</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse" id="responsive-menu">
            <ul id="ul-nav" class="nav navbar-nav">
              <li><a style="color: #fff" href="index.php">Главная</a></li>
              <li><a style="color: #fff" href="index3.php">Каталог моделей</a></li>
              <li><a style="color: #fff" href="feedback.php">Отзывы</a></li>
              <li><a style="color: #fff" href="#contacts">Контакты</a></li>
              <li><a style="color: #fff" href="#">Оплата и доставка</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

<section>
  <div class="container-fluid NewModell">
  <div class="container">
    <div class="row">
      <div class="NewModelButton col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php

        $action = clear_string($_GET["action"]);
        switch ($action) {

        case 'onclick':

        echo '   
        <div id="name-step" class="col-lg-12 col-md-12 col-sm-12 hidden-xs">  
        <ul>
        <li><a class="active" >1. Корзина товаров</a></li>
        <li><span>&rarr;</span></li>
        <li><a>2. Контактная информация</a></li>
        <li><span>&rarr;</span></li>
        <li><a>3. Завершение</a></li> 
        <li><span>&rarr;</span></li>
        <li><a>4. Отправка письма</a></li> 
        </ul>  
        </div>
        <div id="block-step" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  

        ';
              $_SESSION["order_type"] = "";

              $num = 10;
              $page = (int)$_GET['page'];

              $count = mysql_query("SELECT COUNT(*) FROM cart,cars WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cars.ID = cart.cart_id_product",$link);
              $temp = mysql_fetch_array($count);

/*              Подсчёт общей суммы !!!!!!!! */

              $counter = mysql_query("SELECT SUM(cart_price) FROM cart,cars WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cars.ID = cart.cart_id_product",$link);
              $tempest = mysql_fetch_array($counter);

/*              Подсчёт общей суммы !!!!!!!! */

              if($temp[0] > 0){
                $tempcount = $temp[0];
                $total = (($tempcount - 1) / $num) + 1;
                $total = intval($total);

                $page = intval($page);
                if(empty($page) or $page < 0) $page = 1;
                if($page > $total) $page = $total;

                  $start = $page * $num - $num;
                  $qury_start_num = "LIMIT $start, $num";
                }
        $result = mysql_query("SELECT * FROM cart,cars WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cars.ID = cart.cart_id_product $qury_start_num",$link);

        If (mysql_num_rows($result) > 0)
        {
        $row = mysql_fetch_array($result);


        echo '  
        <a href="cart.php?actionz=clear" class="btn btn-danger clear-fix">Очистить</a>
        </div> 
        <div class="table-responsive table table-cart">
        <table class="table">   
        <tr> 
        <td id="head1" class="col-xs-3">Изображение</td>
        <td id="head2" class="col-xs-3">Наименование товара</td>
        <td id="head3" class="col-xs-1 hidden-xs">Кол-во</td>
        <td id="head4" class="col-xs-3">Цена</td>
        <td class="col-xs-2"></td>
        </tr>
        ';


        do
        {
        $all_price = $all_price + $tempest[0];

        if  (strlen($row["Image"]) > 0 && file_exists("./uploads_images/".$row["Image"]))
        {
        $img_path = './uploads_images/'.$row["Image"];
        $max_width = 200; 
        $max_height = 200; 
        list($width, $height) = getimagesize($img_path); 
        $ratioh = $max_height/$height; 
        $ratiow = $max_width/$width; 
        $ratio = min($ratioh, $ratiow); 

        $width = intval($ratio*$width); 
        $height = intval($ratio*$height);    
        }else
        {
        $img_path = "/images/noimages.jpeg";
        $width = 120;
        $height = 105;
        } 
        echo '

        <tr>

        <td class="col-xs-3">
        <p align="center"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" /></p>
        </td>

        <td class="col-xs-4">
        <p><a href="view_content.php?id='.$row["ID"].'">'.$row["Title"].'</a></p>
        </td>

        <td class="col-xs-1 hidden-xs">
        <p align="center"><input class="input-id" readonly id=" input-id'.$row["cart_id"].'" iid="'.$row["cart_id"].'" class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'" /></p>
        </td>
        <td class="col-xs-3"><h5><span class="span-count" >'.$row["cart_count"].'</span> x <span>'.$row["cart_price"].'</span></h5><p price="'.$row["cart_price"].'" >'.group_numerals($row["cart_count"]*$row["cart_price"]).' руб</p></td>
        <td class="col-xs-1"><a  href="cart.php?page='.$page.'&id='.$row["cart_id"].'&actionz=delete" ><p><i class="fa-times fa btn btn-default hidden-xs"></i></p></a></td>

        ';
        $_SESSION["order_type"] .= "  ".$row["Title"];
        
        }
        while ($row = mysql_fetch_array($result));
        echo '</tr>
        </table>
        </div>';
        if ($page != 1)  $pstr_prev = '<li><a class="btn btn-default pstr-prev" href="cart.php?action=onclick&page='.($page - 1).'">&lt;</a></li>';
          if ($page != $total)  $pstr_next = '<li><a class="btn btn-default pstr-next" href="cart.php?action=onclick&page='.($page + 1).'">&gt;</a></li>';
          if($page - 5 > 0) $page5left = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page - 5).'">'.($page - 5).'</a></li>';
          if($page - 4 > 0) $page4left = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page - 4).'">'.($page - 4).'</a></li>';
          if($page - 3 > 0) $page3left = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page - 3).'">'.($page - 3).'</a></li>';
          if($page - 2 > 0) $page2left = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page - 2).'">'.($page - 2).'</a></li>';
          if($page - 1 > 0) $page1left = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page - 1).'">'.($page - 1).'</a></li>';

          if($page + 5 <= $total) $page5right = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page + 5).'">'.($page + 5).'</a></li>';
          if($page + 4 <= $total) $page4right = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page + 4).'">'.($page + 4).'</a></li>';
          if($page + 3 <= $total) $page3right = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page + 3).'">'.($page + 3).'</a></li>';
          if($page + 2 <= $total) $page2right = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page + 2).'">'.($page + 2).'</a></li>';
          if($page + 1 <= $total) $page1right = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page + 1).'">'.($page + 1).'</a></li>';
          if($page + 5 < $total){
            $strtotal = '<li><p class="nav-point">...</p></li><li><a class="btn btn-default" href="cart.php?action=onclick&page='.$total.'">'.$total.'</a></li>';
          } else {
            $strtotal ="";
          }
          if($total > 1){
            echo'
              <div class="pstrnav">
                <ul>
            ';
            echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active btn btn-default' href='cart.php?action=onclick&page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
              echo'
                </ul>
              </div>
            ';
          }

        echo '
        <h2 class="itog-price" align="right">Итого: <strong>'.group_numerals($int).'</strong> руб</h2>
        <div class="row button-next-block">
          <p ><a href="cart.php?action=confirm" class="button-next btn btn-success" >Далее</a></p> 
        </div>
        ';

        } 
        else
        {
        echo '<div id="clear-cart-null" style="height: 450px;"><h3 id="clear-cart" align="center">Корзина пуста</h3></div>';
        }



        break;

        case 'confirm':     

        echo ' 
        <div id="name-step" class="col-lg-12 col-md-12 col-sm-12 hidden-xs name-step-2">  
        <ul>
        <li><a href="cart.php?action=oneclick" class="pointerrr">1. Корзина товаров</a></li>
        <li><span>&rarr;</span></li>
        <li><a class="active">2. Контактная информация</a></li>
        <li><span>&rarr;</span></li>
        <li><a>3. Завершение</a></li> 
        <li><span>&rarr;</span></li>
        <li><a>4. Отправка письма</a></li> 
        </ul>  
        </div>
        <div id="block-step" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 

        '; 
        if ( $_SESSION['auth'] == 'yes_auth' ) 
        {   

        if ($_SESSION['order_delivery'] == "По почте") $chck1 = "checked";
        if ($_SESSION['order_delivery'] == "Самовывоз") $chck3 = "checked"; 

        echo '

        <h3 class="title-h3" >Способы доставки:</h3>
        <form method="post" action="cart.php?action=completion" style="margin-bottom: 10px;">
        <ul id="info-radio">
        <li>
        <input type="radio" name="order_delivery" class="order_delivery form-control" id="order_delivery1" value="По почте" '.$chck1.'  />
        <label class="label_delivery" for="order_delivery1">По почте</label>
        </li>
        <li>
        <input type="radio" name="order_delivery" class="order_delivery form-control" id="order_delivery3" value="Самовывоз" '.$chck3.' />
        <label class="label_delivery" for="order_delivery3">Самовывоз</label>
        </li>
        </ul>
        <h3 class="title-h3" >Информация для доставки:</h3>
        <ul id="info-order">
        ';

        echo '
        <li><label class="order_label_style" for="order_address"><span>*</span>Адрес доставки</label><input class="form-control input-step-2" type="text" name="order_address" id="order_address" value="'.$_SESSION["order_address"].'" /><span>Пример: г. Москва,<br /> ул Интузиастов д 18, кв 58</span></li>
        ';


        echo '
        <li><label class="order_label_style" for="order_note">Примечание</label><textarea name="order_note" class="form-control input-step-3" >'.$_SESSION["order_note"].'</textarea><span>Уточните информацию о заказе.<br />  Например, удобное время для звонка<br />  нашего менеджера</span></li>
        </ul>
        <span class="button-back" style="position: absolute;"><a href="cart.php?id=3&action=onclick" class="btn btn-primary">Вернуться</a></span>
        <span style="margin-left: 70%;"><input type="submit" name="submitdata" id="confirm-button-next" class="btn btn-success" value="Далее"/></span>
        </form>
        

        ';  
        } else {
        echo'<p style="color: #ffffff; text-align: center; margin-top: 50px;">Только авторизированные пользователи могут совершать покупки!<br> Авторизируйтесь на нашем сайте, прежде чем приступить к следующему шагу</p>
        <div class="row" align="center" style="margin: 10px; height: 400px;">
          <p  align="right" class="button-back btn btn-primary" ><a href="cart.php?id=3&action=onclick" >Вернуться</a></p>
          <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Вход</a>
        </div>';

        } ;  
        echo '</div>';
        break;

        case 'completion': 

        echo ' 
        <div id="block-step"> 
        <div id="name-step" class="col-lg-12 col-md-12 col-sm-12 hidden-xs name-step-3">  
        <ul>
        <li><a href="cart.php?action=oneclick" class="pointerrr">1. Корзина товаров</a></li>
        <li><span>&rarr;</span></li>
        <li><a href="cart.php?action=confirm" class="pointerrr">2. Контактная информация</a></li>
        <li><span>&rarr;</span></li>
        <li><a class="active" >3. Завершение</a></li> 
        <li><span>&rarr;</span></li>
        <li><a>4. Отправка письма</a></li> 
        </ul>  
        </div> 
        </div>

        <h3 class="final-information">Конечная информация:</3>
        '; 

        if ( $_SESSION['auth'] == 'yes_auth' ) 
        {
          $resulting = mysql_query("SELECT * FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}'",$link);
          $row1 = mysql_fetch_array($resulting);
        echo '
        <ul id="list-info" >
        <li><strong>Способ доставки:</strong>'.$_SESSION['order_delivery'].'</li>
        <li><strong>Email:</strong><input id="session-email" value="'.$_SESSION['auth_email'].'"></li>
        <li><strong>ФИО:</strong>'.$_SESSION['auth_surname'].' '.$_SESSION['auth_name'].' '.$_SESSION['auth_patronymic'].'</li>
        <li><strong>Адрес доставки:</strong>'.$_SESSION['order_address'].'</li>
        <li><strong>Телефон:</strong>'.$_SESSION['auth_phone'].'</li>
        <li><strong>Примечание: </strong>'.$_SESSION['order_note'].'</li>
        </ul>

       

        <h2 class="itog-price" align="right">Итого: <strong>'.$itogpricecart.'</strong> руб</h2>
        <span align="right" class="button-back" style="position: absolute;"><a href="cart.php?action=confirm" class="btn btn-primary">Вернуться</a></span>

        <a class="button-finish btn btn-success" id="button-finish" ido="'.$_SESSION["order_id"].'" prc="'.$itogpricecart.'"  style="margin-left: 70%; margin-bottom: 10px;" href="cart.php?actionz=clear&action=finish">Оплатить</a>
        ';
        } else echo'<h1 style="color: white;">Только для авторизованных пользователей!</h1>';
        break;

        case 'finish':
        echo '
          <div id="block-step" class="col-lg-12 col-md-12 col-sm-12 hidden-xs name-step-4"> 
          <div id="name-step">  
          <ul>
          <li><a class="pointerrr">1. Корзина товаров</a></li>
          <li><span>&rarr;</span></li>
          <li><a class="pointerrr">2. Контактная информация</a></li>
          <li><span>&rarr;</span></li>
          <li><a>3. Завершение</a></li> 
          <li><span>&rarr;</span></li>
          <li><a class="active">4. Отправка письма</a></li> 
          </ul>  
          </div> 
          </div>
          <div id="block-feedback">
            <h3>Спасибо за совершение покупки!</h3><br>
            <h3>На вашу почту ('.$_SESSION['auth_email'].') было отправлено письмо с реквизитами для оплаты!</h3><br>
            <h3>Войдите в свою почту для завершения операции</h3><br>
          </div>
          <div id="block-feedback">

          </div>

          <p  ><a class="button-next button-start btn btn-success"href="index.php" >На главную страницу</a></p>
        ';
        break;

        default:  
          
        echo ' 
        <div id="name-step" class="col-lg-12 col-md-12 col-sm-12 hidden-xs">  
        <ul>
        <li><a class="active" >1. Корзина товаров</a></li>
        <li><span>&rarr;</span></li>
        <li><a>2. Контактная информация</a></li>
        <li><span>&rarr;</span></li>
        <li><a>3. Завершение</a></li> 
        <li><span>&rarr;</span></li>
        <li><a>4. Отправка письма</a></li> 
        </ul>  
        </div>
        <div id="block-step" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  

        ';

              $num = 10;
              $page = (int)$_GET['page'];

              $count = mysql_query("SELECT COUNT(*) FROM cart,cars WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cars.ID = cart.cart_id_product",$link);
              $temp = mysql_fetch_array($count);

/*              Подсчёт общей суммы !!!!!!!! */

              $counter = mysql_query("SELECT SUM(cart_price) FROM cart,cars WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cars.ID = cart.cart_id_product",$link);
              $tempest = mysql_fetch_array($counter);

/*              Подсчёт общей суммы !!!!!!!! */

              if($temp[0] > 0){
                $tempcount = $temp[0];
                $total = (($tempcount - 1) / $num) + 1;
                $total = intval($total);

                $page = intval($page);
                if(empty($page) or $page < 0) $page = 1;
                if($page > $total) $page = $total;

                  $start = $page * $num - $num;
                  $qury_start_num = "LIMIT $start, $num";
                }
        $result = mysql_query("SELECT * FROM cart,cars WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cars.ID = cart.cart_id_product $qury_start_num",$link);

        If (mysql_num_rows($result) > 0)
        {
        $row = mysql_fetch_array($result);


        echo '  
        <a href="cart.php?actionz=clear" class="btn btn-danger clear-fix">Очистить</a>
        </div> 
        <div class="table-responsive table table-cart">
        <table class="table">   
        <tr> 
        <td id="head1" class="col-xs-3">Изображение</td>
        <td id="head2" class="col-xs-3">Наименование товара</td>
        <td id="head3" class="col-xs-1">Кол-во</td>
        <td id="head4" class="col-xs-3">Цена</td>
        <td class="col-xs-2"></td>
        </tr>
        ';


        do
        {
        $all_price = $all_price + $tempest[0];

        if  (strlen($row["Image"]) > 0 && file_exists("./uploads_images/".$row["Image"]))
        {
        $img_path = './uploads_images/'.$row["Image"];
        $max_width = 200; 
        $max_height = 200; 
        list($width, $height) = getimagesize($img_path); 
        $ratioh = $max_height/$height; 
        $ratiow = $max_width/$width; 
        $ratio = min($ratioh, $ratiow); 

        $width = intval($ratio*$width); 
        $height = intval($ratio*$height);    
        }else
        {
        $img_path = "/images/noimages.jpeg";
        $width = 120;
        $height = 105;
        } 
        $_SESSION["order_type"] .= "  ".$row["Title"];
        echo '

        <tr>

        <td class="col-xs-3">
        <p align="center"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" /></p>
        </td>

        <td class="col-xs-4">
        <p><a href="view_content.php?id='.$row["ID"].'">'.$row["Title"].'</a></p>
        </td>

        <td class="col-xs-1 hidden-xs">
        <p align="center"><input class="input-id" readonly id=" input-id'.$row["cart_id"].'" iid="'.$row["cart_id"].'" class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'" /></p>
        </td>
        <td class="col-xs-3"><h5><span class="span-count" >'.$row["cart_count"].'</span> x <span>'.$row["cart_price"].'</span></h5><p price="'.$row["cart_price"].'" >'.group_numerals($row["cart_count"]*$row["cart_price"]).' руб</p></td>
        <td class="col-xs-1"><a  href="cart.php?page='.$page.'&id='.$row["cart_id"].'&actionz=delete" ><p><i class="fa-times fa btn btn-default hidden-xs"></i></p></a></td>
        ';
        }
        while ($row = mysql_fetch_array($result));
        echo '</tr>
        </table>
        </div>';
        if ($page != 1)  $pstr_prev = '<li><a class="btn btn-default pstr-prev" href="cart.php?action=onclick&page='.($page - 1).'">&lt;</a></li>';
          if ($page != $total)  $pstr_next = '<li><a class="btn btn-default pstr-next" href="cart.php?action=onclick&page='.($page + 1).'">&gt;</a></li>';
          if($page - 5 > 0) $page5left = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page - 5).'">'.($page - 5).'</a></li>';
          if($page - 4 > 0) $page4left = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page - 4).'">'.($page - 4).'</a></li>';
          if($page - 3 > 0) $page3left = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page - 3).'">'.($page - 3).'</a></li>';
          if($page - 2 > 0) $page2left = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page - 2).'">'.($page - 2).'</a></li>';
          if($page - 1 > 0) $page1left = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page - 1).'">'.($page - 1).'</a></li>';

          if($page + 5 <= $total) $page5right = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page + 5).'">'.($page + 5).'</a></li>';
          if($page + 4 <= $total) $page4right = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page + 4).'">'.($page + 4).'</a></li>';
          if($page + 3 <= $total) $page3right = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page + 3).'">'.($page + 3).'</a></li>';
          if($page + 2 <= $total) $page2right = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page + 2).'">'.($page + 2).'</a></li>';
          if($page + 1 <= $total) $page1right = '<li><a class="btn btn-default" href="cart.php?action=onclick&page='.($page + 1).'">'.($page + 1).'</a></li>';
          if($page + 5 < $total){
            $strtotal = '<li><p class="nav-point">...</p></li><li><a class="btn btn-default" href="cart.php?action=onclick&page='.$total.'">'.$total.'</a></li>';
          } else {
            $strtotal ="";
          }
          if($total > 1){
            echo'
              <div class="pstrnav">
                <ul>
            ';
            echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active btn btn-default' href='cart.php?action=onclick&page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
              echo'
                </ul>
              </div>
            ';
          }

        echo '
        <h2 class="itog-price" align="right">Итого: <strong>'.group_numerals($int).'</strong> руб</h2>
        <div class="row button-next-block">
          <p ><a class="button-next btn btn-success" href="cart.php?action=confirm" >Далее</a></p> 
        </div>
        ';

        } 
        else
        {
        echo '<div id="clear-cart-null" style="height: 450px;"><h3 id="clear-cart" align="center">Корзина пуста</h3></div>';
        }
        break;      

        }

        ?>

        </div>
      </div>
    </div>
  </div>
  </div>
</section>
  <section id="random" class="hidden-xs col-md-12 col-lg-12 hidden-sm">
    <hr style="margin-bottom: 0;margin-top: 0;border: 1px solid #bbb;">
    <div id="block-random-tovar" style=" margin:auto ;margin-top: 60px; margin-bottom: 60px;">
    <ul >
    <?php
         
    $query_random = mysql_query("SELECT DISTINCT * FROM cars WHERE visible='1' ORDER by RAND() LIMIT 4",$link);  
     
    If (mysql_num_rows($query_random) > 0)
    {
    $res_query = mysql_fetch_array($query_random);
    do
    {

    $img_path = "/uploads_images/".$res_query[Image];
    $width = 120;
    $height = 120;
          
    echo '
    <li style="text-align: center;">
    <img oncontextmenu="return false;" src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
    <a class="random-title" href="view_content.php?id='.$res_query["ID"].'">'.$res_query["Title"].'</a><br><br>
    <span class="random-price">'.group_numerals($res_query["Price"]).' руб</span>
    ';
    If($res_query["Howmany"] > 0){
      echo '
    <a class="random-add-cart-cart btn btn-danger btn-xs" tird="'.$res_query["ID"].'">Купить</a>';
    }
    echo '</li>
    ';
     
    } while($res_query = mysql_fetch_array($query_random));
    }
    ?>
    </ul>
    </div>
  </section>


  <section id="footer">
    <?php
      include("footer.php");
    ?>
  </section>
  <script src="js/jquery.nicescroll.min.js"></script>
    <script>
      $(document).ready(
          function() {
              $("html").niceScroll({cursorcolor:"#000",smoothscroll:true,mousescrollstep: 80,scrollspeed: 120});
          }
      );
    </script>
  </body>
</html>