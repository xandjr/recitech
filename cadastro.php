<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recitech";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];
$senhacriptografada = password_hash($senha, PASSWORD_DEFAULT);


$sql = "INSERT INTO cadastros (nome, email, endereco, telefone, senha) VALUES ('$nome', '$email', '$endereco', '$telefone', '$senhacriptografada')";

if ($conn -> query($sql) === TRUE) {
    header("Location: cadastrorealizado.html");
    exit();
} else {
    echo "Erro: " . $sql . "<br>" . $conn -> error;
}

mysqli_close($conn);
?>