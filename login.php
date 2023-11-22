<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recitech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
    die("Conexão falhou: " . $conn -> connect_error);
}

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM cadastros WHERE email = '$email' AND senha='$senha'";
$result = $conn -> query($sql);

if ($result -> num_rows > 0) {
    header("Location: loginsucedido.html");
    exit();
} else {
    echo "Login invalido. Tente novamente.";
}

$conn -> close();
?>