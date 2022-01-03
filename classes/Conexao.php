<?php

    class Conexao{
        private $host;
        private $dbname;
        private $user;
        private $senha;
        
        function __construct(){
            $this->host = "localhost";
            $this->dbname = "dbrtchat";
            $this->user = "root";
            $this->senha = "";
        }

        function conectar(){
            try{
                $c = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->user, $this->senha);
                $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e){
                $c = $e->getMessage();
            }
            return $c;
        }
    }

?>