<?php
session_start();

// Verificar se o ID do usuário está definido na sessão
if (isset($_SESSION['id'])) {
    // Conecta ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "recitech";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Prepara e executa a consulta para recuperar os dados do usuário com base no ID
    $id_usuario = $_SESSION['id'];
    $sql = "SELECT nome, endereco, telefone, foto FROM cadastros WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se a consulta retornou algum resultado
    if ($result->num_rows > 0) {
        // Recupera os dados do perfil do usuário
        $row = $result->fetch_assoc();
        $nome = $row["nome"];
        $endereco = $row["endereco"];
        $telefone = $row["telefone"];
        $foto = $row["foto"];
    } else {
        // Se não houver resultados, define as variáveis como vazias ou null
        $nome = "";
        $endereco = "";
        $telefone = "";
        $foto = "";

        echo "Nenhum resultado encontrado para o ID de usuário: $id_usuario";
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
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
        <img src="<?php echo $foto; ?>" alt="Foto do usuário" class="logo"><br>
        <p><?php echo $nome; ?></p><br>
        <p><?php echo $endereco; ?></p><br>
        <p><?php echo $telefone; ?></p><br>
      </div>

</body>
</html>
