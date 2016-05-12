<?php require('verify.php');?>
<html>
	<head>	
		<link rel="stylesheet" style="text/css" href="petshop.css">
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

	<div id="forma">
		<form method="POST" action="listtable.php">
			<h3> Relatórios </h3>
			<table id="tables">
				<tr>					
					<td>Gerir Relatório:</td><td><select name=relat>
														<option value="clientes">Clientes</option>
														<option value="anims">Animais</option>
														<option value="vendas">Vendas</option>
														<option value="servs">Serviços</option>
														<option value="conts">Contas a Pagar</option>
														</td>				
				</tr>
				<tr>					
					<td>Ordenar: </td><td><select name=ordern>
											<option value="datee">Por data de criação</option>
											<option value="mod">Por data de modificação</option>
											<option value="relev">Por relevancia</option></td>
				</tr>
			</table>
			<br>
			<input type="submit" value="Gerar" name="botao">
	</div>
	
	<div id="bottom">
		
	</div>
</body>
</html>