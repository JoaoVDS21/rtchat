<?php

    require_once "../../classes/Conexao.php";
    session_start();
    $retorno = array();

    if(isset($_POST['filtro'])){
        $filtro = $_POST['filtro'];

        $con = new Conexao();
        $con = $con->conectar();
        $sql = "SELECT idunico, nome, email, img, status FROM usuario WHERE nome LIKE :filtro AND NOT idunico = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':filtro', $filtro);
        $stmt->bindParam(':id', $_SESSION['idusuario']);
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($dados) > 0){ 
            $retorno['status'] = 1;
            $retorno['dados'] = $dados;
        } else {
            $retorno['status'] = 0;
        }
    
    }

    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);

?>