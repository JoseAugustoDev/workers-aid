<?php

// Variáveis para conexão com o banco de dados
$servername = "localhost";  // Nome do servidor do banco de dados
$username = "root";         // Usuário do banco de dados
$password = "usbw";         // Senha do banco de dados
$dbname = "dados";          // Nome do banco de dados

// Conexão com o banco de dados
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if (!$conn) {
    // Se não conseguiu conectar, exibe uma mensagem de erro e encerra o script
    die("Falha na conexão: " . mysqli_connect_error());
}

// Pegando os valores do formulário (dados enviados via POST)
$email = mysqli_real_escape_string($conn, $_POST["email"]);          // Escapa o email para evitar injeção de SQL
$senha_antiga = mysqli_real_escape_string($conn, $_POST["senhaAntiga"]);  // Escapa a senha antiga
$senha_nova = mysqli_real_escape_string($conn, $_POST["senhanova"]);     // Escapa a nova senha
$confirmacao = mysqli_real_escape_string($conn, $_POST["confirmacaodasenha"]);  // Escapa a confirmação da senha

// Verificando se a nova senha e a confirmação coincidem
if ($senha_nova === $confirmacao) {

     // Se as senhas coincidirem, valida se o email e a senha antiga estão corretos
    $usuario_query = "SELECT id_cliente FROM clientes WHERE email = '$email' AND senha = '$senha_antiga'";  // Consulta no banco para verificar email e senha antiga
    $usuario_result = $conn->query($usuario_query);  // Executa a consulta

    // Se o usuário for encontrado (o número de resultados for maior que 0)
    if ($usuario_result->num_rows > 0) {

        // Recupera os dados do usuário (neste caso, o id_cliente)
        $usuario = $usuario_result->fetch_assoc();
        $id_cliente = $usuario['id_cliente'];  // Armazena o id_cliente do usuário encontrado

        // Atualiza a senha do usuário no banco de dados
        $redefinir_query = "UPDATE clientes SET senha = '$senha_nova' WHERE id_cliente = '$id_cliente'";  // Consulta para atualizar a senha
        if ($conn->query($redefinir_query) === TRUE) {  // Se a atualização for bem-sucedida
            echo "Senha redefinida com sucesso";  // Exibe uma mensagem de sucesso
        } else {
            echo "Erro ao redefinir a senha: " . $conn->error;  // Se a atualização falhar, exibe um erro
        }
    } else {
        // Caso o email ou senha antiga estejam incorretos, exibe uma mensagem
        echo "Usuário não encontrado ou senha antiga incorreta";
    }
} else {
    // Caso as senhas não coincidam, exibe uma mensagem de erro
    echo "A nova senha e a confirmação não coincidem"; 
}

// Fecha a conexão com o banco de dados após a execução
$conn->close();
?>
