<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Sucesso - Teste Cadastro</title>
</head>
<body>
    <p> 
        Nome: <?php echo $_POST["nome"]; ?><br>
        Email: <?php echo $_POST["email"]; ?><br>
        Senha: <?php echo $_POST["senha"]; ?><br>
        Endereço: <?php echo $_POST["endereco"]; ?>
    </p>

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
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    ?>
</body>
</html>