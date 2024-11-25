<?php

$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "dados";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}


$email = mysqli_real_escape_string($conn, $_POST["email"]);
$senha_antiga = mysqli_real_escape_string($conn, $_POST["senhaAntiga"]);
$senha_nova = mysqli_real_escape_string($conn, $_POST["senhanova"]);
$confirmacao = mysqli_real_escape_string($conn, $_POST["confirmacaodasenha"]);

if ($senha_nova === $confirmacao) {

    $usuario_query = "SELECT id_cliente FROM clientes WHERE email = '$email' AND senha = '$senha_antiga'";
    $usuario_result = $conn->query($usuario_query);

    if ($usuario_result->num_rows > 0) {

        $usuario = $usuario_result->fetch_assoc();
        $id_cliente = $usuario['id_cliente'];


        $redefinir_query = "UPDATE clientes SET senha = '$senha_nova' WHERE id_cliente = '$id_cliente'";
        if ($conn->query($redefinir_query) === TRUE) {
            echo "Senha redefinida com sucesso";
        } else {
            echo "Erro ao redefinir a senha: " . $conn->error;
        }
    } else {
        echo "Usuário não encontrado ou senha antiga incorreta";
    }
} else {
    echo "A nova senha e a confirmação não coincidem";
}


$conn->close();
?>