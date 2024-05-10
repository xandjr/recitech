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
        <a href="contatos.php">Contatos</a>
    </nav>
    
      <!-- Botão hamburguer (mobile) -->
      <div class="hamburguer" onclick="toggleMenu()">
        <img src="imagens/hamburguer.svg" alt="Ícone Hambúrguer">
        <p class="nome-pagina">INICIO</p>
      </div>
    
      <!-- Menu hamburguer (mobile) -->
      <div class="menu-mobile">
        <a href="index.php">INICIO</a>
        <a href="perfil.php">PERFIL</a>
        
        <div class="submenu" onclick="toggleSubmenu()">
          <a href="#">INFORMATIVOS</a>
          <ul>
            <li><a href="reciclagem.php">Reciclagem</a></li>
            <li><a href="reaproveitamento.php">Reaproveitamento</a></li>
          </ul>
        </div>
        <a href="pontosdecoleta.php">PONTOS DE COLETA</a>
        <a href="contatos.php">CONTATOS</a>
      </div>
    
      <!-- Conteúdo da página -->
      <div class="conteudo">
        <img src="imagens/logo.png" class="logo">
        <?php echo "<p class='titulo' style='margin: 0px'>$nome</p>"; ?>
        <a class="meta">Amante da Natureza</a><br>
        <a class="meta">Seus Pontos: 250 | Próximo Título: 1000</a>
      </div>
      
      <!-- Barra de progresso -->
<div class="barramissao">
<div class="missao" id="missao1">
    <!--missão 1-->
    <div class="barra-container">
        <div class="missaotexto">
            <h1>MISSÃO 1</h1>
            <h4>Descarte 20 pilhas</h4>
        </div>
        <div class= "barrabotao">
        <div class="barra">
            <div></div>
        </div>

        <div class="botao-adicionar" onclick="adicionarItem('missao1')">+</div>
        </div>

        <div class="contador" id="contadorItensMissao1">Itens adicionados: 0</div>

        <!-- conquistas -->

        <div class="conquista-container">
            <div class="conquista">
                <div class="icone"></div>
                <div class="descricao">
                    <h4>Reciclou mais de uma vez no mês</h4>
                    <p>Conquista inativa</p>
                </div>
            </div>

            <div class="conquista">
                <div class="icone"></div>
                <div class="descricao">
                    <h4>Reciclou mais de quatro vezes no mês</h4>
                    <p>Conquista inativa</p>
                </div>
            </div>
            <div class="recompensa">
                <h3>Recompensa: 100 Pontos</h3>
            </div>
        </div>
    </div>
</div>
  
  <!--missão 2-->
<div class="missao" id="missao2">
    
    <div class="barra-container">
        <div class="missaotexto">
            <h1>MISSÃO 2</h1>
            <h4>Descarte 5 baterias de celular</h4>
        </div>
        <div class= "barrabotao">
        <div class="barra">
            <div></div>
        </div>

        <div class="botao-adicionar" onclick="adicionarItem('missao2')">+</div>
        </div>

        <div class="contador" id="contadorItensMissao2">Itens adicionados: 0</div>

        <!-- conquistas -->

        <div class="conquista-container">
            <div class="conquista">
                <div class="icone"></div>
                <div class="descricao">
                    <h4>Reciclou mais de uma vez no mês</h4>
                    <p>Conquista inativa</p>
                </div>
            </div>

            <div class="conquista">
                <div class="icone"></div>
                <div class="descricao">
                    <h4>Reciclou mais de quatro vezes no mês</h4>
                    <p>Conquista inativa</p>
                </div>
            </div>
            <div class="recompensa">
                <h3>Recompensa: 200 Pontos</h3>
            </div>
        </div>
    </div>
</div>
  
  <!--missão 3-->
   <div class="missao" id="missao3">
    <!--missão 1-->
    <div class="barra-container">
        <div class="missaotexto">
            <h1>MISSÃO 3</h1>
            <h4>Descarte 10 mouses ou teclados</h4>
        </div>
        <div class= "barrabotao">
        <div class="barra">
            <div></div>
        </div>

        <div class="botao-adicionar" onclick="adicionarItem('missao3')">+</div>
        </div>

        <div class="contador" id="contadorItensMissao3">Itens adicionados: 0</div>

        <!-- conquistas -->

        <div class="conquista-container">
            <div class="conquista">
                <div class="icone"></div>
                <div class="descricao">
                    <h4>Reciclou mais de uma vez no mês</h4>
                    <p>Conquista inativa</p>
                </div>
            </div>

            <div class="conquista">
                <div class="icone"></div>
                <div class="descricao">
                    <h4>Reciclou mais de quatro vezes no mês</h4>
                    <p>Conquista inativa</p>
                </div>
            </div>
            <div class="recompensa">
                <h3>Recompensa: 300 Pontos</h3>
            </div>
        </div>
    </div>
</div>
 
</div>
    
    <script>

    let totalItensMissao1 = 0;
    const barraMissao1 = document.querySelector('#missao1 .barra div');
    const contadorItensMissao1 = document.getElementById('contadorItensMissao1');
    const totalMaximoItensMissao1 = 20; // Define o total máximo de itens para a barra preenchida

    let totalItensMissao2 = 0;
    const barraMissao2 = document.querySelector('#missao2 .barra div');
    const contadorItensMissao2 = document.getElementById('contadorItensMissao2');
    const totalMaximoItensMissao2 = 5; // Define o total máximo de itens para a barra preenchida

    let totalItensMissao3 = 0;
    const barraMissao3 = document.querySelector('#missao3 .barra div');
    const contadorItensMissao3 = document.getElementById('contadorItensMissao3'); // Corrigido o ID
    const totalMaximoItensMissao3 = 10; // Define o total máximo de itens para a barra preenchida

    function adicionarItem(missao) {
        if (missao === 'missao1' && totalItensMissao1 < totalMaximoItensMissao1) {
            totalItensMissao1++;
            const larguraMaxima = 100; // Largura máxima da barra preta em porcentagem
            const larguraItem = larguraMaxima / totalMaximoItensMissao1;
            const novaLargura = larguraItem * totalItensMissao1;
            barraMissao1.style.width = novaLargura + '%'; // Define a largura da barra em porcentagem
            contadorItensMissao1.textContent = 'Itens adicionados: ' + totalItensMissao1;

            // Ativar conquistas
            ativarConquistasMissao1();
        }
        // Adicione condições semelhantes para outras missões, se houver
        else if (missao === 'missao2' && totalItensMissao2 < totalMaximoItensMissao2) {
            totalItensMissao2++;
            const larguraMaxima = 100; // Largura máxima da barra preta em porcentagem
            const larguraItem = larguraMaxima / totalMaximoItensMissao2;
            const novaLargura = larguraItem * totalItensMissao2;
            barraMissao2.style.width = novaLargura + '%'; // Define a largura da barra em porcentagem
            contadorItensMissao2.textContent = 'Itens adicionados: ' + totalItensMissao2;

            // Ativar conquistas
            ativarConquistasMissao2();
        }
        // Adicione condições semelhantes para outras missões, se houver
        else if (missao === 'missao3' && totalItensMissao3 < totalMaximoItensMissao3) {
            totalItensMissao3++;
            const larguraMaxima = 100; // Largura máxima da barra preta em porcentagem
            const larguraItem = larguraMaxima / totalMaximoItensMissao3;
            const novaLargura = larguraItem * totalItensMissao3;
            barraMissao3.style.width = novaLargura + '%'; // Define a largura da barra em porcentagem
            contadorItensMissao3.textContent = 'Itens adicionados: ' + totalItensMissao3;

            // Ativar conquistas
            ativarConquistasMissao3();
        }
        // Adicione condições semelhantes para outras missões, se houver
    }

    function ativarConquistasMissao1() { // Função para ativar conquistas com base no número de itens adicionados para a Missão 1
        const conquistasMissao1 = document.querySelectorAll('#missao1 .conquista');
        conquistasMissao1.forEach((conquista, index) => {
            if (totalItensMissao1 >= (index + 1) * 2) {
                conquista.classList.add('ativa');
                conquista.querySelector('.descricao p').textContent = 'Conquista ativa';
            } else {
                conquista.classList.remove('ativa');
                conquista.querySelector('.descricao p').textContent = 'Conquista inativa';
            }
        });
    }
     function ativarConquistasMissao2() { // Função para ativar conquistas com base no número de itens adicionados para a Missão 1
        const conquistasMissao2 = document.querySelectorAll('#missao2 .conquista');
        conquistasMissao2.forEach((conquista, index) => {
            if (totalItensMissao2 >= (index + 1) * 2) {
                conquista.classList.add('ativa');
                conquista.querySelector('.descricao p').textContent = 'Conquista ativa';
            } else {
                conquista.classList.remove('ativa');
                conquista.querySelector('.descricao p').textContent = 'Conquista inativa';
            }
        });
    }// Adicione funções semelhantes para outras missões, se houver
    function ativarConquistasMissao3() { // Função para ativar conquistas com base no número de itens adicionados para a Missão 1
        const conquistasMissao3 = document.querySelectorAll('#missao3 .conquista');
        conquistasMissao3.forEach((conquista, index) => {
            if (totalItensMissao3 >= (index + 1) * 2) {
                conquista.classList.add('ativa');
                conquista.querySelector('.descricao p').textContent = 'Conquista ativa';
            } else {
                conquista.classList.remove('ativa');
                conquista.querySelector('.descricao p').textContent = 'Conquista inativa';
            }
        });
    }// Adicione funções semelhantes para out
</script>
    
      <script src="js/script.js"></script>
</body>
</html>
