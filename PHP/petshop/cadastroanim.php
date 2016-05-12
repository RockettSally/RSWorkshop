<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
require('verify.php');

@$id = @$_REQUEST['id'];
@$host= 'localhost';
@$userbd= 'root';
@$bd= 'sistema';
@$senhabd= '';
 
@$userbd = $bd; 

@$nomeAnimal = $_POST['nomeClient'];
@$gender = $_POST['gender'];
@$dia = $_POST['dia'];
@$mes = $_POST['mes'];
@$ano = $_POST['ano'];
@$especieAnimal = $_POST['especieAninal'];
@$nomeClient = $_POST['nomeClient'];

$conexao = mysql_connect('localhost','root','');
if (!$conexao)
	die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());

$banco = mysql_select_db($bd,$conexao);
if (!$banco)
	die ("Erro de conexão com banco de dados, o seguinte erro ocorreu -> ".mysql_error());
 
 
 
$id = @$_REQUEST['id'];

if (@$_REQUEST['id'] and !$_REQUEST['botao'])
{
	$query = "
		SELECT * FROM cliente WHERE id='{$_REQUEST['id']}'
	";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	//echo "<br> $query";	
	foreach( $row as $key => $value )
	{
		$_POST[$key] = $value;
	}
}

if (@$_REQUEST['botao'] == "Gravar") 
{
	if (!$_REQUEST['id'])
	{
		$insere = "INSERT into cliente (nomeAnimal, gendAnimal, especieAnimal, nomeClient) VALUES ('{$_POST['nomeAnimal']}', '{$_POST['gendAnimal']}', '{$_POST['dia']}', '{$_POST['mes']}', '{$_POST['ano']}', '{$_POST['especieAnimal']}', '{$_POST['nomeClient']}')";
		$result_insere = mysql_query($insere);
		
		if ($result_insere) echo "<h2> Registro inserido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui inserir!!!</h2>";
		
	} else 	
	{
		$insere = "UPDATE cliente SET 
					nomeAnimal = '{$_POST['nomeAnimal']}'
					, gendAnimal = '{$_POST['gendAnimal']}'				
					, especieAnimal = '{$_POST['especieAnimal']}'
					, nomeClient = '{$_POST['nomeClient']}'
					WHERE id = '{$_REQUEST['idClient']}'
				";
		$result_update = mysql_query($insere);

		if ($result_update) echo "<h2> Registro atualizado com sucesso!!!</h2>";
		else echo "<h2> Nao consegui atualizar!!!</h2>";
		
		echo "Atualizar - $insere";
	}
}
 
mysql_query($query,$conexao);
 
echo "Seu cadastro foi realizado com sucesso!";

$query = "
			SELECT idClient, nomeClient
			FROM cliente
			ORDER BY nomeClient
			";
$result = mysql_query($query);
		
?>

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

	<div id="forma">
		<form method="POST" action="cadastroanim.php" name="cadastroanim">
			<h3> Cadastro de Animal </h3>
			<table id="tables">
				<tr>					
					<td>Nome:</td><td><input type="text" name=nomeAnimal maxlength="15" value="<?php echo @$_POST['nomeClient']; ?>"></td>					
				</tr>
				<tr>			
					<td>Sexo:</td> <td><input type="radio" name=gendAnimal value="m"><?php echo (@$_POST['gendAnimal'] == "M" ? " checked" : "" );?> Macho <input type="radio" name="gender" value="f"><?php echo (@$_POST['gendAnimal'] == "F" ? " checked" : "" );?> Fêmea </td>				
				</tr>
				<tr>					
					<td>Espécie:</td><td>
							<select name=especieAnimal>
								<option value="cachorro">Cachorro</option>
								<option value="gato">Gato</option>
								<option value="peixe">Peixe</option>
								<option value="pássaro">Pássaro</option>
								<option value="outros">Outros</option>
							</select>
				</td>					
				</tr>
				<tr>			
					<td>Nome (Dono):</td><td><select name=especieAnimal>
												<option value="">(selecione)</option>
					<?php
					while( $row = mysql_fetch_assoc($resespe) )
								{
									?>
									<option value="<?php echo $row['idEspecie']; ?>"><?php echo @$row['especieAnimal'] ?></option>
									<?php
						}
					?>
					</select></td> 						
				</tr>
			</table>
			<br>
			<input type="submit" value="Gravar" name="botao">
			<input type="reset" value="Zerar" name="novo">
			<input type="hidden" name="id" value="<?php echo @$_REQUEST['id'] ?>" />
	</div>
	
	<div id="bottom">
		
	</div>
</body>
</html>