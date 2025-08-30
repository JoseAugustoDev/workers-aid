<?php
// Iniciando a sessão
session_start();

// Variáveis para conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "capix_db";

// Conectando ao banco de dados
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificando se a conexão foi bem-sucedida
if (!$conn) {
    die("Falha na conexao: " . mysqli_connect_error());
}

// Pegando os valores do formulário via POST
$nome = mysqli_real_escape_string($conn, $_POST["nome"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$senha = mysqli_real_escape_string($conn, $_POST["senha"]);
$confirma_senha = mysqli_real_escape_string($conn, $_POST["senha-confirma"]);
$endereco = mysqli_real_escape_string($conn, $_POST["endereco"]);


$situacao_cliente_comum = 0;

// Validação para verificar se as senhas coincidem
if ($confirma_senha == $senha) {
    $sql = "INSERT INTO clientes (nome, email, senha, endereco, id_situacao) VALUES ('$nome', '$email', '$senha', '$endereco', '$situacao_cliente_comum')";

    if ($conn->query($sql) === TRUE) {
        echo "Inserido com sucesso";

        header("Location: /pages/login.html");

        exit;
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "As senhas precisam ser iguais";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>