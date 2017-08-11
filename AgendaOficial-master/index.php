<?php
    //verificar se esta logado
    if(!isset($_SESSION)){
        session_start();
    }

    $existe = isset($_SESSION['esta_logado']);

    $contatos = [];

    if ($existe == false && $_SESSION['esta_logado'] == false){
        //redirecionar
        header("Location: login.php");
    }

    require 'contralador_agenda.php';

    $meusContatos = pegarcontatos($_SESSION['login']);

    if (!isset($_GET['acao'])){
        $_GET['acao'] = null;
    } else {
        switch ($_GET['acao']){
            case 'editar':
                include 'editar.php';
                break;

            case 'buscar':
                $meusContatos = $contatos;
                break;
        }
    }

    if (!isset($_POST['busca'])){
        $_POST['busca'] = null;
    };

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="application/javascript">
        $( "#pop-up" ).on( "click");
        $( "#pop-up" ).trigger( "click" );
    </script>
</head>
<body style="background-color: #f0f0f0">

    <div class="container" style="margin-top: 30px; margin-bottom: 30px; border-radius: 10px; background-color: #ffffff">

        <a href="contralador_agenda.php?acao=logout" class="btn btn-danger" style="border-radius: 50%;float: right; margin: 10px">X</a>

        <h3 style="text-align: center"><img src="https://image.freepik.com/icones-gratis/agenda_318-97721.jpg" width="25px"> Agenda de contatos <?= $_SESSION['nome'] ?></h3>
        <br/>

        <!-- CADASTRO-->
        <div class="row">
            <div class="col-md-12">
                <form class="form-inline" action="contralador_agenda.php?acao=cadastrarContatos" method="post">

                    <!--nome-->
                    <div class="form-group col-md-3">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome">
                    </div>

                    <!--email-->
                    <div class="form-group col-md-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>

                    <!--telefone-->
                    <div class="form-group col-md-4">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone">
                    </div>

                    <div class="form-group col-md-1">
                        <button type="submit" class="btn btn-primary form-group" style="">CADASTRAR</button>
                    </div>
                </form>
            </div>
        </div>

        <br>

        <!-- BUSCA-->
        <div class="row">
            <div class="col-md-12">
                <form class="form-inline" action="index.php?acao=buscar" method="post">

                    <!--nome-->
                    <div class="form-group col-md-3">
                        <label for="nome">Busca</label>
                        <input type="text" class="form-control" id="busca" name="busca" value="<?= $_POST['busca'] ?>">
                    </div>

                    <div class="form-group col-md-1">
                        <button type="submit" class="btn btn-info form-group" style="float: right">BUSCAR</button>
                    </div>

                    <?php if ($_GET['acao'] == 'buscar'): ?>
                        <div class="form-group col-md-1">
                            <a type="button" class="btn btn-success form-group" style="float: right" href="index.php">LIMPAR</a>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <br />

        <!--CONTATOS-->
        <div class="row">
            <div class="col-md-12">

                <!-- Conteúdo -->
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($meusContatos as $cont): ?>
                        <tr>
                            <th scope="row"><?= $cont['id']       ?></th>
                            <td>            <?= $cont['nome']     ?></td>
                            <td>            <?= $cont['email']    ?></td>
                            <td>            <?= $cont['telefone'] ?></td>
                            <td><a type="button" class="btn btn-warning" href="index.php?acao=editar&id=<?= $cont['id'] ?>">X</a></td>
                            <td><a type="button" class="btn btn-danger" href="contralador_agenda.php?acao=exclui&id=<?= $cont['id'] ?>" >X</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>