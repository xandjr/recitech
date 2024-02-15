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

// Recebe o email e senha
$email = $_POST["email"];
$senha = $_POST["senha"];

// Verifica se o email e a senha estão corretos com o banco de dados
$query = "SELECT * FROM cadastros WHERE email = '{$email}'";
$result = mysqli_query($conn, $query);

// Verifica os dados
if (mysqli_num_rows($result) > 0) {
    $usuario = mysqli_fetch_assoc($result);
    // Busca a senha do usuário que está no banco de dados
    $senha2 = $usuario['senha'];

    // Verifica se as senhas estão batendo
    if (password_verify($senha, $senha2)){
        $_SESSION['id'] = $usuario['id']; 
        header('Location: inicio.php');
        exit();
    } else {
        header('Location: logininvalido.html');
    }
} else {
    header('Location: logininvalido.html');
}

mysqli_close($conn);
?>
