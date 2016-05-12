<?php
@$nome = $_POST['nome'];
@$password = $_POST['password'];
@$op = $_POST['opcao'];



?>

<html>
	<head>
	
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>
			PHP Formulário
		</title>
	
	</head>


<body>
		<div id=topo>
		
		</div>
		<div id=senha>
		
			<form action=# method=POST>	
<pre>			
			Login

Usuário: &#9; <input type=text name=nome maxlength="16" value="<?php echo $nome ?>">
Senha: &#9; <input type=password name=password maxlength="8" value="<?php echo $password ?>">
	
			<input type=submit name=botao value=Gravar>
				</pre>
			</form>
		</div>
</body>



</html>