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

    $sql = "SELECT titulo, descricao, premio, pontuacao FROM metas WHERE "
}

?>