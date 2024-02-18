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

$verificaremail = "SELECT * FROM cadastros WHERE email = '{$email}'";
$resultado = mysqli_query($conn, $verificaremail);

if (mysqli_num_rows($resultado) > 0) {
    // E-mail já existe, mostrar mensagem de erro
    echo "Erro: Este e-mail já está cadastrado.";
} else {
    // E-mail não existe, inserir novo registro
    $sql = "INSERT INTO cadastros (nome, email, endereco, telefone, senha) VALUES ('$nome', '$email', '$endereco', '$telefone', '$senhacriptografada')";
    if ($conn -> query($sql) === TRUE) {
        header("Location: cadastrorealizado.html");
        exit();
    } else {
        echo "Erro: " . $sql . "<br>" . $conn -> error;
    }
}

mysqli_close($conn);
?>