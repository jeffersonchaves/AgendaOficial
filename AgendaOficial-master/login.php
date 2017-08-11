<?php
    session_start();
     if (!isset($_SESSION['login'])){
         $_SESSION['login'] = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #f0f0f0">
	
	<div class="container" style="margin: 30px auto;border-radius: 10px; background-color: #ffffff; padding: 50px; width: 1000px">
        <!-- LOGIN-->
        <form class="form-horizontal" action="contralador_agenda.php?acao=login" method="post">
            <fieldset>

                <!-- Form Name -->
                <legend>Login</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="login">Login</label>
                    <div class="col-md-4">
                        <input id="login" name="login" type="text"class="form-control input-md" value="<?= $_SESSION['login']; ?>">

                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="senha">Senha</label>
                    <div class="col-md-4">
                        <input id="senha" name="senha" type="password" class="form-control input-md">

                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="login"></label>
                    <div class="col-md-8">
                        <button type="submit" id="loginButton" name="loginButton" class="btn btn-primary">LOGIN</button>
                        <button id="cadastro" name="cadastro" class="btn btn-warning" id="pop-up" data-toggle="modal" data-target="#myModal" type="button">CADASTRAR</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>


    <div class="modal fade bs-example-modal-md" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"> <!--role="dialog">-->
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <a type="button" class="close" href="index.php">&times;</a>
                    <h4 class="modal-title">Cadastrar</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" action="contralador_agenda.php?acao=cadastraUser" method="post">
                                <fieldset>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="nome">Nome</label>
                                        <div class="col-md-4">
                                            <input id="nome" name="nome" type="text"class="form-control input-md">

                                        </div>
                                    </div>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="login">Login</label>
                                        <div class="col-md-4">
                                            <input id="login" name="login" type="text"class="form-control input-md">

                                        </div>
                                    </div>

                                    <!-- Password input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="senha">Senha</label>
                                        <div class="col-md-4">
                                            <input id="senha" name="senha" type="password"class="form-control input-md">

                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="cadastrar"></label>
                                        <div class="col-md-4">
                                            <button id="cadastrar" name="cadastrar" class="btn btn-warning">CADASTRAR</button>
                                        </div>
                                    </div>

                                </fieldset>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" href="index.php">Close</a>
                </div>
            </div>
        </div>
    </div>
	
</body>
</html>