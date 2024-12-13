<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "dados";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Falha na conexao: " . mysqli_connect_error());
}

if (!isset($_SESSION['id_cliente'])) {
    die("Sessão não iniciada ou usuário não autenticado.");
}

$sql = "SELECT * FROM clientes WHERE id_cliente = '{$_SESSION['id_cliente']}'";

$result_cliente = $conn->query($sql);
$result_profissional = $conn->query($sql2);

if ($result_cliente->num_rows > 0) {
    $usuario = $result_cliente->fetch_assoc();
    $_SESSION["id_cliente"] = $usuario["id_cliente"];
    $_SESSION["nome"] = $usuario["nome"];
    $_SESSION["email"] = $usuario["email"];
    $_SESSION["senha"] = $usuario["senha"];
    $_SESSION["endereco"] = $usuario["endereco"];
    $_SESSION["id_situacao"] = $usuario["id_situacao"];

    if ($_SESSION["id_situacao"] != 0) {
        header("Location: /pages/perfil-profissional.php");

    }  else {
        header("Location: /pages/perfil-cliente.php");

    }

    exit;

} else {
    echo "Usuário não encontrado.";
}

$conn->close();
?>