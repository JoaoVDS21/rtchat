<?php
session_start();
if(isset($_SESSION['idusuario'])){
    header('Location: chat.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTChat - VDS Corporation</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container" id="container">
        <div class="box-form" id="login">
            <h1>Bem vindo</h1>
            <h2>RTChat - feito por Joao V.D.S.</h2>
            <h3>- Login -</h3>
            <form action="#" method="POST" class="form-control" id="form-login" enctype="multipart/form-data">
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="text" name="email" id="email" placeholder="Email" required >
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="senha" id="senha" placeholder="Senha" required >
                    <i class="fas fa-eye pswd"></i> <!-- fas fa-eye-slash -->
                </div>
                <button type="submit" id="btnEntrar">Entrar</button>
            </form>
            <p>Não tem conta? <a href="#" id="alterFormCad">Crie uma <i class="fas fa-arrow-right"></i></a></p>
        </div>
        <div class="box-form" id="cadastro">
            <h1>Bem vindo</h1>
            <h2>RTChat - feito por Joao V.D.S.</h2>
            <h3>- Cadastro -</h3>
            <form action="#" method="POST" class="form-control" id="form-cadastro" enctype="multipart/form-data">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="cnome" id="cnome" placeholder="Nome de usuário" required >
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="text" name="cemail" id="cemail" placeholder="Email" required >
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="csenha" id="csenha" placeholder="Senha" required >
                    <i class="fas fa-eye cpswd"></i> <!-- fas fa-eye-slash -->
                </div>
                <div class="input-group">
                    <input type="file" name="imgFile" id="cimg" >
                </div>
                <button type="submit" id="btnCadastrar">Cadastrar</button>
            </form>
            <p>Já tem conta? <a href="#" id="alterFormLogin">Entre agora <i class="fas fa-arrow-right"></i></a></p>
        </div>
    </div>

    <script src="js/script.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/logar.js"></script>
</body>
</html>