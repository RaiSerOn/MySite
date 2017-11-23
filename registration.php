<?php
  define('lock_key',true);
  session_start();
  if($_SESSION['auth'] != 'yes_auth'){
	include("includes/db_connect.php");
  include("functions/functions.php");
  
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
  <title>Регистрация</title>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <meta http-equiv="content-type" content="text/html" />
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
    
    <script type="text/javascript" src="/js/jquery.form.js"></script>
    <script type="text/javascript" src="/js/jquery.validate.js"></script>  
    <script type="text/javascript" src="/js/code.js"></script>
    <script type="text/javascript" src="/js/TextChange.js"></script>
    <script type="text/javascript" src="/js/jcarousellite_1.0.1.js"></script>  


    <script type="text/javascript">
$(document).ready(function() {  
      $('#form_reg').validate(
                {   
                    // правила для проверки
                    rules:{
                        "reg_login":{
                            required:true,
                            minlength:5,
                            maxlength:15,
                            remote: {
                            type: "post",    
                            url: "/reg/check_login.php"
                                    }
                        },
                        "reg_pass":{
                            required:true,
                            minlength:7,
                            maxlength:15
                        },
                        "reg_surname":{
                            required:true,
                            minlength:3,
                            maxlength:15
                        },
                        "reg_name":{
                            required:true,
                            minlength:3,
                            maxlength:15
                        },
                        "reg_patronymic":{
                            required:true,
                            minlength:3,
                            maxlength:25
                        },
                        "reg_email":{
                            required:true,
                            email:true
                        },
                        "reg_phone":{
                            required:true
                        },
                        "reg_captcha":{
                            required:true,
                            remote: {
                            type: "post",    
                            url: "/reg/check_captcha.php"
                             
                                    }
                             
                        }
                    },
 
                    // выводимые сообщения при нарушении соответствующих правил
                    messages:{
                        "reg_login":{
                            required:"Укажите Логин!",
                            minlength:"От 5 до 15 символов!",
                            maxlength:"От 5 до 15 символов!",
                            remote: "Логин занят!"
                        },
                        "reg_pass":{
                            required:"Укажите Пароль!",
                            minlength:"От 7 до 15 символов!",
                            maxlength:"От 7 до 15 символов!"
                        },
                        "reg_surname":{
                            required:"Укажите вашу Фамилию!",
                            minlength:"От 3 до 20 символов!",
                            maxlength:"От 3 до 20 символов!"                           
                        },
                        "reg_name":{
                            required:"Укажите ваше Имя!",
                            minlength:"От 3 до 15 символов!",
                            maxlength:"От 3 до 15 символов!"                              
                        },
                        "reg_patronymic":{
                            required:"Укажите ваше Отчество!",
                            minlength:"От 3 до 25 символов!",
                            maxlength:"От 3 до 25 символов!" 
                        },
                        "reg_email":{
                            required:"Укажите свой E-mail",
                            email:"Не корректный E-mail"
                        },
                        "reg_phone":{
                            required:"Укажите номер телефона!"
                        },
                        "reg_captcha":{
                            required:"Введите код с картинки!",
                            remote: "Не верный код проверки!"
                        }
                    },
                     
    submitHandler: function(form){
    $(form).ajaxSubmit({
    success: function(data) { 
                                  
        if (data == 'true')
    {
       $("#block-form-registration").fadeOut(300,function() {
         
        $("#reg_message").attr("class","reg_message_good").fadeIn(400).html("Вы успешно зарегистрированы!");
        $("#form_submit").hide();
         
       });
          
    }
    else
    {
       $("#reg_message").attr("class","reg_message_error").fadeIn(400).html(data); 
    }
        } 
            }); 
            }
            });
        });
      
</script>
  
  </head>
  <body>
  <header>
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

    <div class="container NewModel">
      <div class="row">
        <div class="section-registration col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <h2 style="text-align: center;"><span class="h2-title">Регистрация</span></h2>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <form method="post" id="form_reg" action="/reg/handler_reg.php">
            <p id="reg_message"></p>
            <div id="block-form-registration">
              <ul id="form-registration-all" class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
                <li>
                 <label class="hidden-xs">Login</label>
                 <span class="star hidden-xs">*</span>
                 <input type="text" class="form-control" placeholder="Придумайте логин, например: loremin" name="reg_login" id="reg_login"/>
                </li> 
                <li>
                 <label class="hidden-xs">пароль</label>
                 <span class="star hidden-xs">*</span>
                 <input type="password" class="form-control" placeholder="Придумайте пароль, например: df4rtg6" name="reg_pass" id="reg_pass"/>
                </li>
                <li>
                 <label class="hidden-xs">фамилия</label>
                 <span class="star hidden-xs">*</span>
                 <input type="text" class="form-control" placeholder="Введите фамилию, например: Игнатенко" name="reg_surname" id="reg_surname"/>
                </li>
                <li>
                 <label class="hidden-xs">имя</label>
                 <span class="star hidden-xs">*</span>
                 <input type="text" class="form-control" placeholder="Введите имя, например: Владимир" name="reg_name" id="reg_name"/>
                </li> 
                <li>
                 <label class="hidden-xs">отчество</label>
                 <span class="star hidden-xs">*</span>
                 <input type="text" class="form-control" placeholder="Введите отчество, например: Сергеевич" name="reg_patronymic" id="reg_patronymic"/>
                </li>  
                <li>
                 <label class="hidden-xs">e-mail</label>
                 <span class="star hidden-xs">*</span>
                 <input type="text" class="form-control" placeholder="Введите e-mail, например: loremin@mail.ru" name="reg_email" id="reg_email"/>
                </li> 
                <li>
                 <label class="hidden-xs">мобильный телефон</label>
                 <span class="star hidden-xs">*</span>
                 <input type="text" class="form-control" placeholder="Введите номер телефона, например: 89185657486" name="reg_phone" id="reg_phone"/>
                </li> 
                <li>
                  <div id="block-captcha" class="col-xs-12">
                    <img src="/reg/regcaptcha.php" alt="КАПЧА">
                    <input placeholder="Введите капчу" type="text" class="form-control" name="reg_captcha" id="reg_captcha">
                    <p id="reloadcaptcha" class="btn btn-primary">обновить капчу</p>
                  </div>
                </li>  
                <li>
                  <div id="block-avatar">
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
                    <input type="file" name="upload_avatar" class="btn btn-primary btn-float-left"/>
                    <p>Нормальные размеры картинки: не больше 512х512</p>
                  </div>
                </li>
              </ul>
            </div>
          <p id="form_reg_p" align="right"><input class="reg btn btn-success btn-lg" type="submit" name="reg_submit" id="form_submit" value="Pегистрация"></p>
          </form>
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
<?php
} else {
  header("Location:index.php");
}
?>