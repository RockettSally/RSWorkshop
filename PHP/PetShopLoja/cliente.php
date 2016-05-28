<html>

    <head>
        <title>Cadastro de Clientes</title>
        <?php include ('config.php'); ?>
    </head>

    <body>
        <?php
        $id = @$_REQUEST['id'];

        if (@$_REQUEST['botao'] == "Excluir") {
            $query_excluir = "
			DELETE FROM cliente WHERE id='$id'
		";
            $result_excluir = mysql_query($query_excluir);

            if ($result_excluir)
                echo "<h2> Registro excluido com sucesso!!!</h2>";
            else
                echo "<h2> Nao consegui excluir!!!</h2>";

            echo "Excluir - $query_excluir";
        }

        if (@$_REQUEST['id'] and ! $_REQUEST['botao']) {
            $query = "
		SELECT * FROM cliente WHERE id='{$_REQUEST['id']}'
	";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);
            //echo "<br> $query";	
            foreach ($row as $key => $value) {
                $_POST[$key] = $value;
            }
        }

        if (@$_REQUEST['botao'] == "Gravar") {
            if (!$_REQUEST['id']) {
                $insere = "INSERT into cliente (nome, idade, sexo, telefone) VALUES ('{$_POST['nome']}', '{$_POST['idade']}', '{$_POST['sexo']}', '{$_POST['telefone']}')";
                $result_insere = mysql_query($insere);

                if ($result_insere)
                    echo "<h2> Registro inserido com sucesso!!!</h2>";
                else
                    echo "<h2> Nao consegui inserir!!!</h2>";

                echo "Gravar - $insere";
            } else {
                $insere = "UPDATE cliente SET 
					nome = '{$_POST['nome']}'
					, idade = '{$_POST['idade']}'
					, sexo = '{$_POST['sexo']}'
					, telefone = '{$_POST['telefone']}'
					WHERE id = '{$_REQUEST['id']}'
				";
                $result_update = mysql_query($insere);

                if ($result_update)
                    echo "<h2> Registro atualizado com sucesso!!!</h2>";
                else
                    echo "<h2> Nao consegui atualizar!!!</h2>";

                echo "Atualizar - $insere";
            }
        }
        ?>

        <form action="cliente.php" method="post" name="cliente">
            <table width="200" border="1">
                <tr>
                    <td colspan="2">Cadastro de Clientes</td>
                </tr>
                <tr>
                    <td width="53">Cod.</td>
                    <td width="131"><?php echo @$_POST['id']; ?>&nbsp;
                </tr>
                <tr>
                    <td>Nome:</td>
                    <td><input type="text" name="nome" value="<?php echo @$_POST['nome']; ?>"></td>
                </tr>
                <tr>
                    <td>Idade:</td>
                    <td><input type="text" name="idade" value="<?php echo @$_POST['idade']; ?>"></td>
                </tr>
                <tr>
                    <td>Sexo:</td>
                    <td><input type="radio" name="sexo" value="M" <?php echo (@$_POST['sexo'] == "M" ? " checked" : "" ); ?> > Masc
                        <input type="radio" name="sexo" value="F" <?php echo (@$_POST['sexo'] == "F" ? " checked" : "" ); ?> > Fem   
                    </td>
                </tr>
                <tr>
                    <td>Telefone:</td>
                    <td><input type="text" name="telefone" value="<?php echo @$_POST['telefone']; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2" align="right"><input type="submit" value="Gravar" name="botao"> - <input type="submit" value="Excluir" name="botao">
                        -
                        <input type="reset" value="Novo" name="novo"> 	<input type="hidden" name="id" value="<?php echo @$_REQUEST['id'] ?>" />
                    </td>
                </tr>	
            </table>
        </form>


    </body>
</html>