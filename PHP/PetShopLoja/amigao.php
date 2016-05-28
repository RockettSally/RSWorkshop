<html>
    <head>
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>Pet Shop | Amigão</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>

        <?php include ('config.php'); ?>
    </head>

    <body>




        <?php
        //$id = @$_REQUEST['id'];
        $btnExcluirEnable = true;

        $responsa = mysql_query("SELECT id, nome_responsavel FROM responsavel");
        $servicosArraay = mysql_query("SELECT id, descricao, preco FROM servico");
        if (@$_REQUEST['botao'] == "Excluir") {
            $query_excluir = "
			DELETE FROM amigao WHERE id='{$_POST['buscar_id']}'
		";
            $result_excluir = mysql_query($query_excluir);

            if ($result_excluir)
                echo"<script>alert('Registro excluído com sucesso!!!')</script>";
            else
                echo"<script>alert('Nao consegui excluir!!!')</script>";

            //echo "Excluir - $query_excluir";
        }

        if (@$_REQUEST['botao'] == "Buscar") {

            $query = "
		SELECT a.id, a.nome, a.idade, r.nome_responsavel as nomeresponsavel, a.raca, a.sexo, a.obs, r.id as idresponsavel FROM amigao a 
                 INNER JOIN responsavel r ON a.id_responsavel = r.id
                    WHERE a.nome like '" . $_REQUEST['pesquisaramigao'] . "%' OR a.id='{$_REQUEST['pesquisaramigao']}'
                ";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);


//            echo $row["id"]; echo '----';
//            echo $row["nome"];echo '----';
//            echo $row["idade"];echo '----';
//            echo $row["nomeresponsavel"];echo '----';
//            echo $row["raca"];echo '----';
//            echo $row["sexo"];echo '----';
//            echo $row["obs"];echo '----';
//            echo '----';
//            echo $row["idresponsavel"];

            $_REQUEST['buscar_id'] = $row["id"];
            $getid = $row["id"];

            if ($row["id"] > 0) {
                $btnExcluirEnable = false;
            }
            $_REQUEST['buscar_nome'] = $row["nome"];
            $_REQUEST['buscar_idade'] = $row["idade"];
            $_REQUEST['buscar_responsavel'] = $row["nomeresponsavel"];
            $_REQUEST['buscar_raca'] = $row["raca"];
            if ($row["sexo"] == 1) {
                $_REQUEST['buscar_sexo'] = 'Macho';
            } else if ($row["sexo"] == 2) {
                $_REQUEST['buscar_sexo'] = 'Fêmea';
            } else {
                $_REQUEST['buscar_sexo'] = '';
            }
            $_REQUEST['buscar_obs'] = $row["obs"];
        }

        if (@$_REQUEST['botao'] == "Gravar") {
            // if (!$_REQUEST['id']) {

            $insere = "INSERT into amigao (nome, idade, id_responsavel, raca, sexo, obs) VALUES ('{$_POST['nome_amigao']}','{$_POST['idade_amigao']}', '{$_POST['id_responsavel_amigao']}', '{$_POST['raca_amigao']}','{$_POST['sexo_amigao']}', '{$_POST['obs_amigao']}'                        
                        
)";
            $result_insere = mysql_query($insere);

            if ($result_insere)
                echo"<script>alert('Registro inserido com sucesso!!!')</script>";
            else
                echo"<script>alert('Nao consegui inserir!!!')</script>";

            // echo "Gravar - $insere";
            // }
//            else {
//                $insere = "UPDATE cliente SET 
//					nome = '{$_POST['nome']}'
//					, idade = '{$_POST['idade']}'
//					, sexo = '{$_POST['sexo']}'
//					, telefone = '{$_POST['telefone']}'
//					WHERE id = '{$_REQUEST['id']}'
//				";
//                $result_update = mysql_query($insere);
//
//                if ($result_update)
//                    echo "<h2> Registro atualizado com sucesso!!!</h2>";
//                else
//                    echo "<h2> Nao consegui atualizar!!!</h2>";
//
//                echo "Atualizar - $insere";
//            }
        }

        if (@$_REQUEST['botao'] == "Finalizar") {
            $aux = 0;
            foreach ($_POST['servico'] as $value) {
//                echo $value . '<br/>';
                $insere = "INSERT into atendimento (id_servico, id_amigao) VALUES ('$value','{$_POST['buscar_id']}')";
               // $idRecuperado = mysql_insert_id();
               // echo"<script>alert('id recuperado ---- $idRecuperado!!!')</script>";
                $result_insere = mysql_query($insere);

                $query = "SELECT * FROM atendimento a INNER JOIN servico s ON s.id = a.id_servico WHERE a.id_amigao = '{$_POST['buscar_id']}'";
                $result = mysql_query($query);
                $row = mysql_fetch_assoc($result);

                while ($serv = mysql_fetch_array($result)) {
                    $aux = $aux + $serv['preco'];
                }
            }
            if ($result_insere)
                echo"<script>alert('Atendimento finalizado. Total a pagar $aux!!!')</script>";
            else
                echo"<script>alert('Nao consegui inserir!!!')</script>";
            //seu codigo para inserir no banco aqui... $value contem o valor do checkbox selecionado...
        }
        ?>




        <form action="amigao.php" method="post" name="amigao">

<?php include ('menu.php'); ?>

            <div id="body">
                <div id="content">

                    <div class="content">
                        <br><br><br>

                        <div class="container">

                            <!-------->
                            <div id="content">

                                <fieldset class="col-sm-7">
                                    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs" style="border-bottom: none;">
                                        <li  style="width: auto;" class="active"><a href="#buscar" data-toggle="tab">Buscar</a></li>
                                        <li style="width: auto;"><a href="#cadastrar" data-toggle="tab">Cadastrar</a></li>
                                        <li style="width: auto;"><a href="#atendimento" data-toggle="tab" style="display: <?php echo $btnExcluirEnable > 0 ? 'none' : ''; ?>;" class="">Atendimento</a></li>
                                    </ul>
                                    <div id="my-tab-content" class="tab-content">

                                        <!-- Buscar -->
                                        <div class="tab-pane active" id="buscar" style="width: 99%;">
                                            <div class="panel panel-default" style="width: 99%;">
                                                <div class="panel-body" style="width: 99%;">

                                                    <div class="col-lg-12">
                                                        <div class="input-group">
                                                            <input type="text" style="height: 46px;" class="form-control mac-style" name="pesquisaramigao" placeholder="Procurar por...">
                                                            <span class="input-group-btn"> 
                                                                <button  style="height: 46px;" class="btn btn-secondary" value="Buscar" name="botao" type="submit"><i class="glyphicon glyphicon-search" ></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <br><br><br>

                                                    <!-- Nome -->
                                                    <div class="form-group">
                                                        <label class="label label-warning">Nome:</label>
                                                        <input type="hidden" name="buscar_id" value="<?php print(@$_REQUEST['buscar_id']) ?>">

                                                        <div class="form-control" style="height: 34px; padding: 1%;" value="<?php print(@$_REQUEST['buscar_nome']) ?>">
                                                            &nbsp;&nbsp;<?php print(@$_REQUEST['buscar_nome']) ?> <br><br>
                                                        </div>
                                                        <!--<input type="text"  value="<?php // print(@$_REQUEST['buscar_nome'])                               ?>"  class="form-control" />;-->
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="label label-warning">Idade:</label>
                                                        <div class="form-control" style="height: 34px; padding: 1%;" >
                                                            &nbsp;&nbsp;<?php print(@$_REQUEST['buscar_idade']) ?> <br><br>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="label label-warning">Raça:</label>
                                                        <div class="form-control" style="height: 34px; padding: 1%;">
                                                            &nbsp;&nbsp;<?php print(@$_REQUEST['buscar_raca']) ?> <br><br>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="label label-warning">Sexo:</label>
                                                        <div class="form-control" style="height: 34px; padding: 1%;">
                                                            &nbsp;&nbsp;<?php print(@$_REQUEST['buscar_sexo']) ?> <br><br>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="label label-warning">Responsável:</label>
                                                        <div class="form-control" style="height: 34px; padding: 1%;" >
                                                            &nbsp;&nbsp;<?php print(@$_REQUEST['buscar_responsavel']) ?> <br><br>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="label label-warning">Observações:</label>
                                                        <div class="form-control" style="min-height:175px; height: auto; padding: 1%;" >
                                                            &nbsp;&nbsp;<?php print(@$_REQUEST['buscar_obs']) ?> <br><br>
                                                        </div>
                                                    </div>
                                                    <input type="submit" class="btn btn-danger" <?php echo $btnExcluirEnable > 0 ? 'disabled' : ''; ?> value="Excluir" name="botao">

                                                </div>
                                            </div>
                                            <br><br>
                                        </div>
                                        <!-- /Buscar -->

                                        <!-- Cadastrar -->
                                        <div class="tab-pane " id="cadastrar" style="width: 99%;">
                                            <div class="panel panel-default" style="width: 99%;">
                                                <!--<div class="panel-heading">Cadastrar Novo Amigão</div>-->
                                                <div class="panel-body" style="width: 99%;">

                                                    <!-- Nome -->
                                                    <div class="form-group">
                                                        <label class="label label-warning">Nome:</label>
                                                        <input type="text" name="nome_amigao"  class="form-control" />
                                                    </div>
                                                    <!-- /Nome -->

                                                    <!-- Idade -->
                                                    <div class="form-group">
                                                        <label class="label label-warning">Idade:</label>
                                                        <input type="number" min="0" max="99" name="idade_amigao"   class="form-control" />
                                                    </div>
                                                    <!-- /Idade --> 

                                                    <!-- Raca -->
                                                    <div class="form-group">
                                                        <label class="label label-warning">Raça:</label>
                                                        <input type="text" name="raca_amigao"  class="form-control" />
                                                    </div>
                                                    <!-- /Raca -->


                                                    <!-- Sexo -->
                                                    <div class="form-group">
                                                        <label class="label label-warning">Sexo:</label>
                                                        <select name="sexo_amigao" class="form-control">
                                                            <option ></option>
                                                            <option value="1">Macho</option>
                                                            <option value="2">Fêmea</option>
                                                        </select>
                                                    </div>
                                                    <!-- /Sexo -->

                                                    <div class="form-group">
                                                        <label class="label label-warning">Responsável:</label>
                                                        <select name="id_responsavel_amigao" class="form-control">
                                                            <option></option>
<?php while ($prod = mysql_fetch_array($responsa)) { ?>
                                                                <option value="<?php echo $prod['id'] ?>"><?php echo $prod['nome_responsavel'] ?> </option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>

                                                    <!-- Obs -->
                                                    <div class="form-group">
                                                        <label class="label label-warning">Observações:</label>
                                                        <textarea name="obs_amigao" maxlength="4000" rows="8"class="form-control"></textarea>
                                                    </div>
                                                    <!-- /obs -->

                                                    <input type="submit" class="btn btn-default" value="Gravar" name="botao">

                                                </div>
                                            </div>
                                            <br><br>
                                        </div>
                                        <!-- /Cadastrar -->

                                        <!-- atendimento -->
                                        <div class="tab-pane" id="atendimento" style="width: 99%;">
                                            <div class="panel panel-default" style="width: 99%;">
                                                <div class="panel-body" style="width: 99%;">
                                                    <!-- Nome -->
                                                    <div class="form-group">
                                                        <label class="label label-warning">Nome:</label>
                                                        <input type="hidden" name="buscar_id" value="<?php print(@$_REQUEST['buscar_id']) ?>">

                                                        <div class="form-control" style="height: 34px; padding: 1%;" value="<?php print(@$_REQUEST['buscar_nome']) ?>">
                                                            &nbsp;&nbsp;<?php print(@$_REQUEST['buscar_nome']) ?> <br><br>
                                                        </div>
                                                        <!--<input type="text"  value="<?php // print(@$_REQUEST['buscar_nome'])                               ?>"  class="form-control" />;-->
                                                    </div>



                                                    <div class="form-group" >
                                                        <label>Serviços:</label>
                                                        <div class="form-group" style="float:none;">
<?php while ($serv = mysql_fetch_array($servicosArraay)) { ?>
                                                                <p>
                                                                <div class="form-control" style="width:80%; float:left;">
                                                                    <span style=" width:90%; float:left;">
                                                                        <input type="checkbox" value="<?php echo $serv['id'] ?>" name="servico[]"/>
                                                                        <label for="<?php echo trim($serv['descricao']) ?>"><?php echo $serv['descricao'] ?></label>
                                                                        <label style="float: right;" for="<?php echo trim($serv['descricao']) ?>">R$ <?php echo $serv['preco'] ?></label>
                                                                    </span>
                                                                </div>
                                                                </p>
                                                                <br><br>
<?php } ?>
                                                        </div>
                                                    </div>

                                                    <input type="submit" class="btn btn-default" <?php echo $btnExcluirEnable > 0 ? 'disabled' : ''; ?> value="Finalizar" name="botao">

                                                </div>
                                            </div>
                                            <br><br>
                                        </div>
                                    </div>
                                </fieldset>

                            </div>
                        </div> <!-- container -->
                    </div>
                    <div id="sidebar"> <a href="responsavel.php"><img src="images/cliente.jpg" width="300" height="790" alt=""></a> </div>
                </div>
                <div style="background-color: #FF9800;" class="featured"></div>
            </div>
        </form>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('#tabs').tab();
            });
        </script>   
    </body>
</html>