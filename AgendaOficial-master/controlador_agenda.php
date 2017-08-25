<?php

    if(!isset($_SESSION)){                                                                          //Verifica se existe a session
        session_start();                                                                            //Se não existir start ela
    }

    if (!isset($_GET['acao'])){                                                                     //Verifica se existe o get 'acao'
        $_GET['acao'] = null;                                                                       //Se não existir a o get 'acao' atribui null para ele
    }

    function pegarJson(string $arquivo){
        return json_decode(file_get_contents("data_bases/$arquivo"), true);                         //Pega os valores em um arquivo json e transforma em json
}                                                        //Fim da função

    function salvarJson(string $arquivo, array $array){
        $contatoJson = json_encode($array, JSON_PRETTY_PRINT);                                      //Transforma um array em um tipo json

        file_put_contents("data_bases/$arquivo", $contatoJson);                                     //Armazena o json em um arquivo
    }                                         //Fim da função

    function login(string $login, string $senha){
        $lista_usuarios = pegarJson('users.json');                                                  //Pega os arquivos do 'users.json' e transforma em um array

        foreach ($lista_usuarios as $user){                                                         //Percorre os contatos

            if($login == $user['login'] and $senha == $user['senha']){                              //Verifica se o Usuario e a senha são iguais a posição do array pecorrido

                $_SESSION['login']       = $user['login'];                                          //Armazena em uma SESSION o login do usuario
                $_SESSION['nome']        = $user['nome'];                                           //Armazena em uma SESSION o nome do usuario
                $_SESSION['esta_logado'] = true;                                                    //Armazena em uma SESSION a verificação do login

                header("Location: index.php");                                                      //Direciona para o index

            }
        }

        if (!$_SESSION['esta_logado']) {                                                            //Verifica se o login esta logado
            //redirecionar
            $_SESSION['login'] = $login;                                                            //Armazena em uma SESSION o usuario inserido no form
            header("Location: login.php");                                                          //Redireciona para o login
        }
    }                                               //Fim da função

    function logout(){
        session_destroy();                                                                          //Destroy a SESSION fazendo com que a verificação do usuario se torne falsa

        header("Location: login.php");                                                              //Redireciona pra login.php
    }                                                                          //Fim da função

    function cadastrarUser(string $nome, string $login, string $senha){
        $lista_usuarios = pegarJson('users.json');                                                  //Puxa os arquivos json e transforma em array

        $lista_usuarios[] = array(                                                                  //Na proxima posição vazia armazena um array com
            'nome'     => $nome,                                                                    //Um nome,
            'login'    => $login,                                                                   //Um login,
            'senha'    => $senha                                                                    //E uma senha
        );

        $_SESSION['login'] = $login;                                                                //Armazena em uma SESSION o login

        salvarJson('users.json', $lista_usuarios);                                                  //Salva o novo login no arquivo json 'users.json'

        header("Location: login.php");                                                              //Redireciona para a pagina login.php
    }                         //Fim da função

    function cadastrarContatos (string $user, string $nome, string $email, string $telefone){

        $contatos = pegarJson('contatos.json');                                                     //Puxa os arquivos json e transforma em array

        $contatos[] = [                                                                             //Na proxima posição vazia armazena um array com
            'nome'     => $nome,                                                                    //Um nome,
            'email'    => $email,                                                                   //Um email,
            'telefone' => $telefone,                                                                //Um telefone,
            'id'       => uniqid(),                                                                 //Uma id,
            'user'     => $user                                                                     //E o login atual
        ];

        salvarJson('contatos.json', $contatos);                                                     //Salva o novo login no arquivo json 'users.json'

        header("Location: index.php");                                                              //Redireciona para a pagina index.php

    }   //Fim da função

    function exclui (string $id){
        $contatos = pegarJson('contatos.json');                                                     //Puxa os arquivos json e transforma em array

        $contatosExclui = [];                                                                       //A variavel recebe um array vazio

        foreach ($contatos as $cont){                                                               //Percorre o array de contatos
            if ($cont['id'] != $id){                                                                //Se o id for diferente ao id pasado como parametro
                $contatosExclui[] = $cont;                                                          //Você armazena apenas os contatos diferentes do id
            }                                                                                       //Ou seja você não vai armazenar o contato com id passado assim é como se você removesse
        }

        salvarJson('contatos.json', $contatosExclui);                                               //Salva o novo login no arquivo json 'users.json'

        header("Location: index.php");                                                              //Redireciona para a pagina index.php
    }                                                               //Fim da função

    function editar (string $id, string $user, string $nome, string $email, string $telefone){

        $contatos = pegarJson('contatos.json');                                                     //Puxa os arquivos json e transforma em array

        $contatosEditar = [];                                                                       //A variavel recebe um array vazio

        foreach ($contatos as $cont){                                                               //Percorre o array de contatos

            if ($cont['id'] != $id){                                                                //Se o id for diferente ao id pasado como parametro

                $contatosEditar[] = $cont;                                                          //Você armazena apenas os contatos diferentes do id

            } else {

                $contatosEditar[] = array(                                                          //Na proxima posição vazia armazena um array com
                    'nome'     => $nome,                                                            //Um nome,
                    'email'    => $email,                                                           //Um email,
                    'telefone' => $telefone,                                                        //Um telefone,
                    'id'       => $id,                                                              //Uma id,
                    'user'     => $user                                                             //E o login atual
                );
            }
        }

        salvarJson('contatos.json', $contatosEditar);                                               //Salva o novo login no arquivo json 'users.json'

        header("Location: index.php");                                                              //Redireciona para a pagina index.php

    }  //Fim da função

    function buscar (string $user, string $busca){
        $meusContatos = pegarcontatos($user);

        $contatos = [];

        $countBusca = strlen($busca);

        foreach ($meusContatos as $contato) {
            $countContato = strlen($contato["nome"]);
            $j = $countContato;
            $verificaId = true;

            for ($i = $countBusca; $i >= 1; $i--){

                $cont = str_split($contato["nome"], $j)[0];
                $letra = str_split($busca, $i)[0];

                if (strtolower(str_replace(" ", "", $letra)) == strtolower(str_replace(" ", "", $cont))){

                    foreach ($contatos as $contatosBuscados){

                        if ($contatosBuscados["id"] == $contato["id"]){
                            $verificaId = false;
                            break;
                        }
                    }
                    if ($verificaId){
                        $contatos[] = $contato;
                        break;
                    }

                }

                if ($countBusca >= $countContato){
                    if ($i <= $j and $j >= 1){
                        $j--;
                    }
                } elseif ($countBusca < $countContato and $i < $j){
                    $i = $countBusca;
                    $j--;
                }
            }
        }

        return $contatos;
    }                                              //Fim da função

    function pegarcontatos($user){
        $contatos = pegarJson('contatos.json');
        $contatosUser = [];

        foreach ($contatos as $contato){
            if ($contato['user'] == $user){
                $contatosUser[] = $contato;
            }
        }

        return $contatosUser;
    }                                                              //Fim da função


    /* --- Rotas dos arquivos --- */

    switch ($_GET['acao']){
        case 'login':
            login($_POST['login'], $_POST['senha']);
            break;

        case 'logout':
            logout();
            break;

        case 'cadastrarContatos':
            cadastrarContatos($_SESSION['login'], $_POST['nome'], $_POST['email'], $_POST['telefone']);
            break;

        case 'cadastraUser':
            cadastrarUser($_POST['nome'], $_POST['login'], $_POST['senha']);
            break;

        case 'editar1':
            editar($_GET['id'], $_SESSION['login'], $_POST['nome'], $_POST['email'], $_POST['telefone']);
            break;

        case 'exclui':
            exclui($_GET['id']);
            break;

        case 'buscar':
            $contatos = buscar($_SESSION['login'],$_POST['busca']);
            break;

    }                                                                     //Fim das rotas
