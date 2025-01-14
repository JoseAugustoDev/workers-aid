<?php

// Iniciando a sessão
session_start();

// Variáveis de conexão com o Banco de Dados
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

// Buscando todas as informações do usuario que esta logado
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
        // No usário profissional o campo id_situação é o mesmo do id_profissional. Logo, se for diferente de 0 signfica que o usuario é um profissional
        header("Location: /pages/perfil-profissional.php");
        
    }  else {
        // No usário comum o campo id_situacao é sempre 0
        header("Location: /pages/perfil-cliente.php");

    }

    exit;

} else {
    echo "Usuário não encontrado.";
}

$conn->close();
?>