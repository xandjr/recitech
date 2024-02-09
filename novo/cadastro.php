<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recitech";

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

$target_dir = "uploads/";
$targer_file = $target_dir.basename($_FILES['foto']['name']);
move_uploaded_file($_FILES['foto']['tmp_name'], $targer_file);

$sql = "INSERT INTO cadastros (nome, email, endereco, telefone, foto, senha, senha2) VALUES ('$nome', '$email', '$endereco', '$telefone', '$target_file', '$senha', '$senha2')";

if ($conn -> query($sql) === TRUE) {
    header("Location: cadastrorealizado.html");
    exit();
} else {
    echo "Erro: " . $sql . "<br>" . $conn -> error;
}

$conn -> close();
?>