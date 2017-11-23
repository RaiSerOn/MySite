<?php
  define('lock_key',true);
	include("includes/db_connect.php");
  include("functions/functions.php");
  session_start();
  include("includes/auth_cookie.php");
  $search = clear_string($_GET["q"]);

  $sorting = $_GET["sort"];
  switch($sorting){
    case 'price-asc';
      $sorting = 'Price ASC';
      $sort_name = 'от дешёвых к дорогим';
      break;

      case 'price-desc';
      $sorting = 'Price DESC';
      $sort_name = 'от дорогих к дешёвым';
      break;

      case 'news';
      $sorting = 'Date DESC';
      $sort_name = 'новинки';
      break;

      case 'brand';
      $sorting = 'Model';
      $sort_name = 'от а до я';
      break;

      default:
      $sorting = 'ID DESC';
      $sort_name = 'нет сортировки';
      break;
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
    <script type="text/javascript" src="/js/jcarousellite_1.0.1.js"></script>
    <script type="text/javascript">
      
    </script>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Поиск по параметрам</h4>
      </div>
      <div class="modal-body">
        <div id="search" class="col-md-4 col-lg-4 ">
        <form method="GET" action="search_filter.php" class = "group-search">
          <table>
          <?php
            $result = mysql_query("SELECT category FROM models",$link);
            echo'
              <tr><td id="table-search">Категория: ';
            if(mysql_num_rows($result) > 0){
              $row = mysql_fetch_array($result);
              do{
                  echo' <a href="view_cat.php?cat='.$row["category"].'">'.$row[category].'</a> ';
              }while($row = mysql_fetch_array($result));
            }
            echo'
              </td></tr> ';
              $result = mysql_query("SELECT scale FROM models",$link);
            echo'
              <tr><td id="table-search">Масштаб: ';
            if(mysql_num_rows($result) > 0){
              $row = mysql_fetch_array($result);
              do{
                  echo' <a href="view_cat.php?sca='.$row["scale"].'">'.$row[scale].'</a> ';
              }while($row = mysql_fetch_array($result));
            }
            echo'
              </td></tr> ';
              $result = mysql_query("SELECT mark FROM models",$link);
            echo'
              <tr><td id="table-search">Марка: ';
            if(mysql_num_rows($result) > 0){
              $row = mysql_fetch_array($result);
              do{
                  echo' <a href="view_cat.php?mar='.$row["mark"].'">'.$row[mark].'</a> ';
              }while($row = mysql_fetch_array($result));
            }
            echo'
              </td></tr> ';
              $result = mysql_query("SELECT brand FROM models",$link);
            echo'
              <tr><td id="table-search">Производитель: ';
            if(mysql_num_rows($result) > 0){
              $row = mysql_fetch_array($result);
              do{
                  echo' <a href="view_cat.php?bra='.$row["brand"].'">'.$row[brand].'</a> ';
              }while($row = mysql_fetch_array($result));
            }
            echo'
              </td></tr> ';
            ?>  
            <tr><td><hr style="border-width: 5px;">
                    <p><strong>Групповой поиск по каталогу</strong></p>
                      <?php
                        $ID = mysql_query("SELECT ID FROM models",$link);
                        $result = mysql_query("SELECT category FROM models",$link);
                        if(mysql_num_rows($result) > 0){
                          $row = mysql_fetch_array($result);
                          echo'<p><select class="btn btn-default" data-style="btn-primary" name="category"> ';
                          do{
                              echo'<option value="'.$row[category].'">'.$row[category].'</option>';
                          }while($row = mysql_fetch_array($result));
                        }
                        echo'</select></p>';
                        $result = mysql_query("SELECT scale FROM models",$link);
                        if(mysql_num_rows($result) > 0){
                          $row = mysql_fetch_array($result);
                          echo'<p><select name="scale" class="btn btn-default"> ';
                          do{
                              echo'<option value="'.$row[scale].'">'.$row[scale].'</option>';
                          }while($row = mysql_fetch_array($result));
                        }
                        echo'</select></p>';
                        $result = mysql_query("SELECT mark FROM models",$link);
                        if(mysql_num_rows($result) > 0){
                          $row = mysql_fetch_array($result);
                          echo'<p><select name="mark" class="btn btn-default"> ';
                          do{
                            if($row[mark] != "")
                              echo'<option value="'.$row[mark].'">'.$row[mark].'</option>';
                          }while($row = mysql_fetch_array($result));

                        }
                        echo'</select></p>';
                        $result = mysql_query("SELECT brand FROM models",$link);
                        if(mysql_num_rows($result) > 0){
                          $row = mysql_fetch_array($result);
                          echo'<p><select name="brand" class="btn btn-default"> ';
                          do{
                            if($row[brand] != "")
                              echo'<option value="'.$row[brand].'">'.$row[brand].'</option>';
                          }while($row = mysql_fetch_array($result));
                        }
                        echo'</select></p>';
                      ?>
                  </td></tr>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i>Поиск</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid searcher-block">
  <div>
		<div>
    <?php
      if(strlen($search) >= 1 && strlen($search) < 100){
    ?>
      <h1 style="text-align: center; color: #ffffff;">Новые поступления</h1>
      <ul id="sorting-lisr">
        <a class="btn btn-primary" href="search.php?q=<?php echo $search;?>&sort=price-asc"><li>от дешёвых к дорогим</li></a>
        <a class="btn btn-primary" href="search.php?q=<?php echo $search;?>&sort=price-desc"><li>от дорогих к дешёвым</li></a>
        <a class="btn btn-primary" href="search.php?q=<?php echo $search;?>&sort=news"><li>новинки</li></a>
         <a class="btn btn-primary" href="search.php?q=<?php echo $search;?>&sort=brand"><li>от а до я</li></a>
      </ul>
        <a data-toggle="modal" data-target="#myModal" style="display: block; margin: auto; width: 50px; margin-bottom: 15px;" class="btn btn-danger visible-xs visible-sm"><i class="fa fa-search"></i></a>
    <div id="search" class="col-md-4 col-lg-4 hidden-xs hidden-sm" style="margin-left: 20px;">
      <table>
      <?php
        $result = mysql_query("SELECT category FROM models",$link);
        echo'
          <tr><td id="table-search">Категория: ';
        if(mysql_num_rows($result) > 0){
          $row = mysql_fetch_array($result);
          do{
              echo' <a href="view_cat.php?cat='.$row["category"].'">'.$row[category].'</a> ';
          }while($row = mysql_fetch_array($result));
        }
        echo'
          </td></tr> ';


          $result = mysql_query("SELECT scale FROM models",$link);
        echo'
          <tr><td id="table-search">Масштаб: ';
        if(mysql_num_rows($result) > 0){
          $row = mysql_fetch_array($result);
          do{
              echo' <a href="view_cat.php?sca='.$row["scale"].'">'.$row[scale].'</a> ';
          }while($row = mysql_fetch_array($result));
        }
        echo'
          </td></tr> ';


          $result = mysql_query("SELECT mark FROM models",$link);
        echo'
          <tr><td id="table-search">Марка: ';
        if(mysql_num_rows($result) > 0){
          $row = mysql_fetch_array($result);
          do{
              echo' <a href="view_cat.php?mar='.$row["mark"].'">'.$row[mark].'</a> ';
          }while($row = mysql_fetch_array($result));
        }
        echo'
          </td></tr> ';


          $result = mysql_query("SELECT brand FROM models",$link);
        echo'
          <tr><td id="table-search">Производитель: ';
        if(mysql_num_rows($result) > 0){
          $row = mysql_fetch_array($result);
          do{
              echo' <a href="view_cat.php?bra='.$row["brand"].'">'.$row[brand].'</a> ';
          }while($row = mysql_fetch_array($result));
        }
        echo'
          </td></tr> ';

        ?>  
        <tr><td><form method="GET" action="search_filter.php" class = "group-search">
                <p><strong>Групповой поиск по каталогу</strong></p>
                  <?php
                    $ID = mysql_query("SELECT ID FROM models",$link);
                    $result = mysql_query("SELECT category FROM models",$link);
                    if(mysql_num_rows($result) > 0){
                      $row = mysql_fetch_array($result);
                      echo'<p><select class="btn btn-default" data-style="btn-primary" name="category"> ';
                      do{
                          echo'<option value="'.$row[category].'">'.$row[category].'</option>';
                      }while($row = mysql_fetch_array($result));
                    }
                    echo'</select></p>';
                    $result = mysql_query("SELECT scale FROM models",$link);
                    if(mysql_num_rows($result) > 0){
                      $row = mysql_fetch_array($result);
                      echo'<p><select name="scale" class="btn btn-default"> ';
                      do{
                          echo'<option value="'.$row[scale].'">'.$row[scale].'</option>';
                      }while($row = mysql_fetch_array($result));
                    }
                    echo'</select></p>';
                    $result = mysql_query("SELECT mark FROM models",$link);
                    if(mysql_num_rows($result) > 0){
                      $row = mysql_fetch_array($result);
                      echo'<p><select name="mark" class="btn btn-default"> ';
                      do{
                        if($row[mark] != "")
                          echo'<option value="'.$row[mark].'">'.$row[mark].'</option>';
                      }while($row = mysql_fetch_array($result));

                    }
                    echo'</select></p>';
                    $result = mysql_query("SELECT brand FROM models",$link);
                    if(mysql_num_rows($result) > 0){
                      $row = mysql_fetch_array($result);
                      echo'<p><select name="brand" class="btn btn-default"> ';
                      do{
                        if($row[brand] != "")
                          echo'<option value="'.$row[brand].'">'.$row[brand].'</option>';
                      }while($row = mysql_fetch_array($result));
                    }
                    echo'</select></p>';
                  ?>
                  <input type="submit" class="btn btn-success" style="width: 100px;" value="Поиск" >
              </form></td></tr>
      </table>
    </div>
    </div>
    <div class="row col-md-8 col-lg-8 col-xs-12">
      <div id="start_block-list">
        <ul>
  			<?php
              $num = 10;
              $page = (int)$_GET['page'];

              $count = mysql_query("SELECT COUNT(*) FROM cars WHERE title LIKE '%$search%' AND visible = '1'",$link);
              $temp = mysql_fetch_array($count);

              if($temp[0] > 0){
                $tempcount = $temp[0];

                $total = (($tempcount - 1) / $num) + 1;
                $total = intval($total);

                $page = intval($page);
                if(empty($page) or $page < 0) $page = 1;
                  if($page > $total) $page = $total;

                  $start = $page * $num - $num;
                  $qury_start_num = " LIMIT $start, $num";
              }
               if($temp[0]>0) {  
                  
  				$result = mysql_query("SELECT * FROM cars WHERE title LIKE '%$search%' AND visible='1' ORDER BY $sorting $qury_start_num",$link);

  				if(mysql_num_rows($result) > 0){
  					$row = mysql_fetch_array($result);
            
  					do{

              if ($row["Image"] != "" && file_exists("./uploads_images/".$row["Image"])){
                $img_path = './uploads_images/'.$row["Image"];
                $max_width = 200;
                $max_height = 200;
                list($width,$height) = getimagesize($img_path);
                $ratioh = $max_height/$height;
                $ratiow = $max_width/$width;
                $ratio = min($ratioh,$ratiow);
                $width = intval($ratio*$width);
                $height = intval($ratio*$height);
              } else {
                $img_path = "/images/no-image.png";
                $width = 110;
                $height = 200;
              }


  						echo '
              <li id="table-list" class="col-md-12 col-sm-12 hidden-xs col-lg-12">
                <div class="media col-md-3 col-sm-3 col-xs-3 col-lg-3" style="padding: 0;">
                    <figure class="pull-left" style="padding: 0;">
                        <img oncontextmenu="return false;" class="media-object img-rounded img-responsive" width ="'.$width.'" height = "'.$height.'" src="'.$img_path.'" alt="placehold.it/350x250" >
                    </figure>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <a href="view_content.php?id='.$row["ID"].'"><h4 class="list-group-item-heading">'.$row["Title"].'</h4></a>
                    <p class="list-group-item-text">Размер модели:<span> '.$row["Scale"].'</span>, Артикул: '.$row["Vendor_code"].', Материал: '.$row["Material"].',производитель: <a href="view_cat.php?bra='.$row["Producer"].'">'.$row["Producer"].'</a>
                    </p>
                </div>
                <div class="price-index3 col-md-3 col-sm-3 col-xs-3 col-lg-3 text-center table-inner">
                    <h3>'.group_numerals($row["Price"]).'<small> руб </small></h3>
                    <a class="btn btn-danger btn-block add_block hidden-xs" tird="'.$row["ID"].'">Купить </a>
                    <a class="btn btn-danger btn-xs btn-block add_block visible-xs" tird="'.$row["ID"].'"><i class="fa fa-money"></i></a>
                </div>
                </li>
                <li class="visible-xs">
                <div class="col-xs-12">
                  <div class="thumbnail" >
                    <h4 class="text-center"><span class="label label-info">Новое Поступление</span></h4>
                    <img oncontextmenu="return false;" src="'.$img_path.'" class="img-responsive">
                    <div class="caption">
                      <div class="row">
                        <div class="col-md-6 col-xs-6">
                          <h3><a href="view_content.php?id='.$row["ID"].'">Подробнее</a></h3>
                        </div>
                        <div class="col-md-6 col-xs-6 price">
                          <h4 style="margin-top: 25px;text-align: right;">
                          <label>'.group_numerals($row["Price"]).' руб.</label></h4>
                        </div>
                      </div>
                      <p>'.$row["Title"].'</p>
                      <div class="row">
                        <div class="col-md-6">
                          <p tird="'.$row["ID"].'" class="add_block_first btn btn-success btn-product"><span class="glyphicon glyphicon-shopping-cart"></span> Buy</p></div>
                      </div>
                      <p> </p>
                    </div>
                  </div>
                </div>
                </li>
  						';
  					}while($row = mysql_fetch_array($result)); 
  				}
          echo'</ul>';
          if ($page != 1)  $pstr_prev = '<li><a class="pstr-prev" href="search.php?q='.$search.'&sort='.$_GET["sort"].'&page='.($page - 1).'">&lt;</a></li>';
          if ($page != $total)  $pstr_next = '<li><a class="pstr-next" href="search.php?q='.$search.'&sort='.$_GET["sort"].'&page='.($page + 1).'">&gt;</a></li>';
          if($page - 5 > 0) $page5left = '<li><a href="search.php?q='.$search.'&sort='.$_GET["sort"].'&page='.($page - 5).'">'.($page - 5).'</a></li>';
          if($page - 4 > 0) $page4left = '<li><a href="search.php?q='.$search.'&sort='.$_GET["sort"].'&page='.($page - 4).'">'.($page - 4).'</a></li>';
          if($page - 3 > 0) $page3left = '<li><a href="search.php?q='.$search.'&sort='.$_GET["sort"].'&page='.($page - 3).'">'.($page - 3).'</a></li>';
          if($page - 2 > 0) $page2left = '<li><a href="search.php?q='.$search.'&sort='.$_GET["sort"].'&page='.($page - 2).'">'.($page - 2).'</a></li>';
          if($page - 1 > 0) $page1left = '<li><a href="search.php?q='.$search.'&sort='.$_GET["sort"].'&page='.($page - 1).'">'.($page - 1).'</a></li>';

          if($page + 5 <= $total) $page5right = '<li><a href="search.php?q='.$search.'&sort='.$_GET["sort"].'&page='.($page + 5).'">'.($page + 5).'</a></li>';
          if($page + 4 <= $total) $page4right = '<li><a href="search.php?q='.$search.'&sort='.$_GET["sort"].'&page='.($page + 4).'">'.($page + 4).'</a></li>';
          if($page + 3 <= $total) $page3right = '<li><a href="search.php?q='.$search.'&sort='.$_GET["sort"].'&page='.($page + 3).'">'.($page + 3).'</a></li>';
          if($page + 2 <= $total) $page2right = '<li><a href="search.php?q='.$search.'&sort='.$_GET["sort"].'&page='.($page + 2).'">'.($page + 2).'</a></li>';
          if($page + 1 <= $total) $page1right = '<li><a href="search.php?q='.$search.'&sort='.$_GET["sort"].'&page='.($page + 1).'">'.($page + 1).'</a></li>';
          if($page + 5 < $total){
            $strtotal = '<li><p class="nav-point">...</p></li><li><a href="search.php?q='.$search.'&sort='.$_GET["sort"].'&page='.$total.'">'.$total.'</a></li>';
          } else {
            $strtotal ="";
          }
          if($total > 1){
            echo'
              <div class="pstrnav">
                <ul>
            ';
            echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='search.php?q=".$search."sort=".$_GET["sort"]."&page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
              echo'
                </ul>
              </div>
            ';
          }
        }else{
          echo"<p style='color:rgb(255,255,255); text-align: center; margin-top: 30px; text-transform: uppercase;'>Товаров не найдено</p>";
        }
        } else{
          echo"<p>Мы не можем найти ничего!<p>";
        }      
  			?>

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
  </body>
</html>