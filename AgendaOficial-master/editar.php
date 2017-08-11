<?php
    $contatos = [];

    foreach ($meusContatos as $cont){
        if ($cont['id'] == $_GET['id']){
            $contatos = $cont;
            break;
        }
    }
?>

<button type="button" class="btn btn-default " id="pop-up" data-toggle="modal" data-target="#modal"></button>

<div class="modal fade bs-example-modal-md" id="modal"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"> <!--role="dialog">-->
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <a type="button" class="close" href="index.php">&times;</a>
                    <h4 class="modal-title">Editar</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-inline" action="contralador_agenda.php?acao=editar1&id=<?= $_GET['id']?>" method="post">

                                <!--nome-->
                                <div class="form-group col-md-12" style="text-align: center">
                                    <label for="nome">Nome</label> <br>
                                    <input type="text" class="form-control" id="nome" name="nome" value="<?= $contatos['nome'] ?>">
                                </div>
                                <br>
                                <!--email-->
                                <div class="form-group col-md-12" style="text-align: center">
                                    <label for="email">Email</label> <br>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $contatos['email'] ?>">
                                </div>
                                <br>
                                <!--telefone-->
                                <div class="form-group col-md-12" style="text-align: center">
                                    <label for="telefone">Telefone</label> <br>
                                    <input type="text" class="form-control" id="telefone" name="telefone" value="<?= $contatos['telefone'] ?>">
                                </div>
                                <br>
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary form-group" style="float: right">EDITAR</button>
                                </div>
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