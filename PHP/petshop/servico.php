<?php require('verify.php');?>
<html>
	<head>	
		<link rel="stylesheet" style="text/css" href="petshop.css">
		<link rel="shortcut icon" type="image/png" href="/favicon.png"/>
		<title> :: DOGESHOP :: SERVIÇOS ::</title>
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
		<form method="POST" action=#>
			<h3> Vendas / Serviços </h3>
			<table id="tables">
				<tr>			
					<td>Tipo:</td> <td><input type="radio" name=tipe value="male"> Venda <input type="radio" name="gender" value="male"> Serviço </td>				
				</tr>
				<tr>
				<td>Serviço / Produto:</td><td><select name=prodserv>
														<option value="1">...       </option>
											</td>
				</tr>
				<tr>
				<td>Forma de Pagamento:</td><td><select name=typepay>
														<option value="1">Dinheiro</option>
														<option value="1">Cartão de Crédito</option>
														<option value="1">Cartão de Débito</option>
														<option value="1">Cheque</option>
														<option value="1">Duplicata</option>
											</td>
				</tr>
				<tr>
						<td>Valor:</td><td>R$ <input type="text" name=payment maxlength="15" value="0,00"></td>					
				</tr>
			</table>
			<br>
			<input type="submit" value="Gravar" name="botao"> <input type="reset" value="Zerar" name="novo">
	</div>
	
	<div id="bottom">
		
	</div>
</body>
</html>