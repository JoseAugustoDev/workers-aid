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

$email = mysqli_real_escape_string($conn, $_POST["email"]);
$senha = $_POST["senha"]; // Senha não precisa de escape, pois será usada com password_verify

$sql = "SELECT id_cliente, nome, senha FROM clientes WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    if (password_verify($senha, $usuario['senha'])) {
        $_SESSION["id_cliente"] = $usuario["id_cliente"];
        $_SESSION["nome"] = $usuario["nome"];
        header("Location: ../index.php");
    } else {
        echo "Email ou senha incorretos.";
    }
} else {
    echo "Email ou senha incorretos.";
}

$stmt->close();
$conn->close();
?>