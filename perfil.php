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
    header("Location: index.html");
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
      <a href="inicio.php">Início</a>
      <a href="perfil.php">Perfil</a>
      <div class="dropdown">
        <a href="#">Informativos</a>
        <div class="dropdown-content">
          <a href="reciclagem.html">Reciclagem</a>
          <a href="reaproveitamento.html">Reaproveitamento</a>
        </div>
      </div>
      <a href="#pontos-de-coleta">Pontos de Coleta</a>
    </nav>
    
      <!-- Botão hamburguer (mobile) -->
      <div class="hamburguer" onclick="toggleMenu()">
        <img src="imagens/hamburguer.png" alt="Ícone Hambúrguer">
        <p class="nome-pagina">PERFIL</p>
      </div>
    
      <!-- Menu hamburguer (mobile) -->
      <div class="menu-mobile">
        <a href="inicio.php">INICIO</a>
        <a href="perfil.php">PERFIL</a>
        <div class="submenu" onclick="toggleSubmenu()">
          <a href="#">INFORMATIVOS</a>
          <ul>
            <li><a href="reciclagem.html">RECICLAGEM</a></li>
            <li><a href="reaproveitamento.html">REAPROVEITAMENTO</a></li>
          </ul>
        </div>
        <a href="#">PONTOS DE COLETA</a>
      </div>
    
      <!-- Conteúdo da página -->
      <div class="conteudo" >
        <img class="fotoperfil" src="<?php echo $foto; ?>" alt="Meu Perfil"><br>
        <div>
          <?php echo "<p class='textoperfil'>$nome</p>"; ?>
          <?php echo "<p class='textoperfil'; style='font-size:20px'>$endereco</p>"; ?>
          <?php echo "<p class='textoperfil'; style='font-size:20px'>$telefone</p>"; ?><br><br>
          <a href="#" class="fonte-pequena" style="font-size: 15px" onclick="mostrarModal()">Editar perfil</a><br><br><br><br>
          <form action="logout.php" method="post">
            <input type="submit" class="botao" value="Logout">
          </form>
          <!-- Modal -->
          <div id="modal" class="modal">
            <div class="modal-conteudo">
              <span class="fechar" onclick="fecharModal()">&times;</span>
              <p class="titulo" style="font-size: 35px; margin-bottom: 5px">Editar Perfil</p>
              <form action="atualizarperfil.php" method="post" enctype="multipart/form-data">
                <label for="nome" style="color:black; font-size: 25px">Nome</label><br>
                <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" class="caixa-edicao"><br><br>
                <label for="endereco" style="color:black; font-size: 25px">Endereço</label><br>
                <input type="text" id="endereco" name="endereco" value="<?php echo $endereco; ?>" class="caixa-edicao"><br><br>
                <label for="telefone" style="color:black; font-size: 25px">Telefone</label><br>
                <input type="text" id="telefone" name="telefone" value="<?php echo $telefone; ?>" class="caixa-edicao"><br><br>
                <label for="foto" style="color:black; font-size: 25px">Foto</label><br>
                <input type="file" id="foto" name="foto" class="caixa-edicao" style="box-shadow:none" accept="image/*"><br><br>
                <input type="submit" value="Salvar" class="botao"><br><br>
                </form>
            </div>
          </div>
        </div>
      </div>

</body>
</html>