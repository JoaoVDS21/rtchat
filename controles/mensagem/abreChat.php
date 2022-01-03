<?php

    require_once "../../classes/Conexao.php";
    session_start();
    $retorno = array();

    if(isset($_POST['idcontato'])){
        $idcontato = $_POST['idcontato'];
        $con = new Conexao();

        $sql1 = "SELECT idunico, nome, status, img FROM usuario WHERE idunico = :id";
        $stmt = $con->conectar()->prepare($sql1);
        $stmt->bindParam(':id', $idcontato);
        $stmt->execute();
        $dadoContato = $stmt->fetch(PDO::FETCH_ASSOC);

        // Falta parte retornar as mensagens do chat

        $retorno['dadoContato'] = $dadoContato;
    }
    
    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
?>