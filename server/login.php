<?php
session_start();

if (isset($_SESSION['id_cliente'])) {
    
}



$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "capix_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Falha na conexao: " . mysqli_connect_error());
}

$email = mysqli_real_escape_string($conn, $_POST["email"]);
$senha = mysqli_real_escape_string($conn, $_POST["senha"]);

$sql = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    $_SESSION["id_cliente"] = $usuario["id_cliente"];
    $_SESSION["nome"] = $usuario["nome"];
    $_SESSION["is_admin"] = $usuario["is_admin"]; // Store admin status

    // Redirect based on user type
    if ($usuario["is_admin"] == 1) {
        header("Location: ../server/admin.php"); // Admin panel
    } else {
        header("Location: ../index.php"); // Regular user home
    }
} else {
    echo "Email ou senha incorretos.";
}

$conn->close();
?>