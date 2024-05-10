<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $servername = "localhost";
    $username = "u216342583_recitech";
    $password = "Recitech123!";
    $dbname = "u216342583_recitechbd";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Verificar a conexão com o banco de dados
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Verificar se o e-mail existe no banco de dados
    $query = "SELECT * FROM cadastros WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Gerar nova senha aleatória
        $novasenha = substr(md5(time()), 0, 6);
        // $novasenhacriptografada = password_hash($novasenha, PASSWORD_DEFAULT);

        // Atualizar a senha no banco de dados
        $sql_code = "UPDATE cadastros SET senha = '$novasenha' WHERE email = '$email'";
        $sql_query = mysqli_query($conn, $sql_code) or die(mysqli_error($conn));

        // Enviar a nova senha por e-mail
        $envio = mail($email, "Sua nova senha", "Sua nova senha: ". $novasenha);

        if ($envio) {
            header("Location: login1.html");
            exit();
          }  else {
            echo "Erro ao enviar e-mail com nova senha.";
        }
    } else {
        header("Location: emailinvalido.html");
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReciTech</title>
    <link rel="icon" href="imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
</head>
<body class="background">
    <div class="centralizado">
        <p class="titulo">ESQUECI MINHA SENHA</p><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label class="fonte-esquecisenha">Digite seu e-mail para receber o link para redefinir sua senha</label><br><br>
            <input type="text" id="email" name="email" placeholder="E-mail" class="caixa-cadastro" required><br><br>
            <input type="submit" class="botao" value="Enviar"><br>
        </form>
    </div>
</body>
</html>