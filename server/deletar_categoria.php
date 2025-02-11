<?php
// Iniciando a sessão
session_start();

// Variáveis para conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "dados";

// Conectando ao banco de dados
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificando se a conexão foi bem-sucedida
if (!$conn) {
     die("Falha na conexao: " . mysqli_connect_error());
}

// Pegando os valores do formulário via POST
$id_categoria = mysqli_real_escape_string($conn, $_POST["id_categoria"]);


$situacao_cliente_comum = 0;

// Validação para verificar se as senhas coincidem

$sql = "DELETE FROM categoria WHERE id_categoria = $id_categoria";

if ($conn->query($sql) === TRUE) {
     echo "Deletado com sucesso";

     header("Location: admin.php");

     exit;
} else {
     echo "Erro: " . $sql . "<br>" . $conn->error;
}


// Fecha a conexão com o banco de dados
$conn->close();
?>