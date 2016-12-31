<?php
header('Content-Type: text/html; charset=UTF-8');
if(isset($_POST['name']) && $_POST["phone"] && $_POST['email']) {
		session_start();
		/*$code=$_SESSION['code'];
		if($_POST['cap']=="" || $_POST['cap']==" ")
			{die("Введите символы!");
	}else{
		$p_code=$_POST['cap'];
		if($p_code!=$code)
			{die("Неверно введены символы!");
		}else{*/
			$from = "From: Eisk-Sea.ru";
			$subject = "Eisk-Sea.ru: бронирование.";
			$to = "info@eisk-sea.ru";

			$headers  = "Content-type: text/html; charset=utf8 \r\n";
			$headers .= $from;
			$text = "";
			$text .= '<strong>Объект:</strong>'.$_POST['tipe'].'<BR/><strong>Имя:</strong>'.$_POST["name"].'; <br/>'.
			'<strong>Телефон:</strong> '.$_POST["phone"];
			if (isset($_POST['email']) && $_POST['email'] <> '') $text .= '; <br/>'. '<strong>E-mail:</strong> '.$_POST["email"];
			$text .='; <br/>'.'<strong>Общее количество человек:</strong> '.$_POST["amount"];
			if (isset($_POST['amount-children']) && $_POST['amount-children'] <> '') $text .= '; <br/>'.'<strong>Количество детей и их возраст:</strong> '.$_POST["amount-children"];
			$text .= '; <br/>'.'<strong>Дата приезда:</strong> '.$_POST["date_from"].'; <br/>'.
			'<strong>Дата отъезда:</strong> '.$_POST["date_to"];
			if (isset($_POST['message']) && $_POST['message'] <> '') $text .=  '; <br/>'.'<strong>Вопрос/комментарий:</strong> '.$_POST["message"];
			$text .= '; <br/>'.'<strong>Тип жилья:</strong> '.$_POST["tip"];
			if (isset($_POST['meet']) && $_POST['meet'] <>'') $text .= '; <br/>'.'<strong>Где встретить:</strong> '.$_POST["meet"];
			if (isset($_POST['varr']) && $_POST['varr'] <> '') $text .= '; <br/>'.'<strong>Вариант жилья:</strong> '.$_POST["varr"];
			if(@mail($to, $subject, $text, $headers)) { echo "Ваша заявка принята!"; } else { echo "Заявку отправить не удалось!"; }
		/*}
	}*/
} else { echo "Restricted access";}
//captcha row for template 
/*
<div class="row"><label for="cap">Введите код с картинки</label><img src="modules/mod_book/captcha.php" id="cap" onclick="this.src = 'modules/mod_book/captcha.php?' + Math.random();" /><input type="text" name="cap" id="cap" class="txt required" tabindex="9"><div class="error-box"></div></div>
*/


?>
