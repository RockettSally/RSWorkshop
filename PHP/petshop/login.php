<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
include ('config.php');
session_start();

if (@$_REQUEST['botao']=="Entrar")
{
		
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	
	$query = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha' ";
	$result = mysql_query($query);
		
	while ($coluna=mysql_fetch_array($result)) 
	{
		
		$_SESSION["id_usuario"]= $coluna["id"]; 
		$_SESSION["nome_usuario"] = $coluna["login"]; 
		header("Location: petshop.php"); 
		exit; 

	}
	
}

?>

<html>
	<head>	
		<link rel="stylesheet" style="text/css" href="petshop.css">
		<link rel="shortcut icon" type="image/png" href="/favicon.png"/>
		<title> :: DOGESHOP ::  LOGIN ::</title>
	</head>
<body>
	<!--<div id="Top">
			<img class="home" src="doge.gif">
	</div>-->

	<div id="forma">
		<form method=POST action=#>
			<h3> Login </h3>
			<table>
			<tr>					
					<td>Login:</td><td><input type="text" name=login></td>					
			</tr>
			<tr>					
					<td>Senha:</td><td><input type="password" name=senha></td>
			</tr>
			</table>
			<br>
			<input type="submit" value=Entrar name="botao">
		</form>
	</div>
	
	<div id="bottom">
		
	</div>
</body>
</html>