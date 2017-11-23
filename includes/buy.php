<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        define('lock_key',true);
        include("db_connect.php");
        include("../functions/functions.php");
        $email = clear_string($_POST["email"]);
        $id = clear_string($_POST["id"]);
        $price = clear_string($_POST["price"]);
        if ($email != ""){ 
           $result = mysql_query("SELECT email FROM reg_user WHERE email='$email'",$link);
           $name_obj = mysql_query("SELECT order_type FROM orders WHERE order_id='$id'",$link);

           

           $row = mysql_fetch_array($name_obj);
           $row1 = $row["order_type"];
           $countrer = explode("  ", $row1);
           $i = count($countrer) - 1;
           while ($i >= 0) {
            $res = mysql_query("SELECT Howmany FROM cars WHERE Title='$countrer[$i]'",$link);
            $row1 = mysql_fetch_array($res);
            $newHowmany = $row1["Howmany"] - 1; 
            $Howmany = mysql_query("UPDATE cars SET Howmany = '$newHowmany' WHERE Title='$countrer[$i]'",$link);
               $i -= 1;
           }
            if(mysql_num_rows($result) > 0){
                         send_mail( 'noreply@shop.ru',
                                     $email,
                                    'Оплата покупки на сайте!!!!',
                                    'Здравствуйте. <br>
                                    Спасибо вам за совершённую вами покупку. Номер вашего заказа: '.$id.
                                    '.<br> 
                                    Вы приобрели следующие модели: '.$row['order_type'].
                                    '. <br>
                                    Общая сумма заказа:'.$price.' рублей. <br>
                                    Для завершения покупки, отправьте необходимую сумму ('.$price.' рублей) на один из следующих реквизитов:<br>
                                    банк,яндекс');   
               echo 'yes';
            }else{
                echo 'Данный E-mail не найден!';
            }
        }else{
            echo 'Укажите свой E-mail';
        }
    }
     
 
 
?>