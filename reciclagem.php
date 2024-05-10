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
    <title>ReciTech</title>
    <link rel="icon" href="imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
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
    <!-- Navbar -->
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
        <img src="imagens/hamburguer.svg" alt="Ícone Hambúrguer" >
        <p class="nome-pagina">RECICLAGEM</p>
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
      <div class="conteudo1">
        <div class="card">
          <table style="width: 100%">
            <td><img src="imagens/reciclagem.png" alt="reciclagem" class="img"></td>
            <td><p class="titulo-info">O que é reciclagem?</p><br>
            <p class="texto">A reciclagem é o processo de reaproveitamento de materiais descartados. Seu objetivo é reintroduzi-los na cadeia  produtiva a fim de que ainda gerem valor e sejam reutilizados, aumentando a preservação dos recursos naturais e  melhorando a qualidade de vida das pessoas.</p></td>
          </table>
        </div>
        <div class="card">
          <table style="width: 100%">
            <td><img src="imagens/lixo_eletronico.jpg" alt="reciclagem" class="img"></td>
            <td><p class="titulo-info">A reciclagem de eletrônicos</p><br>
            <p class="texto">A reciclagem de lixo eletrônico é um processo altamente viável para evitar que esses artigos gerem danos ao meio ambiente e ao solo depois de um descarte irregular em qualquer que seja o local. Quando descartado de maneira incorreta, esses materiais podem causar danos à saúde das pessoas, de animais, entre diversas outras consequências negativas, por isso, a reciclagem de lixo eletrônico se faz cada vez mais necessária conforme os avanços tecnológicos.</p></td>
          </table>
        </div>
      <script src="js/script.js"></script>
</body>
</html>
