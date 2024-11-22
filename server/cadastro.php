<?php
    $servername = "localhost";
    $username = "root";
    $password = "usbw";
    $dbname = "dados";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Falha na conexao: " . mysqli_connect_error());
    }

    $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $senha = mysqli_real_escape_string($conn, $_POST["senha"]);
    $endereco = mysqli_real_escape_string($conn, $_POST["endereco"]);

    $sql = "INSERT INTO clientes (nome, email, senha, endereco) VALUES ('$nome', '$email', '$senha', '$endereco')";

    if ($conn->query($sql) === TRUE) {
        echo "Inserido com sucesso";

        header("Location: /pages/login.html");

        exit;
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>
