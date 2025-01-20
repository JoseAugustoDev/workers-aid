<?php

// Variáveis para conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "dados";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Pegando os valores do formulário (envio via POST)
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$senha_antiga = mysqli_real_escape_string($conn, $_POST["senhaAntiga"]);
$senha_nova = mysqli_real_escape_string($conn, $_POST["senhanova"]);
$confirmacao = mysqli_real_escape_string($conn, $_POST["confirmacaodasenha"]);

// Verificando se a nova senha e a confirmação coincidem
if ($senha_nova === $confirmacao) {

     // Validação básica para verificar se o email e senha antiga estão corretos
    $usuario_query = "SELECT id_cliente FROM clientes WHERE email = '$email' AND senha = '$senha_antiga'";
    $usuario_result = $conn->query($usuario_query);
    
    // Se o usuário for encontrado
    if ($usuario_result->num_rows > 0) {

        $usuario = $usuario_result->fetch_assoc();
        $id_cliente = $usuario['id_cliente'];

        // Atualizando a senha no banco de dados
        $redefinir_query = "UPDATE clientes SET senha = '$senha_nova' WHERE id_cliente = '$id_cliente'";
        if ($conn->query($redefinir_query) === TRUE) {
            echo "Senha redefinida com sucesso";
        } else {
            echo "Erro ao redefinir a senha: " . $conn->error; // Mensagem de erro se a atualização falhar
        }
    } else {
        echo "Usuário não encontrado ou senha antiga incorreta"; // Mensagem caso o email ou a senha antiga estejam incorretos
    }
} else {
    echo "A nova senha e a confirmação não coincidem";// Mensagem se as senhas não coincidirem
}

// Fecha a conexão com o banco de dados
$conn->close();
?>