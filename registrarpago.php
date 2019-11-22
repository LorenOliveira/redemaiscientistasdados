<?php
	include("db.php");

	if (isset($_POST['criar'])) {
		$nome = $_POST['nome'];
		$sobrenome = $_POST['sobrenome'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$cidade = $_POST['cidade'];
		$estado = $_POST['estado'];
		$salario = $_POST['salario'];
		$instrucao = $_POST['instrucao'];
		$empresa = $_POST['empresa'];
		$num_cartao = $_POST['num_cartao'];
		$nome_cartao = $_POST['nome_cartao'];
		$cvv = $_POST['cvv'];
		$data = date("Y/m/d");
		

		$email_check = mysql_query("SELECT email FROM users WHERE email='$email'");
		$do_email_check = mysql_num_rows($email_check);
		if ($do_email_check >= 1){
			echo '<h3> Este email já está registrado, faça seu login <a href="login.php"> aqui </a></h3>';
		}elseif ($nome == '' OR  strlen($nome) <3){
			echo '<h3>Escreva seu nome corretamente! </h3>';
		}elseif ($email == '' OR  strlen($email) <10){
			echo '<h3>Escreva seu email corretamente! </h3>';
		}elseif ($pass == '' OR  strlen($pass) <5){
			echo '<h3>Escreva sua senha corretamente, ela deve ter mais que 5 caracteres!</h3>';
		}elseif ($cidade == '' OR  strlen($cidade) <2){
			echo '<h3>Escreva sua cidade corretamente, ela deve ter mais que 2 caracteres! </h3>';
		}elseif ($estado == '' OR  strlen($estado) >2){
			echo '<h3> Escreva somente a sigla de seu estado! </h3>';
		}elseif ($salario == '' OR  strlen($salario) < 0){
			echo '<h3> Digite um salário maior que zero! (Caso não possua, digite 0) </h3>';
		}elseif ($instrucao== '' OR  strlen($instrucao) <7){
			echo '<h3> Digite um nível de instrução válido! </h3>';
		}elseif ($empresa == '' OR  strlen($empresa) <2){
			echo '<h3> Digite uma empresa válida! (Caso não esteja trabalhando, digite "Nenhuma")'; 
		}elseif ($num_cartao == '' OR strlen($num_cartao) <16 OR strlen($num_cartao) >16){
			echo '<h3> Digite uma número de cartão válido! </h3>';
		}elseif ($nome_cartao == '' OR  strlen($nome_cartao) <3){
			echo '<h3> Digite um nome válido! </h3> ';
		}elseif ($cvv== '' OR  strlen($cvv) <3 OR strlen($cvv) >3){
			echo '<h3> Digite um CVV válido! </h3>'; 
		} else{ 
		
			$query = "INSERT INTO users (`nome`, `sobrenome`, `email`, `password`, `cidade`, `estado`, `salario`, `instrucao`, `empresa`, `num_cartao`, `nome_cartao`, `cvv`, `data`) VALUES ('$nome', '$sobrenome', '$email', '$pass', '$cidade', '$estado', '$salario', '$instrucao', '$empresa', '$num_cartao', '$nome_cartao', '$cvv', '$data')";
			$data_nasc = mysql_query($query) or die(mysql_error());
			if ($data){
				setcookie("login", $email);
				header("location: ./");
			}else {
				echo "<h3> Desculpe, houve um erro ao registrar sua conta! </h3>";
			}
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
		form{ text-align: center; margin-top: 10px;}
		input[type="text"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
		input[type="email"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
		input[type="password"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; margin-top: 10px; border-radius: 3px;}
		input[type="number"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
		input[type="date"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
		input[type="submit"]{border: none ; width: 120px; height: 30px; margin-top: 20px; border-radius: 3px;}
		input[type="submit"]:hover{background-color: #191970; color: #FFF; cursor: pointer; }
		h2{text-align: center; margin-top: 20px;}
		h3{text-align: center; color: #191970; margin-top: 15px;}
		a{text-decoration: none; color: #333;}
	</style>

</head>
<body>
	<img src="img/logop.png"> <br>
	<h2> Cria a tua conta: </h2>
	<form method="POST">
		<input type="text" placeholder="Nome" name="nome"> <br>
		<input type="text" placeholder="Sobrenome" name="sobrenome"> <br>
		<input type="email" placeholder="Email" name="email"> <br>
		<input type="password" placeholder="Senha" name="pass"> <br>
		<input type="text" placeholder="Cidade" name="cidade"> <br>
		<input type="text" placeholder="Estado" name="estado"> <br>
		<input type="number" placeholder="Salário" name="salario"> <br>
		<input type="text" placeholder="Nível de Instrução" name="instrucao"> <br>
		<input type="text" placeholder="Empresa" name="empresa"> <br>
		<input type="text" placeholder="Número do Cartão" name="num_cartao"> <br>
		<input type="text" placeholder="Nome do Cartão" name="nome_cartao"> <br>
		<input type="text" placeholder="CVV" name="cvv"> <br> 
	
		<input type="submit" value="Criar uma conta" name="criar"> 

	</form>
	<h3> Já tem uma conta? <a href="index.php"> Faça login aqui!</a></h3> <!-- era login.php, troquei para index.php -->
</body>
</html>




