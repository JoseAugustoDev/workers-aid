<?php
    // Iniciando a sessão
    session_start(); 

    // Variáveis de conexão cpm o banco
    $servername = "localhost";
    $username = "root";
    $password = "usbw";
    $dbname = "dados";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Falha na conexao: " . mysqli_connect_error());
    }

    // Pegando os valores para validar o login
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $senha = mysqli_real_escape_string($conn, $_POST["senha"]);

    $sql = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $usuario = $result->fetch_assoc();
        $_SESSION["id_cliente"] = $usuario["id_cliente"];
        $_SESSION["nome"] = $usuario["nome"];

        // Se o login for validado o usuario sera redirecionado para a tela principal
        header("Location: ../index.php");
        
    } else {
        
        echo "Email ou senha incorretos.";
    }

    $conn->close();
?>
