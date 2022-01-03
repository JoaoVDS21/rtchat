<?php

    require_once "../../classes/Usuario.php";
    require_once "../../classes/Conexao.php";
    $retorno = array();
    session_start();

    if(isset($_POST['cnome'], $_POST['cemail'], $_POST['csenha'])){
        extract($_POST);
        $u = new Usuario();
        $u->setNome($cnome);
        $u->setEmail($cemail);
        $u->setSenha($csenha);
        if(strlen($cnome) > 3){
            if(filter_var($cemail, FILTER_VALIDATE_EMAIL)){
                if($u->verificaEmail()){
                    if(isset($_FILES['imgFile'])){
                        $imgName = $_FILES['imgFile']['name'];
                        $tmpName = $_FILES['imgFile']['tmp_name'];

                        $imgExplode = explode('.', $imgName);
                        $imgExt = end($imgExplode);

                        $extensions = ['png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG'];

                        if(in_array($imgExt, $extensions) === true){
                            $time = time();
                            $newImagename = $time.$imgName;

                            if(move_uploaded_file($tmpName, "../../img/users/".$newImagename)){
                                $status = "Online";
                                $randomId = rand(time(), 10000000);
                                $u->setIdunico($randomId);
                                $u->setImg($newImagename);
                                $u->setStatus($status);
                                if($u->cadastrar()){
                                    $u->logar();
                                    $retorno['status'] = 1;
                                    $retorno['mensagem'] = "sucesso";
                                } else {
                                    $retorno['status'] = 0;
                                    $retorno['mensagem'] = "Erro ao cadastrar usuário";
                                }              
                            } else {
                                $retorno['status'] = 0;
                                $retorno['mensagem'] = "Erro ao fazer upload de imagem!";
                            }
                        } else {
                            $retorno['status'] = 0;
                            $retorno['mensagem'] = "Selecione uma imagem em .png .jpg ou .jpeg!";
                        }
                    } else {
                        $retorno['status'] = 0;
                        $retorno['mensagem'] = "Selecione uma imagem!";
                    }
                } else {
                    $retorno['status'] = 0;
                    $retorno['mensagem'] = "Este e-mail já existe!";
                }
            } else {
                $retorno['status'] = 0;
                $retorno['mensagem'] = "Digite um email válido!";
            }
        } else {
            $retorno['status'] = 0;
            $retorno['mensagem'] = "Digite um nome com pelo menos 4 caractéres";
        }
    } else {
        $retorno['status'] = 0;
        $retorno['mensagem'] = "Há algum campo inválido";
    }

;
    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
?>