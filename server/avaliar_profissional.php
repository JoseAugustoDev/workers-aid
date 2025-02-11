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

$sqlMedia = "SELECT AVG(nota) as media FROM avaliacao WHERE id_profissional = $id_profissional";
$resultMedia = $conn->query($sqlMedia);

// Verifica se a consulta foi bem-sucedida e se retornou um valor válido
if ($resultMedia && $rowMedia = $resultMedia->fetch_assoc()) {
     $media = $rowMedia['media'] !== null ? round($rowMedia['media'], 1) : "Sem avaliações";
} else {
     $media = "Sem avaliações"; // Caso não haja avaliações ou a consulta falhe
}

$avaliacao = "UPDATE profissional SET avaliacao = $media WHERE id_profissional = $id_profissional";
if ($conn->query($avaliacao) === TRUE) {
     echo "Avaliação enviada com sucesso!";
} else {
     echo "Erro ao enviar avaliação: " . $conn->error;
}


$conn->close();
?>