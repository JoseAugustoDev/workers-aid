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

   // Pegando os valores de email e senha do formulário via POST
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $senha = mysqli_real_escape_string($conn, $_POST["senha"]);

 // Consulta SQL para verificar se o email e a senha existem na tabela 'clientes'
    $sql = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);
    
 // Verificando se existe algum resultado na consulta
    if ($result->num_rows > 0) {
        
        $usuario = $result->fetch_assoc();
        $_SESSION["id_cliente"] = $usuario["id_cliente"];
        $_SESSION["nome"] = $usuario["nome"];

          // Se o login for validado, redireciona o usuário para a página principal (index.php)
        header("Location: ../index.php");
        
    } else {
        
        echo "Email ou senha incorretos.";
    }
// Fecha a conexão com o banco de dados
    $conn->close();
?>
