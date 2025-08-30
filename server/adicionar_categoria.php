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
$nome = mysqli_real_escape_string($conn, $_POST["nome_categoria"]);


$situacao_cliente_comum = 0;

// Validação para verificar se as senhas coincidem

$sql = "INSERT INTO categoria (nome_categoria) VALUES ('$nome')";

if ($conn->query($sql) === TRUE) {
     echo "Inserido com sucesso";

     header("Location: admin.php");

     exit;
} else {
     echo "Erro: " . $sql . "<br>" . $conn->error;
}


// Fecha a conexão com o banco de dados
$conn->close();
?>