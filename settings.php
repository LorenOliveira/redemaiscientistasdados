<?php
	include("header.php");
	
	$infoo = mysql_query("SELECT * FROM users WHERE email='$login_cookie'");
	$info = mysql_fetch_assoc($infoo);
	
	if(isset($_POST['criar'])){
		$nome = $_POST['nome'];
		$sobrenome = $_POST['sobrenome'];
		$pass = $_POST['pass'];
		$cidade = $_POST['cidade'];
		$estado = $_POST['estado'];
		$salario = $_POST['salario'];
		$instrucao = $_POST['instrucao'];
		$empresa = $_POST['empresa'];
	
		if($nome == ""){
			echo "<h2> Escreva seu nome </h2>";
		}elseif($sobrenome == ""){
			echo "<h2> Escreva seu sobrenome </h2>";
	    }elseif($pass == ""){
			echo "<h2> Escreva sua senha </h2>";
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
		} else{
			
			$query = "UPDATE users SET `nome`= '$nome', `sobrenome` = '$sobrenome', `password`='$pass', `cidade`='$cidade', `estado`='$estado', `salario`='$salario', `instrucao`='$instrucao', `empresa`='$empresa' WHERE email='$login_cookie'";
			$data = mysql_query($query); 
			if ($data){
				header("Location: myprofile.php");
			}else{
				echo "<h2> Algo não ocorreu como esperávamos...</h2>";
			}
		}
	}
				
	if(isset($_POST['cancel'])){
		header("Location: myprofile.php");
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<style type='text/css'>
		*{font-family: 'Montserrat', cursive;}
		img[name="p"]{display: block; margin: auto; margin-top: 20px; width: 200px;}
		form{ text-align: center; margin-top: 10px;}
		input[type="text"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
		input[type="number"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
		input[type="password"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; margin-top: 10px; border-radius: 3px;}
		input[type="submit"]{border: none ; width: 120px; height: 30px; margin-top: 20px; border-radius: 3px;}
		input[type="submit"]:hover{background-color: #1E90FF; color: #FFF; cursor: pointer; }
		h2{text-align: center; margin-top: 20px;}
		h3{text-align: center; color: #1E90FF; margin-top: 15px;}
		a{text-decoration: none; color: #333;}
	</style>
</head>
<body>

	<img name="p" src="img/logop.png"><br />
	<h2> Alterar suas informações! </h2>

	<form method="POST">
		<input type="text" placeholder="Nome" value="<?php echo $info['nome'];?>" name="nome"><br/>
		<input type="text" placeholder="Sobrenome" value="<?php echo $info['sobrenome'];?>" name="sobrenome"><br/>
		<input type="password" placeholder="Senha" value="<?php echo $info['password'];?>" name="pass"><br/>
		<input type="text" placeholder="Cidade" value="<?php echo $info['cidade'];?>" name="cidade"><br/>
		<input type="text" placeholder="Estado" value="<?php echo $info['estado'];?>" name="estado"><br/> 
		<input type="number" placeholder="Salário" value="<?php echo $info['salario'];?>" name="salario"><br/>
		<input type="text" placeholder="Nível de Instrução" value="<?php echo $info['instrucao'];?>" name="instrucao"><br/>
		<input type="text" placeholder="Empresa" value="<?php echo $info['empresa'];?>" name="empresa"><br/>


		<input type="submit" value="Atualizar Infos" name="criar">&nbsp;&nbsp;&nbsp;
		<input type="submit" value="Cancelar" name="cancel">
	</form>
</body>
</html>