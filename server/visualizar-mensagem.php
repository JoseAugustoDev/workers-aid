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
$sql = "SELECT mensagem.mensagem, mensagem.id_cliente
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

$id_cliente = $row['id_cliente'];

$consulta = "SELECT nome, email FROM clientes WHERE id_cliente = $id_cliente";

$resultconsulta = $conn->query($consulta);

// Verifica se a consulta foi bem-sucedida e se retornou um valor válido
if ($row2 = $resultconsulta->fetch_assoc()) {
     $nome = $row2['nome'];
     $email = $row2['email'];
} else {
     echo "Erro";
}


?>

<!DOCTYPE html>
<html lang="pt">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <title>Visualizar Mensagem</title>
     <link rel="stylesheet" href="style.css">
</head>

<body class="bg-info p-3 mb-2 bg-primary text-white w-100">
     <h1>Mensagem Completa</h1>
     <div class="container justify-content-start align-items-start w-50 p-3 vh-100 m-0">
          <ul class="d-flex align-items-center justify-content-center flex-column w-100 m-3 text-dark p-0">
               <li class='p-3 list-group-item border border-dark rounded w-50 m-2'>Enviado por: <?php echo nl2br(htmlspecialchars($row2['nome'])); ?></li>
               <li class='p-3 list-group-item border border-dark rounded w-50 m-2'>Contato: <?php echo nl2br(htmlspecialchars($row2['email'])); ?></li>
               <li class='p-3 list-group-item border border-dark rounded w-50 m-2'>Mensagem: <?php echo nl2br(htmlspecialchars($row['mensagem'])); ?></li>
          </ul>

          <button class="btn btn-dark text-white fixed-bottom">
               <a href="caixa-entrada.php">Voltar</a>
          </button>
     </div>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>