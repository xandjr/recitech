<?php

session_start();

// Verifica se o id do usuário está definido na sessão
if (isset($_SESSION['id'])) {
    $usuario = $_SESSION['id'];

    $servername = "localhost";
    $username = "u216342583_recitech";
    $password = "Recitech123!";
    $dbname = "u216342583_recitechbd";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Verifica se a conexão foi estabelecida com sucesso
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Recupera os dados do formulário
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];

        // Verifica se foi enviado uma foto
        if ($_FILES['foto']['name']) {
            $foto = $_FILES['foto']['name'];
            $temp = $_FILES['foto']['tmp_name'];
            // Define uma variável e renomeia a foto enviada com o id do usuário
            $foto_nova = "./fotos/" . "id " . $usuario ."_foto " . $foto;

            // Move o arquivo enviado para o local desejado
            move_uploaded_file($temp, $foto_nova);

            // Atualiza os dados do usuário no banco de dados
            $sql = "UPDATE cadastros SET nome = '$nome', endereco = '$endereco', telefone = '$telefone', foto = '$foto_nova' WHERE id = $usuario";


        } else {
            // Se a foto não for enviada, apenas atualiza as outras informações
            $sql = "UPDATE cadastros SET nome = '$nome', endereco = '$endereco', telefone = '$telefone' WHERE id = $usuario";
        }

        // Após atualização, retorna a página do perfil
        if (mysqli_query($conn, $sql)) {
            header("Location: perfil.php");
        } else {
            echo "Erro ao atualizar o perfil: " . mysqli_error($conn);
        }
    } else {
        echo "O formulário não foi enviado.";
    }


    mysqli_close($conn);
} else {
    echo "ID do usuário não encontrado na sessão";
}
?>