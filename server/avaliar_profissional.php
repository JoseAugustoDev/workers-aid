<?php
session_start();
if (!isset($_SESSION['id_cliente'])) {
     echo "Você precisa estar logado para avaliar!";
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
$nota = $_POST['nota'];
$comentario = $conn->real_escape_string($_POST['comentario']);

// Insere a avaliação no banco de dados
$sql = "INSERT INTO avaliacao (id_profissional, id_cliente, nota, comentario) VALUES ('$id_profissional', '$id_cliente', '$nota', '$comentario')";
if ($conn->query($sql) === TRUE) {
     echo "Avaliação enviada com sucesso!";
} else {
     echo "Erro ao enviar avaliação: " . $conn->error;
}

$conn->close();
?>