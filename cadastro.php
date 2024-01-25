<?php

$servername = "localhost";
$username = "id21818704_recitech";
$password = "R3cit3ch.";
$dbname = "id21818704_recibd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
    die("Conexão falhou: " . $conn -> connect_error);
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];
$senha2 = $_POST['senha2'];

$sql = "INSERT INTO cadastros (nome, email, endereco, telefone, senha, senha2) VALUES ('$nome', '$email', '$endereco', '$telefone', '$senha', '$senha2')";

if ($conn -> query($sql) === TRUE) {
    header("Location: cadastrorealizado.html");
    exit();
} else {
    echo "Erro: " . $sql . "<br>" . $conn -> error;
}

$conn -> close();
?>