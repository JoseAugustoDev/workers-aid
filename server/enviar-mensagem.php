<?php
session_start();

if (!isset($_SESSION['id_cliente'])) {
     echo "Você precisa estar logado para enviar uma mensagem!";
     exit;
}

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "dados";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
     die("Erro na conexão: " . $conn->connect_error);
}

// Recebe os dados da avaliação
$id_profissional = $_POST['id_profissional'];
$id_cliente = $_SESSION['id_cliente'];
$mensagem = $conn->real_escape_string($_POST['mensagem']);

// Insere a avaliação no banco de dados
$sql = "INSERT INTO mensagem (id_profissional, id_cliente, mensagem) VALUES ('$id_profissional', '$id_cliente', '$mensagem')";
if ($conn->query($sql) === TRUE) {
     echo "Mensagem enviada com sucesso!";
} else {
     echo "Erro ao enviar mensagem: " . $conn->error;
}

$conn->close();
?>