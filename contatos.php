<?php

session_start();

// Verifica se o id do usuário está definido na sessão
if (isset($_SESSION['id'])) {
    $servername = "localhost";
    $username = "u216342583_recitech";
    $password = "Recitech123!";
    $dbname = "u216342583_recitechbd";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Verifica se a conexão foi estabelecida com sucesso
    if (!$conn) {
      die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Guarda o id do usuário na sessão
    $usuario = $_SESSION['id'];

    // Seleciona os dados do usuário pelo id
    $sql = "SELECT nome, endereco, telefone, foto FROM cadastros WHERE id = $usuario";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Erro na consulta: " . $conn->error);
    }
    mysqli_close($conn);
} else {
    header("Location: login1.html");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReciTech - Contato</title>
    <link rel="icon" href="imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/style.css">
    <script type='text/javascript' src='//code.jquery.com/jquery-compat-git.js'></script>
    <script type='text/javascript' src='//igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>
    <script src="js/script.js" defer></script>
    <!-- PWA -->
    <link rel="manifest" href="manifest.webmanifest.json">
    <meta content='yes' name='apple-mobile-web-app-capable' />
    <meta content='yes' name='mobile-web-app-capable' />
    <meta name="apple-mobile-web-app-status-bar" content="#434d36">
    <meta name="theme-color" content="black">
    <link rel="apple-touch-icon" href="imagens/logo.png">
</head>
<body>
    <!-- Navbar (mantido para consistência, pode ser removido se não for necessário) -->
    <nav>
        <a href="index.php">Início</a>
        <a href="perfil.php">Perfil</a>
        <div class="dropdown">
            <a href="#">Informativos</a>
            <div class="dropdown-content">
                <a href="reciclagem.php">Reciclagem</a>
                <a href="reaproveitamento.php">Reaproveitamento</a>
            </div>
        </div>
        <a href="pontosdecoleta.php">Pontos de Coleta</a>
        <a href="contatos.html">Contatos</a>
    </nav>
    
    <!-- Botão hamburguer (mobile) -->
    <div class="hamburguer" onclick="toggleMenu()">
        <img src="imagens/hamburguer.svg" alt="Ícone Hambúrguer">
        <p class="nome-pagina">CONTATOS</p>
    </div>
    
    <!-- Menu hamburguer (mobile) -->
    <div class="menu-mobile">
        <a href="index.php">INICIO</a>
        <a href="perfil.php">PERFIL</a>
        <div class="submenu" onclick="toggleSubmenu()">
            <a href="#">INFORMATIVOS</a>
            <ul>
                <li><a href="reciclagem.php">RECICLAGEM</a></li>
                <li><a href="reaproveitamento.php">REAPROVEITAMENTO</a></li>
            </ul>
        </div>
        <a href="pontosdecoleta.php">PONTOS DE COLETA</a>
        <a href="contatos.html">CONTATOS</a>
    </div>
    
    <!-- Conteúdo da página -->
    <div class="containercontatos">
        <!-- Card 1: Email -->
        <div class="cardcontatos" onclick="window.location.href='mailto:contato@recitech.com'">
            <img class="imagecontatos" src="imagens/email.svg" alt="Imagem1">
            <h3>Email</h3>
            <p>contato@recitechrn.com</p>
        </div>
        
        <!-- Card 2: Telefone -->
        <div class="cardcontatos" onclick="window.location.href='tel:+55123456789'">
            <img class="imagecontatos" src="imagens/telefone.svg" alt="Imagem1">
            <h3>Telefone</h3>
            <p>(12) 3456-7890</p>
        </div>
        
        <!-- Card 3: Facebook -->
        <div class="cardcontatos" onclick="window.open('https://www.facebook.com/ReciTech', '_blank')">
            <img class="imagecontatos" src="imagens/facebook.svg" alt="Imagem1">
            <h3>Facebook</h3>
            <p>facebook.com/recitechrn</p>
        </div>
        
        <!-- Card 4: Instagram -->
        <div class="cardcontatos" onclick="window.open('https://www.instagram.com/ReciTech', '_blank')">
            <img class="imagecontatos" src="imagens/instagram.svg" alt="Imagem1">
            <h3>Instagram</h3>
            <p>@recitechrn</p>
        </div>
        
        <!-- Card 5: Twitter -->
        <div class="cardcontatos" onclick="window.open('https://twitter.com/ReciTech', '_blank')">
            <img class="imagecontatos" src="imagens/twitter.svg" alt="Imagem1">
            <h3>Twitter</h3>
            <p>@recitechrn</p>
        </div>
    </div>
</body>
</html>