<?php
	include("db.php");

	$login_cookie = $_COOKIE['login'];
	if(!isset($login_cookie)){
		header("Location: index.php"); # troquei para index, era login.php
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'> 
	<style type="text/css"> 
	*{font-family: 'Montserrat', cursive; margin: 0;}
	body{ background: #F6F6F6; }
	div#topo{width: 100%; top:0; background: #FFF; box-shadow: 0 0 10px $000; height: 80px;}
	div#topo img[name="logo"]{float: left; margin-left: 20px; margin-top: 10px;}
	div#topo img[name="menu"]{float: right; margin-right: 25px; margin-top: -20px;}
	div#topo input[type="text"]{display: block; margin: auto; width: 300px; border: none; border-radius: 3px; background: #F6F6F6; height: 30px; padding-left: 10px; box-shadow: inset 0 0 6px #666;}
	div#topo form{width: 300px; display: block; margin: auto; padding-top: 22px;}
	div#footer{bottom: 0; text-align: center; color: #666;}
	div#topo img[name="posicao"]{float: right; margin-right: 25px; margin-top: -24px;}


	</style>
</head>
<body>
	<div id="topo">
		<a href="timeline.php"><img src="img/logop.png" width="80" name="logo" ></a> <!-- antigo index, mudei para timeline.php -->
		<form method="GET" action="pesquisar.php">
		<input type="text" placeholder="Pesquisar alguém..." name="query" autocomplete="off"><input type="submit" hidden> 
		</form>
		<a href="inbox.php"><img src="img/chat.png" width="30" name="menu" ></a>

		<a href="pedidos.php"><img src="img/pedidos.png" width="40" height="40" name="posicao" ></a>
		<a href="myprofile.php"><img src="img/perfil.png" width="30" name="menu" ></a>
	</div>
</body>
</html>
