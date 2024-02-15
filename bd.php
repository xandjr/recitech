<?php

session_start();

// Verificar se o ID do usuário está definido na sessão
if (isset($_SESSION['id'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "recitech";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $id_usuario = $_SESSION['id'];

    $sql = "SELECT nome, endereco, telefone, foto FROM cadastros WHERE id = $id_usuario";
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

        // Depuração: imprime os dados recuperados
        echo "Nome: " . $nome . "<br>";
        echo "Endereço: " . $endereco . "<br>";
        echo "Telefone: " . $telefone . "<br>";
        echo "Foto: " . $foto . "<br>";
    } else {
        // Se não houver resultados, defina as variáveis como vazias ou null
        $nome = "";
        $endereco = "";
        $telefone = "";
        $foto = "";

        echo "Nenhum resultado encontrado para o ID de usuário: $id_usuario";
    }

    $conn->close();
} else {
    echo "ID do usuário não encontrado na sessão";
}

?>
