<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recitech";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

$email = $_POST["email"];
$senha = $_POST["senha"];

$query = "SELECT * FROM cadastros WHERE email = '{$email}' AND senha = '{$senha}'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $usuario = mysqli_fetch_assoc($result);

    $_SESSION['id'] = $usuario['id']; 

    header('Location: inicio.html');
    exit();
} else {
    echo "Usuário ou senha inválidos.";
}

mysqli_close($conn);
?>
