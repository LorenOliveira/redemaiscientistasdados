<?php
	include("header.php");

	$pubs = mysql_query("SELECT
			T.id,
			T.user, 
			T.texto,
			T.imagem,
			T.data,
			U.de, 
			U.para,
			U.aceite
		FROM 
			pubs AS T,
			amizades as U
		WHERE 
			T.user = U.de AND U.para = '$login_cookie' AND U.aceite = 'sim'
			OR T.user = U.para AND U.de = '$login_cookie' AND U.aceite = 'sim'
			order by T.id DESC;"); 
		

	if (isset($_POST['publish'])) {
		if ($_FILES["file"]["error"] > 0) {
			$texto = $_POST["texto"];
			$hoje = date("Y/m/d");

			if ($texto == ""){
				echo "<h3> Você precisa digitar algo antes de publicar! </h3>";
			}else {
				$query = "INSERT INTO pubs (user, texto, data) VALUES ('$login_cookie', '$texto', '$hoje')";
				$data = mysql_query($query) or die();
				if ($data){
					header("Location: timeline.php");
				}else{
					echo "Alguma coisa não ocorreu bem... Tente outra vez mais tarde!";
				}
			}
		}else {
			$n = rand(0, 1000000);
			$img = $n.$_FILES["file"]["name"];

			move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$img);
			$texto = $_POST['texto'];
			$hoje = date("Y/m/d");

			if ($texto == ""){ 
				echo "<h3> Você precisa digitar algo antes de publicar! </h3>";
			}else {
				$query = "INSERT INTO pubs (user, texto, imagem, data) VALUES ('$login_cookie', '$texto', '$img', '$hoje')";
				$data = mysql_query($query) or die();
				if ($data){
					header("Location: ./");
				}else{
					echo "Alguma coisa não ocorreu bem... Tente outra vez mais tarde!";
				}
			}	
		}
	}

	if (isset($_GET["love"])){
		love();
	}
	function love(){
		$login_cookie = $_COOKIE['login'];
		$publicacaoid = $_GET['love'];
		$data = date("Y/m/d");
		

		$ins = "INSERT INTO loves (`user`, `pub`, `date`) VALUES ('$login_cookie', '$publicacaoid', '$data')";
		$conf = mysql_query($ins) or die(mysql_error());
		if ($conf){
			header("Location: timeline.php"); # era login.php, troquei para index.php
		}else{
			echo "<h3>Erro </h3> ".mysql_error();
		}
	}

	if (isset($_GET["unlove"])){
		unlove();
	}
	function unlove(){
		$login_cookie = $_COOKIE['login'];
		$publicacaoid = $_GET['unlove'];
		$data = date("Y/m/d");

		$del = "DELETE FROM loves WHERE `user`= '$login_cookie' AND `pub`= '$publicacaoid'";
		$conf = mysql_query($del) or die(mysql_error());
		if ($conf){
			header("Location: timeline.php"); # era login.php, troquei para index.php
		}else{
			echo "<h3>Erro </h3> ".mysql_error();
		}
	}
?>
<html>
<header> 
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<style type="text/css">
	*{font-family: 'Montserrat', cursive;}
	div#publish{width: 400px; height: 210px; display: block; margin: auto; border: none; border-radius:5px; background: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}	
	div#publish textarea{width: 365px; height: 150px; display: block; margin: auto; border-radius: 5px; padding-left: 5px; padding-top: 5px; border-width: 1px; border-color: #A1A1A1;}
	div#publish img{margin-top: 4px; margin-left: 10px; width: 30px; cursor: pointer;}
	div#publish input[type="submit"]{width: 70px; height: 25px; border-radius: 3px; float: right;; margin-right: 15px; border:none; margin-top: 5px; background: #CCC; color: #FFF; cursor: pointer;}
	div#publish input[type="submit"]:hover{background: #191970; }

	div.pub{width: 400px; min-height: 70px; max-height: 1000px; display: block; margin: auto; border-radius: 5px; background-color: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}
	div.pub a{color: #666; text-decoration: none;}
	div.pub a:hover{color: #111; text-decoration: none;}
	div.pub p{margin-left: 10px; content: #666; padding-top: 10px;}
	div.pub span{display: block; margin: auto; width: 380px; margin-top: 10px;}
	div.pub img{display: block; margin: auto; width: 100%; margin-top: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;}
	div#love{width: 400px; height: 30px; display:block; margin: auto; border: none; border-radius: 5px; background: #191970; margin-top: 5px;}
	div#love p{color: #FFF; font-size: 12px; padding-top: 5px; padding-left: 5px;}
	div#love a{color: #FFF; font-size: 16px; text-decoration: none;}

	</style>
</header>
<body>
	<div id="publish">
		<form method="POST" enctype="multipart/form-data">
			<br/>
			<textarea placeholder="Escreva uma publicação nova..." name="texto"></textarea>
			<label for="file-input">
				<img src="img/imagegrey.png" title="Inserir uma fotografia"/>
			</label>
			<input type="submit" value="Publicar" name="publish"/>

			<input type="file" id="file-input" name="file" hidden/>
		</form>
	</div>
	<?php
		while($pub=mysql_fetch_assoc($pubs)) {
			$email = $pub['user'];
			$saberr = mysql_query("SELECT * FROM users WHERE email='$email'");
			$saber = mysql_fetch_assoc($saberr);
			$nome = $saber['nome']." ".$saber['sobrenome'];
			$id = $pub['id'];
			$saberloves = mysql_query("SELECT * FROM loves WHERE pub='$id'");
			$loves = mysql_num_rows($saberloves);

			if ($pub['imagem']=="") {
				echo '<div class="pub" id="'.$id.'">
					<p><a href="profile.php?id='.$saber['id'].'">'.$nome.'</a> - '.$pub["data"].'</p>
				<span>'.$pub['texto'].'</span><br /> </div>
				<div id="love">';
				$email_check = mysql_query("SELECT user FROM loves WHERE pub='$id' AND user='$login_cookie'" );
				$do_email_check = mysql_num_rows($email_check);
				if ($do_email_check >= 1){
					$loves = $loves - 1;
					echo '<p><a href="timeline.php?unlove='.$id.'"> Gostei</a> | Você e mais '.$loves.' gostaram dessa publicação </p>'; # era o antigo index.php, troquei para timeline.php

				}else{
					echo '<p><a href="timeline.php?love='.$id.'"> Gostar</a> |'.$loves.' gostaram dessa publicação </p>'; # era o antigo index.php, troquei para timeline.php
				}
				echo '</div>';
			}else {
				echo '<div class="pub" id="'.$id.'">
				<p><a href="profile.php?id='.$saber['id'].'">'.$nome.'</a> - '.$pub["data"].'</p>
				<span>'.$pub['texto'].'</span> 
				<img src="upload/'.$pub["imagem"].'"/>
				</div>
				<div id="love">';
				$email_check = mysql_query("SELECT user FROM loves WHERE pub='$id' AND user='$login_cookie'" );
				$do_email_check = mysql_num_rows($email_check);
				if ($do_email_check >= 1){
					$loves = $loves - 1;
					echo '<p><a href="timeline.php?unlove='.$id.'"> Gostei</a> | Você e mais '.$loves.' gostaram dessa publicação </p>'; # era o antigo index.php, troquei para timeline.php

				}else{
					echo '<p><a href="timeline.php?love='.$id.'"> Gostar</a> |'.$loves.' gostaram dessa publicação </p>'; # era o antigo index.php, troquei para timeline.php
				}
				echo '</div>';
			}
		}
	?>
	<br />
	<div id="footer"><p>&copy; Rede+Cientistas, 2019 - Todos os direitos reservados.</p></div> <br />
</body>
</html>

