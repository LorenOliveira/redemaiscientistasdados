<?php
	include("header.php");
	$sql = mysql_query("SELECT * FROM mensagens WHERE para='$login_cookie' GROUP BY de ORDER BY id");
	$ups = mysql_query("SELECT * FROM mensagens WHERE para='$login_cookie' AND status=0");
	$contagem = mysql_num_rows($ups);
?>
<html>
	<header>
		<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
		<style type="text/css">
			*{font-family: 'Montserrat', cursive;}
			div#box p{text-align: center; cursor: pointer; color: #333;}
			div#box p:hover{color: 007fff;}
			div#box{min-width: 100px;  max-width: 500px; display: block; margin: auto;}
			div#box:hover{box-shadow: inset 0 0 6px #AAA; border-radius: 5px;}
			a{text-decoration: none;}
			hr{width: 400px; display: block; margin: auto; border: 1px solid #555;}
			h1{text-align: center; color: ##191970; font-size: 21px;}
			h3{text-align: center; color: #AAA; }


		</style>

	</header>
	<body>
		<h1> Conversas </h1>
		<form method="POST">
			<div> 
				<?php
					while($msg = mysql_fetch_assoc($sql)){
							$from = $msg["de"];
							$tudo = mysql_query("SELECT * FROM users WHERE email='$from'");
							$img = mysql_fetch_assoc($tudo);
							$conta = mysql_query("SELECT * FROM mensagens WHERE de='$from' AND para='$login_cookie' AND status=0");
							$contar = mysql_num_rows($conta);

							echo '<br /> <a name="d" href="chat.php?from='.$img["id"].'"> <div id="box"> 
							<br /> <p>'.$img["nome"].' '.$img["sobrenome"].' - '.$contar.' mensagens novas </p> <br />
							</div></a><br />
							<hr />';
					}

				?>
			</div>
		</form>
		<br /><br />
	<div id="footer"><p>&copy; Rede+Cientistas, 2019 - Todos os direitos reservados.</p></div> <br />
	</body>
</html>