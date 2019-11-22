<?php
	include("db.php");

	if (isset($_POST['entrar'])) {
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$verifica = mysql_query("SELECT * FROM users WHERE email = '$email' AND password='$pass'");

		if (mysql_num_rows($verifica) <= 0){
			echo "<h3>E-mail ou Senha incorretos!</h3>";
		}
		else {
			setcookie("login", $email);
			header("Location: timeline.php");
		} 
	}
?> 
<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<style type="text/css">
		*{font-family: 'Montserrat', cursive;}
		img{display: block; margin: auto; margin-top: 20px; width: 200px;}
		form{ text-align: center; margin-top: 20px;}
		input[type="email"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px;}
		input[type="password"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; margin-top: 10px; border-radius: 3px;}
		input[type="submit"]{border: none ; width: 80px; height: 30px; margin-top: 20px; border-radius: 3px;}
		input[type="submit"]:hover{background-color: #191970; color: #FFF; cursor: pointer; }
		h2{text-align: center; margin-top: 20px;} 
		h3{text-align: center; color:#191970; margin-top: 15px;}
		p{text-decoration: none; color: #333; font-size: 18px; display: inline-block;}
		a{text-decoration: none; color: #333; font-size: 18px;}
		a:hover{color: #191970;}
	</style>

</head>
<body>
	<img src="img/logop.png"> <br>
	<h2> Entre em sua conta: </h2>
	<form method="POST">
		<input type="email" placeholder="Endereço Email" name="email"> <br>
		<input type="password" placeholder="Senha" name="pass"> <br> <br> <br>
		<input type="submit" value="Entrar" name="entrar"> 
		
	</form>
	<h3> Ainda não tem conta? Cadastre-se!</h3>
	<h2> <a href="registrar.php"> Cadastro Gratuito </a> <p> ou </p> <a href="registrarpago.php" > Cadasatro Pago </a></h2> 

</body>
</html>

