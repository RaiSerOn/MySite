<?php
  define('lock_key',true);
	include("includes/db_connect.php");
  include("functions/functions.php");
  session_start();
  include("includes/auth_cookie.php");
  include("includes/count.php");

  $id = clear_string($_GET["id"]);
  $seoquery = mysql_query("SELECT seo_words,seo_description FROM cars WHERE ID='$id' AND visible='1'",$link);
      
  If (mysql_num_rows($seoquery) > 0)
  {
    $resquery = mysql_fetch_array($seoquery);
  }   
  If($id != $_SESSION['countid']){
    $querycount = mysql_query("SELECT count FROM cars WHERE ID = '$id'",$link);
    $resultcount = mysql_fetch_array($querycount);
    $newcount = $resultcount["count"] + 1;
    $update = mysql_query("UPDATE cars SET count = '$newcount' WHERE ID = '$id'",$link);
  }
  $_SESSION['countid'] = $id;

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
    <meta name="Description" content="<? echo $resquery["seo_description"]; ?>"/>
    <meta name="keywords" content="<? echo $resquery["seo_words"]; ?>" /> 
    <title>Главная страница</title>
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="/js/code.js"></script> 
    <script type="text/javascript" src="/js/TextChange.js"></script>
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox.css" />
    <script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="js/jTabs.js"></script>
     <script type="text/javascript" src="/js/jcarousellite_1.0.1.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
  
    $("ul.tabs").jTabs({content: ".tabs_content", animate: true, effect:"fade"}); 
    $(".image-modal").fancybox(); 
     
}); 
</script>
  </head>
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
                  echo'<div class="col-xs-6 visible-xs descriptor-3" style="padding-bottom: 9px !important;"><h5 style="margin-top: 0 !important;">личный кабинет</h5><a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal2">войти</a>
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
                  echo'<div class="col-lg-9 descriptor2" style="text-align: center;padding-bottom: 9px !important;"><h4 style="text-align: center;">личный кабинет</h4><a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal2">вход</a>
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
  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
              <li><a style="color: #fff" href="index3.php">Каталог машинок</a></li>
              <li><a style="color: #fff" href="feedback.php">Отзывы</a></li>
              <li><a style="color: #fff" href="#contacts">Контакты</a></li>
              <li><a style="color: #fff" href="#">Оплата и доставка</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="container-fluid" style="background-image: url(/img/rockywall.png);">
    <div class="card" style="background-image: url(/img/rockywall.png); padding: 0px 0px 3em 0px;">
      <div class="container">
        <div class="wrapper row">
    <?php
      $result = mysql_query("SELECT * FROM cars WHERE ID ='$id' AND visible='1'",$link);
      If (mysql_num_rows($result) > 0)
      {
      $row1 = mysql_fetch_array($result);
      do
      {   
      if  (strlen($row1["Image"]) > 0 && file_exists("./uploads_images/".$row1["Image"]))
      {
      $img_path = './uploads_images/'.$row1["Image"];
      $max_width = 300; 
      $max_height = 300; 
       list($width, $height) = getimagesize($img_path); 
      $ratioh = $max_height/$height; 
      $ratiow = $max_width/$width; 
      $ratio = min($ratioh, $ratiow); 
       
      $width = intval($ratio*$width); 
      $height = intval($ratio*$height);    
      }else
      {
      $img_path = "/images/no-image.png";
      $width = 110;
      $height = 200;
      }     
       
       
      echo  '
          <div class="preview col-md-6">       
            <div class="preview-pic tab-content">
              <div class="tab-pane active" id="pic-1">
              ';
      If($row1["Howmany"] <= 0){
              echo'  <div style="position: absolute; margin: 0; top: 60px; left: 30px; width: 300px; height: 100px; background-color: rgba(0, 100, 0, 0.7);">
                  <img src="/img/stop.jpg" style="width: 100px; height: 100px; float: left;"/>
                  <p style="margin-top: 30px; color: yellow; font-size: large;">Товар в данный момент не в наличии!</p>
                </div>';
      }
      echo '
                <img oncontextmenu="return false;" src="'.$img_path.'" /></div>
            </div>


    
          </div>
          <div class="details col-md-6 col-xs-12">
            <h3 class="product-title hidden-xs">'.$row1["Title"].'</h3>
            <h5 class="product-title visible-xs" >'.$row1["Title"].'</h5>
            <ul style="padding: 0px;" id="views-block">
            <li  style="float: left;"><p>Просмотров   </p></li>
            <li style="float: left; margin-left: 10px;"><i class="fa fa-eye" aria-hidden="true" style="width: 40px;"> '.$row1['count'].'</i></li>
            
            <li style="float: left; padding-left: 15px;"><i class="fa fa-thumbs-up" id="likegoodcount" aria-hidden="true" style="width: 45px;"> '.$row1['yes_like'].'</i></li>
            <li>
              ';
              if($_SESSION['likeid'] != $row1["ID"]){
                  echo '<p id="likegood" tid="'.$row1["ID"].'" class="btn btn-success btn-xs">Нравится</p>';
              } else {
                  echo '<p id="likegood" tid="'.$row1["ID"].'" class="btn btn-warning btn-xs">Уже нравится</p>';
              }
              echo '
            </li>
            </ul>
            <p class="product-description">Тип: '.$row1["Type"].'; Производитель: '.$row1["Producer"].'; Модель: '.$row1["Model"].'; Масштаб: '.$row1["Scale"].'; Материал: '.$row1["Material"].'; Страна: '.$row1["Production"].'; Ограничение: '.$row1["Limitation"].';</p>
            <h5 class="sizes">Описание: 
              <p>'.$row1["Intro"].'</p>            
            </h5>
            <h4 class="price">Цена: <span>'.group_numerals($row1["Price"]).' </span>руб.</h4>
            <div class="action">
            ';
            If($row1["Howmany"] > 0){
              echo '<button class="add_blockk " tird="'.$id.'" type="button" >Добавить в корзину</button>
            </div>
          </div>       
            ';
            }
      }
       while ($row1 = mysql_fetch_array($result));
       $result = mysql_query("SELECT * FROM uploads_images WHERE product_id='$id'",$link);
      If (mysql_num_rows($result) > 0)
      {
      $row = mysql_fetch_array($result);
      echo '</div><div class="row"><div id="block-img-slide">
            <ul>';
      do
      { 
      $img_path = './uploads_images/'.$row["image"];
      $max_width = 120; 
      $max_height = 80; 
       list($width, $height) = getimagesize($img_path); 
      $ratioh = $max_height/$height; 
      $ratiow = $max_width/$width; 
      $ratio = min($ratioh, $ratiow); 
      $width = intval($ratio*$width); 
      $height = intval($ratio*$height);     
      echo '
      <li>
      <a class="image-modal" href="#image'.$row["id"].'"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" /></a>
      </li>
      <a style="display:none;" class="image-modal" rel="group" id="image'.$row["id"].'" ><img oncontextmenu="return false;" src="./uploads_images/'.$row["image"].'" /></a>
      ';
      }
       while ($row = mysql_fetch_array($result));
       echo '
       </ul>
       </div>    
            ';
      }
      }
    ?>
            </div>
      </div>
    </div>
  </div>

  


  <section id="random" class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
    <?php
      include("block-random.php");
    ?>
  </section>
  <section id="footer" class="col-sm-12 col-lg-12 col-xs-12 hidden-sm">
    <?php
      include("footer.php");
    ?>
  </section>
   <div class="scroll-top-wrapper" id="scroll-top-wrapper" style="color: white;">
      <span class="scroll-top-inner">
        <p  id="block-basket"><i style="width: 40px;" class="fa fa-shopping-cart fa-1x" aria-hidden="true"></i><a href="cart.php?action=onclick" style="width: 180px; margin-left: 9px; margin-top: 5px;font-size: 17px; text-decoration: none;"></a></p>
      </span>
    </div>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script>
      $(document).ready(
          function() {
              $("html").niceScroll({cursorcolor:"#000",smoothscroll:true,mousescrollstep: 80,scrollspeed: 120});
          }
      );
    </script>
    <div class="how-many animated" id="how-many" style=" width: 240px; height: 40px;background-color: #008000; opacity: 0; color: white; line-height: 20px; border-radius: 0 5px 5px 0;"><i class="fa fa-users" aria-hidden="true" style="width: 25px;float: left; margin-left: 5px; margin-top: 12px;"></i><p id="how-many-i" style="float: left; width: 200px;"></p></div>
  </body>
</html>