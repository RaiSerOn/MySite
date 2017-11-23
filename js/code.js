$(document).ready(function() {

$(function(){
  $(document).on( 'scroll', function(){
    if ($(window).scrollTop() > 50) {
      $('.scroll-top-wrapper').removeClass('fadeOutRight');
      $('.scroll-top-wrapper').addClass('show animated fadeInRight');
    } else {
      $('.scroll-top-wrapper').removeClass('fadeInRight');
      $('.scroll-top-wrapper').addClass('fadeOutRight');

    }
  });
});

function oppens(){
  var count = Math.round(1 - 0.5 + Math.random() * (5 - 1 + 1));
  if(count == 2) setTimeout("$('#how-many-i').html('В данный момент эту модель просматривают 2 человека');$('#how-many').addClass('fadeInLeft');", 1000);
  else if(count == 1) setTimeout("$('#how-many-i').html('В данный момент эту модель просматривает 1 человек');$('#how-many').addClass('fadeInLeft');", 1000);
  else if(count == 3) setTimeout("$('#how-many-i').html('В данный момент эту модель просматривают 3 человека');$('#how-many').addClass('fadeInLeft');", 1000);
  // else if(count == 4) setTimeout("$('#how-many').html('В данный момент эту модель просматривают 4 человека');$('#how-many').addClass('fadeInLeft');", 1000);
  // else if(count == 5) setTimeout("$('#how-many').html('В данный момент эту модель просматривают 5 человек');$('#how-many').addClass('fadeInLeft');", 1000);
  // else if(count == 6) setTimeout("$('#how-many').html('В данный момент эту модель просматривают 6 человек');$('#how-many').addClass('fadeInLeft');", 1000);
  // else if(count == 7) setTimeout("$('#how-many').html('В данный момент эту модель просматривают 7 человек');$('#how-many').addClass('fadeInLeft');", 1000);
  // else if(count == 8) setTimeout("$('#how-many').html('В данный момент эту модель просматривают 8 человек');$('#how-many').addClass('fadeInLeft');", 1000);
  setTimeout("$('#how-many-i').html('В данный момент эту модель просматривают 2 человека');$('#how-many').addClass('fadeOutLeft');$('#how-many').removeClass('fadeInLeft');", 10000);
};

oppens();

$(function(){
  $(document).on( 'scroll', function(){
    if ($(window).scrollTop() > 450) {
      $('.main-models').removeClass('fadeOutDown');
      $('.main-models').addClass('animated fadeInUp');
    } else {
      $('.main-models').addClass('fadeOutDown');
    }
  });
});

$(function(){
  $(document).on( 'scroll', function(){
    if ($(window).scrollTop() > 50) {
      $('.feddbacks').removeClass('fadeOutDown');
      $('.feddbacks').addClass('animated fadeInUp');
    } else {
      $('.feddbacks').addClass('fadeOutDown');
    }
  });
});

$("#block-random-tovar").jCarouselLite({
  vertical: false,
  hoverPause:true,
  btnPrev: "",
  btnNext: "",
  visible: 3,
  auto:3000,
  speed:500
});

$('#reloadcaptcha').click(function(){
$('#block-captcha > img').attr("src","/reg/regcaptcha.php?r="+ Math.random());
});

loadcart();

$("#button-auth").click(function(){
  var auth_login = $("#auth_login").val();
  var auth_pass = $("#auth_pass").val();
  if(auth_login =="" || auth_login.length > 30){
    $("#auth_login").css("border","1px solid");
    $("#auth_login").css("border-color","red");
    send_login = 'no';
  } else {
    $("#auth_login").css("border","0");
    $("#auth_login").css("border-color","#dbdbdb");
    send_login = 'yes';
  }
  if(auth_pass =="" || auth_pass.length > 15){
    $("#auth_pass").css("border","1px solid");
    $("#auth_pass").css("borderColor","red");
    send_pass = 'no';
  } else {
    $("#auth_pass").css("border","0");
    $("#auth_pass").css("borderColor","#dbdbdb");
    send_pass = 'yes';
  }
  if($("#rememberme").prop('checked')){
    auth_rememberme = 'yes';
  } else {
    auth_rememberme = 'no';
  }
  if(send_login == 'yes' && send_pass == 'yes'){
        $("#button-auth").hide();
    $.ajax({
      type: "POST",
      url: "/includes/auth.php",
      data: "login="+auth_login+"&pass="+auth_pass+"&rememberme="+auth_rememberme,
      dataType: "html",
      cache:false,
      success: function(data){
        if(data == 'yes_auth'){
          location.reload();
        } else {
          $("#message-auth").slideDown(400);
          $(".auth-loading").hide();
          $("#button-auth").show();
        }
      }
    })
  }
});

$('#remindpass').click(function(){
     
            $('#input-email-pass').fadeOut(200, function() {  
            $('#block-remind').fadeIn(300);
});
});
$('#prev-auth').click(function(){
     
            $('#block-remind').fadeOut(200, function() {  
            $('#input-email-pass').fadeIn(300);
            });
});

$('#button-remind').click(function(){
     
 var recall_email = $("#remind-email").val();
  
 if (recall_email == "" || recall_email.length > 40 )
 {
    $("#remind-email").css("borderColor","red");
 
 }else
 {
   $("#remind-email").css("borderColor","#DBDBDB");
    
   $("#button-remind").hide();
   $(".auth-loading").show();
     
  $.ajax({
  type: "POST",
  url: "/includes/remind-pass.php",
  data: "email="+recall_email,
  dataType: "html",
  cache: false,
  success: function(data) {
 
  if (data == 'yes')
  {
     $(".auth-loading").hide();
     $("#button-remind").show();
     $('#message-remind').attr("class","message-remind-success").html("На ваш e-mail выслан пароль.").slideDown(400);
      
     setTimeout("$('#message-remind').html('').hide(),$('#block-remind').hide(),$('#input-email-pass').show()", 3000);
  
  }else
  {
      $(".auth-loading").hide();
      $("#button-remind").show();
      $('#message-remind').attr("class","message-remind-error").html(data).slideDown(400);
       
  }
  }
}); 
  }
  }); 

$('a[id="logout"]').click(function(){
     
    $.ajax({
  type: "POST",
  url: "/includes/logout.php",
  dataType: "html",
  cache: false,
  success: function(data) {
 
  if (data == 'logout')
  {
      $("#block-basket > a").html("корзина пуста");
      $("#scroll-top-wrapper").css("width","40px");
      location.reload();
  }
   
}
}); 
});

$('#input-search').bind('textchange', function () {
                  
 var input_search = $("#input-search").val();
if (input_search.length > 0 )
{
 $.ajax({
  type: "POST",
  url: "/includes/search.php",
  data: "text="+input_search,
  dataType: "html",
  cache: false,
  success: function(data) {
 
 if (data > '')
 {
     $("#result-search").show().html(data); 
 }else{

 }
 
      }
}); 
 
}else
{
  $("#result-search").hide();    
}
 
});

$('#confirm-button-next').click(function(e){   
 
   var order_address = $("#order_address").val();
    
 if (!$(".order_delivery").is(":checked"))
 {
    $(".label_delivery").css("color","red");
    send_order_delivery = '0';
 
 }else { $(".label_delivery").css("color","black"); send_order_delivery = '1';
 
 // Проверка Адресса
  
  if (order_address == "")
 {
    $("#order_address").css("borderColor","#f00");
    send_order_address = '0';   
 }else { $("#order_address").css("borderColor","#DBDBDB"); send_order_address = '1';}
   
} 
 // Глобальная проверка
 if (send_order_delivery == "1" && send_order_address == "1")
 {
    // Отправляем форму
   return true;
 }
 
e.preventDefault();
 
});
function loadcart(){


     $.ajax({
  type: "POST",
  url: "/includes/loadcart.php",
  dataType: "html",
  cache: false,
  success: function(data) {
     
  if (data != "0")
  {
   
    $("#scroll-top-wrapper").css("width","240px");
    $("#block-basket > a").html(data);
  }else
  {
    $("#block-basket > a").html("корзина пуста");
    $("#scroll-top-wrapper").css("width","40px");
  }  
     
      }
});    
}

$('.random-add-cart-cart').click(function(){
               
 var  tird = $(this).attr("tird");
 
 $.ajax({
  type: "POST",
  url: "/includes/addtocart.php",
  data: "id="+tird,
  dataType: "html",
  cache: false,
  success: function(data) { 
    if(data == 'no'){
     if ($(window).scrollTop() < 50) {
      $('#scroll-top-wrapper').removeClass('fadeOutRight');
      $("#scroll-top-wrapper").addClass('show animated fadeInRight');
      $("#scroll-top-wrapper").css("height","100px");
      $("#scroll-top-wrapper").append( "<p id='alert-block'>Все покупки осуществляются в единичном экземпляре</p>" );
      $("#alert-block").css("line-height","1");
      $("#alert-block").css("color","yellow");
      setTimeout("$('#scroll-top-wrapper').css('height','48px');$('#scroll-top-wrapper').removeClass('fadeInRight');$('#scroll-top-wrapper').addClass('fadeOutRight');$('#alert-block').remove();", 5000);
    } else {
      $("#scroll-top-wrapper").css("height","100px");
      $("#scroll-top-wrapper").append( "<p id='alert-block'>Все покупки осуществляются в единичном экземпляре</p>" );
      $("#alert-block").css("line-height","1");
      $("#alert-block").css("color","yellow");
      setTimeout("$('#scroll-top-wrapper').css('height','48px');$('#alert-block').remove();", 5000);
    }
    } else {
      loadcart();
      location.reload();
    }
  }
});

function loadcart(){
  

    $.ajax({
  type: "POST",
  url: "/includes/loadcart.php",
  dataType: "html",
  cache: false,
  success: function(data) {
     
  if (data == "0")
  {
   
    $("#block-basket > a").html("корзина пуста");
    $("#scroll-top-wrapper").css("width","40px");
    
  }else
  {
    $("#scroll-top-wrapper").css("width","240px");
    $("#block-basket > a").html(data);
 
  }  
     
      }
});    
}
});

$('.add_block, .add_block_first, .random-add-cart, .add_blockk ').click(function(){
               
 var  tird = $(this).attr("tird");
 
 $.ajax({
  type: "POST",
  url: "/includes/addtocart.php",
  data: "id="+tird,
  dataType: "html",
  cache: false,
  success: function(data) { 
  if(data == 'no'){
    if ($(window).scrollTop() < 50) {
      $('#scroll-top-wrapper').removeClass('fadeOutRight');
      $("#scroll-top-wrapper").addClass('show animated fadeInRight');
      $("#scroll-top-wrapper").css("height","100px");
      $("#scroll-top-wrapper").append( "<p id='alert-block'>Все покупки осуществляются в единичном экземпляре</p>" );
      $("#alert-block").css("line-height","1");
      $("#alert-block").css("color","yellow");
      setTimeout("$('#scroll-top-wrapper').css('height','48px');$('#scroll-top-wrapper').removeClass('fadeInRight');$('#scroll-top-wrapper').addClass('fadeOutRight');$('#alert-block').remove();", 5000);
    } else {
      $("#scroll-top-wrapper").css("height","100px");
      $("#scroll-top-wrapper").append( "<p id='alert-block'>Все покупки осуществляются в единичном экземпляре</p>" );
      $("#alert-block").css("line-height","1");
      $("#alert-block").css("color","yellow");
      setTimeout("$('#scroll-top-wrapper').css('height','48px');$('#alert-block').remove();", 5000);
    }
  } else {
    loadcart();
  }
  }
});

function loadcart(){
  

    $.ajax({
  type: "POST",
  url: "/includes/loadcart.php",
  dataType: "html",
  cache: false,
  success: function(data) {
     
  if (data == "0")
  {
   
    $("#block-basket > a").html("корзина пуста");
    $("#scroll-top-wrapper").css("width","40px");
    
  }else
  {
    $("#scroll-top-wrapper").css("width","240px");
    $("#block-basket > a").html(data);
 
  }  
     
      }
});    
}
});





$('close').click(function(){
  $.ajax({
    type: "POST",
    url: "/includes/logout.php",
    dataType: "html",
    cache: false,
    success: function(data) {
 
  if (data == 'logout')
  {
      location.reload();
  }
   
}
})
});
var fire = true;
$('#button-send-review').click(function(){
                 
   var comment = $("#comment_review").val();
   var nick = $("#login_review").val();

    if(nick != ""){
      login_review = '1';
    } else {
      login_review = '0';
    }  

    if (comment != "")
       {
          comment_review = '1';
          $("#comment_review").css("borderColor","#DBDBDB");
      }else {
          comment_review = '0';
          $("#comment_review").css("borderColor","#FDB6B6");
      }          
            // Глобальная проверка и отправка отзыва
    if(login_review == '1'){
      if (comment_review == '1'){
           $("#button-send-review").hide();
           $("#reload-img").show();
          if(fire = true){   
            $.ajax({
               type: "POST",
               url: "/includes/add_review.php",
               data: "comment="+comment+"&nick="+nick,
               dataType: "html",
               cache: false,
               success: function() {
               $("#name_review").val("");
               $("#comment_review").val("");
               $("#button-send-review").show();
               $("#reload-img").hide();
               setTimeout("$.fancybox.close()", 1000);
               fire = false;
               }
               });  
          } else {
              $(".text-center").html("Сообщение не отправлено");
          }
          setTimeout(function() {fire = true;}, 300000);
      } 
    } else {
      $("#not-nick").html("Только авторизированные пользователи могут отправлять сообщения!");
    }       
});

$('div[class="scroll-top-wrapper"]').click(function () {
    location.href = "cart.php?action=onclick";
});
$('button[class="btn btn-hero btn-lg"]').click(function () {
    location.href = "index3.php";
});
$('#button-finish').click(function(){
  var email = $("#session-email").val();
  var id = $(this).attr("ido");
  var price = $(this).attr("prc");
  $.ajax({
    type: "POST",
    url: "/includes/buy.php",
    data: "email="+email+"&id="+id+"&price="+price,
    dataType: "html",
    cache: false,
    success: function(data) {
      if (data != 'yes')
      {
        $("#block-feedback").html("Сообщение не отправлено");
     
      }else
      {
      //location.href = "cart.php?actioz=clear&action=finish";
      $("#block-feedback").html("Сообщение отправлено");
      }  
    }
  });
});

$('#likegood').click(function(){
  var tid = $(this).attr("tid");
  $.ajax({
    type: "POST",
    url: "/includes/like.php",
    data:"id="+tid,
    dataType: "html",
    cache: false,
    success: function(data){
      if(data == 'no'){
        alert('Вы уже проголосовали!');
      } else {
        $("#likegoodcount").html(data);
        alert('Спасибо за ваш голос!');
      }
    }
  })
});

});

