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

    if (!isset($_SESSION['id_cliente'])) {
        die("Sessão não iniciada ou usuário não autenticado.");
    }

    $sql = "SELECT * FROM clientes WHERE id_cliente = '{$_SESSION['id_cliente']}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        $_SESSION["id_cliente"] = $usuario["id_cliente"];
        $_SESSION["nome"] = $usuario["nome"];
        $_SESSION["email"] = $usuario["email"];
        $_SESSION["senha"] = $usuario["senha"];
        $_SESSION["endereco"] = $usuario["endereco"];

        header("Location: /pages/perfil.php");
        exit;
        
    } else {
        echo "Email ou senha incorretos.";
    }

    $conn->close();
?>
