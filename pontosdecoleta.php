<?php

session_start();

// Verifica se o id do usuário está definido na sessão
if (isset($_SESSION['id'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "recitech";
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

    if ($result->num_rows > 0) {
        // Recupera os dados do usuário e define as variáveis
        $row = $result->fetch_assoc();
        $nome = $row["nome"];
        $endereco = $row["endereco"];
        $telefone = $row["telefone"];
        $foto = $row["foto"];

    } else {
        // Se não houver dados, definir as variáveis como vazias
        $nome = "";
        $endereco = "";
        $telefone = "";
        $foto = "";

        echo "Nenhum resultado encontrado para o ID de usuário: $usuario";
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
    <title>ReciTech</title>
    <link rel="icon" href="imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <script type='text/javascript' src='//code.jquery.com/jquery-compat-git.js'></script>
    <script type='text/javascript' src='//igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>
    <script src="js/script.js" defer></script>
    <!-- <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> -->
    <!-- PWA -->
    <link rel="manifest" href="manifest.webmanifest.json">
    <meta content='yes' name='apple-mobile-web-app-capable' />
    <meta content='yes' name='mobile-web-app-capable' />
    <meta name="apple-mobile-web-app-status-bar" content="#5076D9">
    <meta name="theme-color" content="black">
    <link rel="apple-touch-icon" href="imagens/logo.png">
    <style>
      
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
      <a href="index.php">Início</a>
      <a href="perfil.php">Perfil</a>
      <div class="dropdown">
        <a href="#">Informativos</a>
        <div class="dropdown-content">
          <a href="reciclagem.html">Reciclagem</a>
          <a href="#">Reaproveitamento</a>
        </div>
      </div>
      <a href="pontosdecoleta.php">Pontos de Coleta</a>
    </nav>
    
      <!-- Botão hamburguer (mobile) -->
      <div class="hamburguer" onclick="toggleMenu()">
        <img src="imagens/hamburguer1.png" alt="Ícone Hambúrguer">
        <p class="nome-pagina">PONTOS DE COLETA</p>
      </div>
    
      <!-- Menu hamburguer (mobile) -->
      <div class="menu-mobile">
        <a href="index.php">INICIO</a>
        <a href="perfil.php">PERFIL</a>
        
        <div class="submenu" onclick="toggleSubmenu()">
          <a href="#">INFORMATIVOS</a>
          <ul>
            <li><a href="reciclagem.html">Reciclagem</a></li>
            <li><a href="#">Reaproveitamento</a></li>
          </ul>
        </div>
        <a href="pontosdecoleta.php">PONTOS DE COLETA</a>
      </div>
    
      <!-- Conteúdo da página -->
      <div>
        <div id="map" class="mapa"></div>
      </div>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCMUTkMxcHAkTyEs642O1akDJZiA6H5ro&callback=initMap" async defer></script>
      <script src="js/map.js"></script>
</body>
</html>
