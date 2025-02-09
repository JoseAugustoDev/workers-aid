<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_cliente'])) {
     header("Location: /pages/login.html");
     exit();
}

$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "dados";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
     die("Falha na conexão: " . $conn->connect_error);
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
     echo "Mensagem não encontrada.";
     exit();
}

$id_mensagem = $_GET['id'];
$id_cliente = $_SESSION['id_cliente'];

$get_profissional = "SELECT nome, id_situacao FROM clientes WHERE id_cliente = $id_cliente";
$result_prof = $conn->query($get_profissional);

if ($result_prof->num_rows > 0) {
     while ($row = $result_prof->fetch_assoc()) {

          $id_profissional = $row["id_situacao"];
          $nome_profissional = $row["nome"];
     }
}

// Busca a mensagem no banco de dados
$sql = "SELECT mensagem.mensagem
        FROM mensagem
        JOIN profissional ON mensagem.id_profissional = profissional.id_profissional
        WHERE mensagem.id_mensagem = ? AND mensagem.id_profissional = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_mensagem, $id_profissional);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
     echo "Mensagem não encontrada.";
     exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Visualizar Mensagem</title>
     <link rel="stylesheet" href="style.css">
</head>

<body>
     <p><?php echo nl2br(htmlspecialchars($row['mensagem'])); ?></p>

     <a href="caixa-entrada.php">Voltar</a>

</body>

</html>

<?php
$stmt->close();
$conn->close();
?>