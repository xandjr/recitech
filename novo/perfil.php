<?php

session_start();

// Verificar se o ID do usuário está definido na sessão
if (isset($_SESSION['id'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "recitech";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
 // Verificar se a conexão foi estabelecida com sucesso
    if (!$conn) {
      die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $usuario = $_SESSION['id'];

    $sql = "SELECT nome, endereco, telefone, foto FROM cadastros WHERE id = $usuario";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Erro na consulta: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        // Recuperar os dados do perfil do usuário e definir as variáveis
        $row = $result->fetch_assoc();
        $nome = $row["nome"];
        $endereco = $row["endereco"];
        $telefone = $row["telefone"];
        $foto = $row["foto"];

    } else {
        // Se não houver resultados, defina as variáveis como vazias ou null
        $nome = "";
        $endereco = "";
        $telefone = "";
        $foto = "";

        echo "Nenhum resultado encontrado para o ID de usuário: $usuario";
    }

    $conn->close();
} else {
    echo "ID do usuário não encontrado na sessão";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReciTech</title>
    <link rel="icon" href="imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/style.css">
    <script type='text/javascript' src='//code.jquery.com/jquery-compat-git.js'></script>
    <script type='text/javascript' src='//igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>
    <script src="js/script.js" defer></script>
</head>
<body>
    <!-- Navbar -->
    <nav>
      <a href="#inicio">Início</a>
      <a href="#perfil">Perfil</a>
      <div class="dropdown">
        <a href="#informativos">Informativos</a>
        <div class="dropdown-content">
          <a href="#reciclagem">Reciclagem</a>
          <a href="#reaproveitamento">Reaproveitamento</a>
        </div>
      </div>
      <a href="#pontos-de-coleta">Pontos de Coleta</a>
    </nav>
    
      <!-- Botão hamburguer (mobile) -->
      <div class="hamburguer" onclick="toggleMenu()">
        <img src="imagens/hamburguer.png" alt="Ícone Hambúrguer" >
        <p class="nome-pagina">INICIO</p>
      </div>
    
      <!-- Menu hamburguer (mobile) -->
      <div class="menu-mobile">
        <a href="#">INICIO</a>
        <a href="#">PERFIL</a>
        
        <div class="submenu" onclick="toggleSubmenu()">
          <a href="#" >INFORMATIVOS</a>
          <ul>
            <li><a href="#">- Reciclagem</a></li>
            <li><a href="#">- Reaproveitamento</a></li>
          </ul>
        </div>
        <a href="#" >PONTOS DE COLETA</a>
      </div>
    
      <!-- Conteúdo da página -->
      <div class="conteudo">
        <img src="<?php echo $foto; ?>"><br>
        <div>
          <?php echo "<p class='nome'>$nome</p>"; ?>
          <p><?php echo $endereco ?></p><br>
          <p><?php echo $telefone ?></p><br>
        </div>
      </div>

</body>
</html>
