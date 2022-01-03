<?php

session_start();
require_once "classes/Conexao.php";
$con = new Conexao();

if(isset($_SESSION['idusuario'])){
    $sql = "UPDATE usuario SET status = 'Offline' WHERE idunico = :id";
    $stmt = $con->conectar()->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['idusuario']);
    $stmt->execute();
    session_destroy();
    header('Location: index.php');
}


?>