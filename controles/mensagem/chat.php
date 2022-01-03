<?php

    require_once "../../classes/Conexao.php";
    session_start();
    $retorno = array();
    $con = new Conexao();
    
    if(isset($_POST['msg_para_id'], $_POST['mensagem'], $_POST['tipo'])){
        foreach($_POST as $key => $value){
            $$key = $value;
        }

        if($tipo == "cadastrar"){
            $sql = 'INSERT INTO mensagem VALUES(0, :msgdeid, :msgparaid, :m)';
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':msgdeid', $_SESSION['idusuario']);
            $stmt->bindParam(':msgparaid', $msg_para_id);
            $stmt->bindParam(':m', $mensagem);
            $stmt->execute();
        } else if($tipo == "listarMensagens"){
            $sql = 'SELECT * FROM mensagem WHERE (msg_de_id = :msgdeid OR msg_de_id = :msgparaid) AND (msg_para_id = :msgdeid OR msg_para_id = :msgparaid) ORDER BY idmensagem';
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':msgdeid', $_SESSION['idusuario']);
            $stmt->bindParam(':msgparaid', $msg_para_id);
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $con = $con->conectar();
            $sql = "SELECT idunico, nome, email, img, status FROM usuario WHERE idunico = :msgparaid";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':msgparaid', $msg_para_id);
            $stmt->execute();
            $dados1 = $stmt->fetch(PDO::FETCH_ASSOC);

            $retorno['usuarioAtual'] = $_SESSION['idusuario'];
            $retorno['mensagens'] = $dados;
            $retorno['msg_para'] = $dados1;
        }
    }

    echo json_encode($retorno, JSON_UNESCAPED_UNICODE)

?>