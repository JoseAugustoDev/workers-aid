<?php
    $servername = "localhost";
    $username = "root";
    $password = "usbw";
    $dbname = "dados";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Falha na conexao: " . mysqli_connect_error());
    }

    $nome = mysqli_real_escape_string($conn, $_POST["email"]);
    $email = mysqli_real_escape_string($conn, $_POST["redefinirsenha"]);
    $senha = mysqli_real_escape_string($conn, $_POST["confirmacaodasenha"]);

    $sql = "SELECT";

    if ($conn->query($sql) === TRUE) {
        echo "Redefinido com Sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

?>