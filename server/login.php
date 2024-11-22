<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Sucesso - Teste Login</title>
</head>
<body>
    <p> 
        Email: <?php echo $_POST["email"]; ?><br>
        Senha: <?php echo $_POST["senha"]; ?><br>
    </p>
    
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "usbw";
        $dbname = "workers";

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
            echo "Login realizado com sucesso. Bem-vindo, " . $usuario["nome"] . "!";

            header("Location: /pages/index.html");

            exit;
            
        } else {
            echo "Email ou senha incorretos.";
        }

        $conn->close();
    ?>
</body>
</html>