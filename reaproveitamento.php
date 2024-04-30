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
        if (empty($foto)){
          $foto = "./imagens/perfilembranco.svg";
        }

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
    </nav>
    
      <!-- Botão hamburguer (mobile) -->
      <div class="hamburguer" onclick="toggleMenu()">
        <img src="imagens/hamburguer.svg" alt="Ícone Hambúrguer" >
        <p class="nome-pagina">REAPROVEITAMENTO</p>
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
      </div>
    
      <!-- Conteúdo da página -->
      <div class="conteudo1">
        <div class="container">
          <img src="imagens/recycle_sign.png" alt="reciclagem" class="img">
          <p class="texto"><h3>O que é reciclagem?</h3><br>
            A reciclagem é o processo de reaproveitamento de materiais descartados. Seu objetivo é reintroduzi-los na cadeia  produtiva a fim de que ainda gerem valor e sejam reutilizados, aumentando a preservação dos recursos naturais e  melhorando a qualidade de vida das pessoas.
          </p>
        </div>
        <div class="container">
          <img src="imagens/reciclagem_eletronica.jpeg" alt="reciclagem" class="img">
          <p class="texto"><h3>A reciclagem de eletrônicos</h3><br>
            A reciclagem de lixo eletrônico é um processo altamente viável para evitar que esses artigos gerem danos ao meio ambiente e ao solo depois de um descarte irregular em qualquer que seja o local. Quando descartado de maneira incorreta, esses materiais podem causar danos à saúde das pessoas, de animais, entre diversas outras consequências negativas, por isso, a reciclagem de lixo eletrônico se faz cada vez mais necessária conforme os avanços tecnológicos. 
          </p>
          </div>
      </div>
    
      <script src="js/script.js"></script>
</body>
</html>
