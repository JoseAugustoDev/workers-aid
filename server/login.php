<?php
    session_start(); 
    $servername = "localhost";
    $username = "root";
    $password = "usbw";
    $dbname = "dados";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Falha na conexao: " . mysqli_connect_error());
    }
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $senha = mysqli_real_escape_string($conn, $_POST["senha"]);
    $sql = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        
        $usuario = $result->fetch_assoc();
        $_SESSION["id_cliente"] = $usuario["id_cliente"];
        $_SESSION["nome"] = $usuario["nome"];


        header("Location: ../index.php");

    } else {

        echo "Email ou senha incorretos.";
    }
    $conn->close();
?>