<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
require('verify.php');

@$id = @$_REQUEST['idClient'];
@$host= 'localhost';
@$userbd= 'root';
@$bd= 'sistema';
@$senhabd= '';
 
@$userbd = $bd; 

@$nomeClient = $_POST['nomeClient'];
@$sobrClient = $_POST['sobrClient'];
@$gender = $_POST['gender'];
@$diaNasc = $_POST['diaNasc'];

$conexao = mysql_connect('localhost','root','');
if (!$conexao)
	die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());

$banco = mysql_select_db($bd,$conexao);
if (!$banco)
	die ("Erro de conexão com banco de dados, o seguinte erro ocorreu -> ".mysql_error());
 
$id = @$_REQUEST['idClient'];

if (@$_REQUEST['idClient'] and !$_REQUEST['botao'])
{
	$query = "
		SELECT * FROM cliente WHERE id='{$_REQUEST['idClient']}'
	";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	foreach( $row as $key => $value )
	{
		$_POST[$key] = $value;
	}
}

if (@$_REQUEST['botao'] == "Gravar") 
{
	if (!$_REQUEST['idClient'])
	{
		$insere = "INSERT into cliente (nomeClient, sobrClient, gender) VALUES ('{$_POST['nomeClient']}', '{$_POST['sobrClient']}', '{$_POST['gender']}')";
		$result_insere = mysql_query($insere);
		
		if ($result_insere) echo "<h2> Registro inserido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui inserir!!!</h2>";
		
	} else 	
	{
		$insere = "UPDATE cliente SET 
					nomeClient = '{$_POST['nomeClient']}'
					, sobrClient = '{$_POST['sobrClient']}'
					, gender = '{$_POST['gender']}'
					WHERE id = '{$_REQUEST['idClient']}'
				";
		$result_update = mysql_query($insere);

		if ($result_update) echo "<h3> Cliente cadastrado com sucesso!</h2>";
		else echo "<h2> Algo falhou no cadastro!</h2>";
	}
}
 
mysql_query($query,$conexao);
 
echo "Seu cadastro foi realizado com sucesso!";
?>

<html>
	<head>	
		<link rel="stylesheet" style="text/css" href="petshop.css">
		<link rel="shortcut icon" type="image/png" href="/favicon.png"/>
		<title> :: DOGESHOP :: CADASTRO CLIENTE :: </title>
		<?php include ('config.php');  ?>
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
		<form method="POST" action="cadastrodono.php" name="cadastrocliente">
			<h3> Cadastro de Cliente </h3>
			<table id="tables">
				<tr>					
					<td>Nome:</td><td><input type="text" name=nomeClient maxlength="15" value="<?php echo @$_POST['nomeClient']; ?>"></td>					
				</tr>
				<tr>					
					<td>Sobrenome:</td><td><input type="text" name=sobrClient maxlength="25" value="<?php echo @$_POST['sobrClient']; ?>"></td>
				</tr>
				<tr>			
					<td>Sexo:</td> <td><input type="radio" name=gender value="m"> <?php echo (@$_POST['gender'] == "M" ? " checked" : "" );?> Masculino <input type="radio" name="gender" value="f"> <?php echo (@$_POST['gender'] == "F" ? " checked" : "" );?> Feminino</td>				
				</tr>
			</table>
			<br>
			<input type="submit" value="Gravar" name="botao">
			<input type="reset" value="Zerar" name="novo">
			<input type="hidden" name="id" value="<?php echo @$_REQUEST['idClient'] ?>" />
	</div>
	
	<div id="bottom">
		
	</div>
</body>
</html>