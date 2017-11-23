<?php
  define('lock_key',true);
  include("includes/db_connect.php");
  include("functions/functions.php");
  session_start();
  include("includes/auth_cookie.php");
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
    <title>Главная страница</title>
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/animate.css">
    <script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="/js/code.js"></script>  
    <script type="text/javascript" src="/js/TextChange.js"></script>
    <link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox.css" />
    <script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="js/jTabs.js"></script>
     <script type="text/javascript" src="/js/jcarousellite_1.0.1.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
  
      $("ul.tabs").jTabs({content: ".tabs_content", animate: true, effect:"fade"}); 
      $(".send-review").fancybox(); 
     
}); 
</script>
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
    <div class="feedback-input col-xs-12 col-md-12 col-sm-12 col-lg-12" style="height: 120px; margin-top: 10px;">
    <?php
        include("searcher.php");
      ?>
    </div>
    <div class="container-fluid feedbacking-block" style="background-color: #fff;" >
    <div class="container" style="padding-top:30px;">
        <h1 class="text-center" style="color: #FFFFFF">Отзывы</h1>
        <div class="row">
            <p id="link-send-review"><a href="#send-review" class="send-review btn btn-danger">Написать отзыв</a></p>
            <?php
                  $num = 10;
                  $page = (int)$_GET['page'];

                  $count = mysql_query("SELECT COUNT(*) FROM table_reviews WHERE moderate = '1' ORDER BY reviews_id DESC",$link);
                  $temp = mysql_fetch_array($count);

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

              $result = mysql_query("SELECT * FROM table_reviews WHERE moderate = '1' ORDER BY reviews_id DESC $qury_start_num",$link);
              If(mysql_num_rows($result) > 0){
                $row_reviews = mysql_fetch_array($result);
                do{
                  $loginuser = $row_reviews["nick"];
                  $avatar = mysql_query("SELECT avatar FROM reg_user WHERE login='$loginuser'",$link);
                  $avatarreview =  mysql_fetch_array($avatar);
                  $img_path = 'avatars/'.$avatarreview["avatar"];
                  echo'
                    <div class="col-sm-6 feddbacks">
                        <div id="tb-testimonial" class="testimonial testimonial-default-filled">
                            <div class="testimonial-section">
                                '.$row_reviews["comment"].'
                            </div>
                            <div class="testimonial-desc">
                                <img src="'.$img_path.'" alt="" width="100" hight="100"/>
                                <div class="testimonial-writer">
                                    <div class="testimonial-writer-name">'.$row_reviews["nick"].'</div>
                                    <div class="testimonial-writer-designation">'.$row_reviews["date"].'</div>
                                </div>
                            </div>
                        </div>   
                    </div>  
                  ';
                }
                while($row_reviews = mysql_fetch_array($result));
              }
              else{
                echo'<p class="title-no-info">Отзывов нет</p>';
              }
              if ($page != 1)  $pstr_prev = '<li><a class="btn btn-default pstr-prev" href="feedback.php?page='.($page - 1).'">&lt;</a></li>';
              if ($page != $total)  $pstr_next = '<li><a class="btn btn-default pstr-next" href="feedback.php?page='.($page + 1).'">&gt;</a></li>';
              if($page - 5 > 0) $page5left = '<li><a class="btn btn-default" href="feedback.php?page='.($page - 5).'">'.($page - 5).'</a></li>';
              if($page - 4 > 0) $page4left = '<li><a class="btn btn-default" href="feedback.php?page='.($page - 4).'">'.($page - 4).'</a></li>';
              if($page - 3 > 0) $page3left = '<li><a class="btn btn-default" href="feedback.php?page='.($page - 3).'">'.($page - 3).'</a></li>';
              if($page - 2 > 0) $page2left = '<li><a class="btn btn-default" href="feedback.php?page='.($page - 2).'">'.($page - 2).'</a></li>';
              if($page - 1 > 0) $page1left = '<li><a class="btn btn-default" href="feedback.php?page='.($page - 1).'">'.($page - 1).'</a></li>';

              if($page + 5 <= $total) $page5right = '<li><a class="btn btn-default" href="feedback.php?page='.($page + 5).'">'.($page + 5).'</a></li>';
              if($page + 4 <= $total) $page4right = '<li><a class="btn btn-default" href="feedback.php?page='.($page + 4).'">'.($page + 4).'</a></li>';
              if($page + 3 <= $total) $page3right = '<li><a class="btn btn-default" href="feedback.php?page='.($page + 3).'">'.($page + 3).'</a></li>';
              if($page + 2 <= $total) $page2right = '<li><a class="btn btn-default" href="feedback.php?page='.($page + 2).'">'.($page + 2).'</a></li>';
              if($page + 1 <= $total) $page1right = '<li><a class="btn btn-default" href="feedback.php?page='.($page + 1).'">'.($page + 1).'</a></li>';
              if($page + 5 < $total){
                $strtotal = '<li><p class="nav-point">...</p></li><li><a class="btn btn-default" href="feedback.php?page='.$total.'">'.$total.'</a></li>';
              } else {
                $strtotal ="";
              }
              if($total > 1){
                echo'
                  <div class="pstrnav pstrnav_prof">
                    <ul>
                ';
                echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active btn btn-default' href='feedback.php?page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
                  echo'
                    </ul>
                  </div>
                ';
              }
            ?>
            <div id="send-review" style="display: none;width: 500px;height: 350px;">

              <p align="center" id="title-review" style="font: 14px sans-serif;">Публикация отзыва производится после предварительной модерации.<br>Только авторизированные пользователи могут оставить сообщение!</p>
              <ul style="padding-left: 45px;">
              <li><p style="margin-left: 0px;"><label id="label-comment" style="position: absolute; font: 14px sans-serif;" >Комментарий<span>*</span></label><textarea id="comment_review" style="border:2px solid #D8D8D8;margin-left: 116px;width: 300px; height: 70px;"></textarea></p></li>     
              </ul><input type="hidden" value="<?=$_SESSION['auth_login']?>"  id="login_review"></input>
              <p id="not-nick"></p>
              <p align="center" style="margin-top: 100px;" style=""><img src="/img/loading.gif" style="display: none;" id="reload-img"/> <a id="button-send-review" align="center" class="btn btn-danger">Отправить комментарий</a></p>
              </div>
    	</div>
    </div>
  </div>

  <section id="random" class="hidden-xs col-md-12 col-lg-12 hidden-sm">
    <?php
      include("block-random.php");
    ?>
  </section>


  <section id="footer">
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
  </body>
</html>