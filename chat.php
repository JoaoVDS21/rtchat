<?php
    session_start();
    if(!isset($_SESSION['idusuario'])){
        session_destroy();
        header('Location: index.php');
    }

    require_once "classes/Conexao.php";

    $con = new Conexao();
    $sql = "SELECT * FROM usuario WHERE idunico = :id";
    $stmt = $con->conectar()->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['idusuario']);
    $stmt->execute();
    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/chat-style.css">
</head>
<body>
    <div class="loading">
        <div class="ball"></div>
    </div>
    <main class="container">
        <div class="box-all">
            <side class="side-main-users">
                <div class="profile">
                    <img loading="lazy" src="img/users/<?php echo $dados['img']?>" class="profile-photo"></img>
                    <div class="profile-info">
                        <h2><?php echo $dados['nome']?></h2>
                        <p><?php echo $dados['status']?></p>
                    </div>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
                <div class="search-bar-box">
                    <i class="fas fa-search"></i>
                    <input type="text" class="search-bar" id="search-bar" placeholder="Procurar amigos">
                </div>
                <div class="users-list" id="users-list">

                    <h3 id="not-contacts">Não há contatos para exibir</h3>
                              
                    <!-- Contato para exibir -->

                </div>
            </side>
            <main class="main-chat">
                <header class="header-user-chat" id="header-user-chat">

                    <!-- Insere isso via js -->

                    <img loading="lazy" src="img/users/perfil.jpg" class="img-user-chat">
                    <div class="info-user-chat">
                        <h2>Gabriela Rocha</h2>
                        <p>Online agora</p>
                    </div>
                    <div class="icons-function">
                        <input type="text" placeholder="Digite a mensagem...">
                        <i class="fas fa-search" id="search-msg"></i>
                    </div>

                </header>
                <main class="chat-user" id="chat-user">
                    
                </main>
                <form action="#" method="POST" enctype="multipart/form-data" id="form-msg">
                    <input type="text" name="mensagem" id="msgEnviar" placeholder="Digite sua mensagem aqui" required autocomplete="off">
                    <button type="submit" id="btnEnviar"><i class="fas fa-paper-plane"></i></button>
                </form>
            </main>
        </div>
    </main>

    <script src="js/ajax.js"></script>
    <script src="js/script-chat.js"></script>
</body>
</html>