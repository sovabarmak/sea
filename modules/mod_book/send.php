<?php
        header('Content-Type: text/html; charset=UTF-8');
	//session_start();
	$from = "From: Eisk-Sea.ru";
	$subject = "Eisk-Sea.ru: подбор и бронирование жилья в Ейске";
	$to = "info@eisk-sea.ru";
	$headers  = "Content-type: text/html; charset=utf8 \r\n"; 	
	$headers .= $from;	
	$text = "";
        
	if(isset($_POST['submit']) && $_POST["username"] && $_POST["phone"] && $_POST["email"]) {	
            $text .= '<strong>Имя:</strong>'.$_POST["username"].'; <br/>'.
					'<strong>Откуда Вы приезжаете:</strong> '.$_POST["place_from"].'; <br/>'.
                     '<strong>Телефон:</strong> '.$_POST["phone"].'; <br/>'.
                     '<strong>E-mail:</strong> '.$_POST["email"].'; <br/>'.
                     '<strong>Общее кол-во человек:</strong> '.$_POST["amount-adults"].'; <br/>'.
                     '<strong>Количество детей и их возраст:</strong> '.$_POST["amount-children"].'; <br/>'.
                     '<strong>Дата приезда:</strong> '.$_POST["modbook-arrival-date"].'; <br/>'.
                     '<strong>Дата отъезда:</strong> '.$_POST["modbook-departure-date"].'; <br/>'.
                     '<strong>Тип жилья:</strong> '.$_POST["type"].'; <br/>'.
                     '<strong>Вариант жилья:</strong> '.$_POST["varr"].'; <br/>'.
                     '<strong>Где встретить:</strong> '.$_POST["meet"].'; <br/>'.
                     '<strong>Время встречи:</strong> '.$_POST["time-hours"].":".$_POST["time-minuts"]
             ;
	}	                        
        
	if(@mail($to, $subject, $text, $headers)) {		
		echo "Заявка успешно отправлена!";		
	} else {
		echo "Заявку отправить не удалось!";
	}	
?>