﻿<?php require('verify.php');?>
<html>
	<head>	
		<link rel="stylesheet" style="text/css" href="petshop.css">
		<link rel="shortcut icon" type="image/png" href="/favicon.png"/>
		<title> :: DOGESHOP :: </title>
	</head>
<body>
	<div id="Top">
		<a id="lol" href="petshop.php">
			<img class="home" src="doge.gif">
		</a>
		<div class="Cadastro">
			<a href="cadastro.php">Cadastro</a>
		</div>
		<div class="Cadastro">
			<a href="servico.php">Serviços</a>
		</div>
		<div class="Cadastro">
			<a href="relatorio.php">Relatório</a>
		</div>
		<div class="Cadastro">
			<a href="contas.php">Contas a Pagar</a>
		</div>		
		<div class="Cadastro">
			<a href="admin.php">
				<img class="home" src="cog.png">
			</a>
		</div>
	</div>
	<div id="main">
		
	</div>
	
	<div id="bottom">
	
	<p class="bomdia"> Bom dia, <?php  echo $_SESSION["nome_usuario"]?></p>
	</div>
</body>
</html>