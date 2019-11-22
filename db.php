<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	$connect = mysql_connect("mysql113.prv.f1.k8.com.br.", "redemaiscientis", "redesocial10") or die();
	$db = mysql_select_db("redemaiscientistas", $connect) or die(); 
?>


<html>
<header>
	<meta charset="utf-8">
	<title> Rede+Cientistas! </title>
	<style type="text/css"> 

		@keyframes fadein {
		    from { opacity: 0; }
		    to   { opacity: 1; }
		}

		/* Firefox < 16 */
		@-moz-keyframes fadein {
		    from { opacity: 0; }
		    to   { opacity: 1; }
		}

		/* Safari, Chrome and Opera > 12.1 */
		@-webkit-keyframes fadein {
		    from { opacity: 0; }
		    to   { opacity: 1; }
		}
		
	</style>

</header>
</html>
