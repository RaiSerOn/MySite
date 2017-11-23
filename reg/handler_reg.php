<?php
 if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
 define('lock_key',true);
 session_start();
 include("../includes/db_connect.php");
 include("../functions/functions.php");
 
     $error = array();
         
        $login = strtolower(clear_string($_POST['reg_login'])); 
        $pass = strtolower(clear_string($_POST['reg_pass'])); 
        $surname = clear_string($_POST['reg_surname']); 
        
        $name = clear_string($_POST['reg_name']); 
        $patronymic = clear_string($_POST['reg_patronymic']); 
        $email = clear_string($_POST['reg_email']); 
        
        $phone = clear_string($_POST['reg_phone']);  
 
 
    if (strlen($login) < 3 or strlen($login) > 15)
    {
       $error[] = "Логин должен быть от 3 до 15 символов"; 
    }
    else
    {   
     $result = mysql_query("SELECT login FROM reg_user WHERE login = '$login'",$link);
    If (mysql_num_rows($result) > 0)
    {
       $error[] = "Логин занят";
    }
            
    }
     
    if (strlen($pass) < 6 or strlen($pass) > 15) $error[] = "Укажите пароль от 6 до 15 символов";
    if (strlen($surname) < 3 or strlen($surname) > 20) $error[] = "Укажите фамилию от 3 до 20 символов";
    if (strlen($name) < 3 or strlen($name) > 15) $error[] = "Укажите имя от 3 до 15 символов!";
    if (strlen($patronymic) < 3 or strlen($patronymic) > 25) $error[] = "Укажите Отчество от 3 до 25 символов!!";
    if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",trim($email))) $error[] = "Укажите корректный email!!";
    if (!$phone) $error[] = "Укажите номер телефона!";
    
    if($_SESSION['img_captcha'] != strtolower($_POST['reg_captcha'])) $error[] = "Неверный код с картинки!";
    unset($_SESSION['img_captcha']);




    //проверяем расширения
    if($_FILES['upload_avatar']['type'] == 'image/jpeg' || $_FILES['upload_avatar']['type'] == 'image/jpg' || $_FILES['upload_avatar']['type'] == 'image/png')
    { 
     
    $imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload_avatar']['name']));
     
        //папка для загрузки
    $uploaddir = '../avatars/';
    //новое сгенерированное имя файла
    $newfilename = $_POST["reg_login"].'-'.$id.rand(10,100).'.'.$imgext;
    //путь к файлу (папка.файл)
    $uploadfile = $uploaddir.$newfilename;  
    if (!move_uploaded_file($_FILES['upload_avatar']['tmp_name'], $uploadfile)){  
    }

    }else {
     $newfilename = 'defaultAvatar.jpg';
    }   
   if (count($error))
   {
    
 echo implode('<br />',$error);
     
   }else
   {   
        $pass   = md5($pass);
        $pass   = strrev($pass);
        $pass   = "9nm2rv8q".$pass."2yo6z";
        
        $ip = $_SERVER['REMOTE_ADDR'];
		
		mysql_query("	INSERT INTO reg_user(login,pass,surname,name,avatar,patronymic,email,phone,datetime,ip)
						VALUES(
						
							'".$login."',
							'".$pass."',
							'".$surname."',
							'".$name."',
                            '".$newfilename."',
							'".$patronymic."',
                            '".$email."',
                            '".$phone."',
                            NOW(),
                            '".$ip."'							
						)",$link);

 echo 'true';
 }        


}
?>