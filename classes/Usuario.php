<?php

require_once "Conexao.php";
class Usuario{

    private $idusuario;
    private $idunico;
    private $nome;
    private $email;
    private $senha;
    private $img;
    private $status;
    private $con;

    function __construct()
    {
        $this->idusuario = 0;
        $this->idunico = 0;
        $this->nome = "";
        $this->img = "";
        $this->status = "";
        $this->con = new Conexao();
    }

    public function setIdusuario($idusuario){
        $this->idusuario = $idusuario;
    } 

    public function getIdusuario(){
        return $this->idusuario;
    }

    public function setIdunico($idunico){
        $this->idunico = $idunico;
    } 

    public function getIdunico(){
        return $this->idunico;
    }

    public function setNome($nome){
        $this->nome = $nome;
    } 

    public function getNome(){
        return $this->nome;
    }

    public function setEmail($email){
        $this->email = $email;
    } 

    public function getEmail(){
        return $this->email;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    } 

    public function getSenha(){
        return $this->senha;
    }

    public function setImg($img){
        $this->img = $img;
    } 

    public function getImg(){
        return $this->img;
    }

    public function setStatus($status){
        $this->status = $status;
    } 

    public function getStatus(){
        return $this->status;
    }

    public function cadastrar(){
        try{
            $sql = "INSERT INTO usuario VALUES(0, :idu, :n, :e, :s, :i, :st)";
            $stmt = $this->con->conectar()->prepare($sql);
            $stmt->bindParam(':idu', $this->idunico);
            $stmt->bindParam(':n', $this->nome);
            $stmt->bindParam(':e', $this->email);
            $stmt->bindParam(':s', $this->senha);
            $stmt->bindParam(':i', $this->img);
            $stmt->bindParam(':st', $this->status);
            $stmt->execute();
            return true;
        } catch (PDOException $e){
            return false;
        }
        
    }

    public function logar(){
        $sql = "SELECT idunico, COUNT(*) 'qtd' FROM usuario WHERE email = :e";
        $stmt = $this->con->conectar()->prepare($sql);
        $stmt->bindParam(':e', $this->email);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($data['qtd'] == 1){
            $_SESSION['idusuario'] = $data['idunico'];
            return true;
        } else {
            return false;
        }
    }

    public function verificaEmail(){
        $sql = "SELECT email, COUNT(*) 'qtd' FROM usuario WHERE email = :e";
        $stmt = $this->con->conectar()->prepare($sql);
        $stmt->bindParam(':e', $this->email);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($data['qtd'] == 0){
            return true;
        } else {
            return false;
        }
    }

}

?>