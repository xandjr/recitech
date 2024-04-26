<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $servername = "localhost";
    $username = "id21818707_recitech";
    $password = "recitechBD123.";
    $dbname = "id21818707_recitechbd";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Verificar a conexão com o banco de dados
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM cadastros WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
       
    if (mysqli_num_rows($result) > 0) {
       
        $novasenha = substr(md5(time()), 0, 6);
        $nscriptografada = md5(md5($novasenha));
       
        $envio = mail($email, "Sua nova senha", "Sua nova senha: ". $novasenha);
       
        if($envio){
            $sql_code = "UPDATE cadastros SET senha = '$nscriptografada' WHERE email = '$email'";
            $sql_query = mysqli_query($conn, $sql_code) or die(mysqli_error($conn));
                    
            header ("Location: login1.html");
            exit();
            }
        }else{
        echo "E-mail não encontrado. Por favor, insira um e-mail válido.";
    }
    
    // Fechar a conexão com o banco de dados
    mysqli_close($conn);
}

?>
