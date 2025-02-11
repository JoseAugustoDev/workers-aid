<?php
// Iniciando a sessão
session_start();
if (!isset($_SESSION['id_cliente'])) {
     echo "Você precisa estar logado para avaliar!";
     exit;
}

// Variáveis para conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "dados";

// Conectando ao banco de dados
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificando se a conexão foi bem-sucedida
if (!$conn) {
     die("Falha na conexão: " . mysqli_connect_error());
}

$id_cliente = $_SESSION['id_cliente'];

// Pegando os valores do formulário via POST, validando antes
$feedback = isset($_POST["feedback"]) ? mysqli_real_escape_string($conn, $_POST["feedback"]) : '';
$nota = isset($_POST["nota"]) ? (int) $_POST["nota"] : 0;
$recomendar = isset($_POST["recomendar"]) && $_POST["recomendar"] == '1' ? 1 : 0;

// Definição de avaliações positiva e negativa
$avaliacao_negativa = 0;
$avaliacao_positiva = 1;

$tipo_avaliacao = ($recomendar == 1) || $nota >= 4 ? $avaliacao_positiva : $avaliacao_negativa;

// Query preparada para evitar SQL Injection
$sql = "INSERT INTO feedback (id_cliente, comentario, nota, positiva) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
     $stmt->bind_param("issi", $id_cliente, $feedback, $nota, $tipo_avaliacao);

     if ($stmt->execute()) {
          header("Location: ../index.php");
          exit;
     } else {
          echo "Erro ao inserir: " . $stmt->error;
     }

     $stmt->close();
} else {
     echo "Erro na preparação da query.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>