<?php

    require_once "../../classes/Usuario.php";
    $retorno = array();
    session_start();

    if(isset($_POST['email'], $_POST['senha'])){
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        $u = new Usuario();
        $u->setEmail($email);
        $u->setSenha($senha);
        if($u->logar()){
            $retorno['status'] = 1;
            $retorno['mensagem'] = "sucesso";
        } else {
            $retorno['status'] = 0;
            $retorno['mensagem'] = "Email ou senha inválidos";
        }
    } else {
        $retorno['status'] = 0;
        $retorno['mensagem'] = "Campos inválidos!";
    }

    echo json_encode($retorno, JSON_UNESCAPED_UNICODE); 

?>