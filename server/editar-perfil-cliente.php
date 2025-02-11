<?php
// Inicia a sessão para acessar variáveis de sessão
session_start();

// Verifica se o usuário está logado. Se não estiver, exibe uma mensagem e encerra o script.
if (!isset($_SESSION['id_cliente'])) {
    echo "Você não está logado.";
    exit;
}

// Configurações de conexão com o banco de dados
$servername = "localhost"; // Endereço do servidor
$username = "root";        // Nome de usuário do banco de dados
$password = "usbw";        // Senha do banco de dados
$dbname = "dados";         // Nome do banco de dados

// Conecta ao banco de dados
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error()); // Encerra o script e exibe o erro de conexão
}

// Obtém o ID do cliente da sessão
$id_cliente = $_SESSION['id_cliente'];

// Consulta o banco de dados para buscar os dados do cliente logado
$sql = "SELECT * FROM clientes WHERE id_cliente = '$id_cliente'";
$result = mysqli_query($conn, $sql);

// Verifica se a consulta retornou algum resultado
if ($result->num_rows > 0) {
    $usuario = mysqli_fetch_assoc($result); // Armazena os dados do cliente em um array associativo
} else {
    echo "Erro ao buscar dados do usuário."; // Exibe erro se o usuário não for encontrado
    exit; // Encerra o script
}

// Verifica se o formulário foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém e protege os dados do formulário contra injeção SQL
    $novo_nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $novo_email = mysqli_real_escape_string($conn, $_POST['email']);
    $novo_endereco = mysqli_real_escape_string($conn, $_POST['endereco']);

    // Query para atualizar os dados do cliente no banco de dados
    $update_sql = "UPDATE clientes SET nome = '$novo_nome', email = '$novo_email', endereco = '$novo_endereco' WHERE id_cliente = '$id_cliente'";

    // Executa a query de atualização
    if (mysqli_query($conn, $update_sql)) {
        // Atualiza as variáveis de sessão com os novos dados
        $_SESSION['nome'] = $novo_nome;
        $_SESSION['email'] = $novo_email;
        $_SESSION['endereco'] = $novo_endereco;
        echo "Perfil atualizado com sucesso!"; // Exibe mensagem de sucesso
    } else {
        echo "Erro ao atualizar perfil: " . mysqli_error($conn); // Exibe erro se a atualização falhar
    }
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../pages/css/styleeditarperfil.css"> <!-- Link para o arquivo CSS -->
</head>

<body>   
    <div class="container d-flex justify-content-center align-items-center">
        <!-- Exibe a logo do site -->
        <div>
            <img id="imglogin" src="../pages/imgs/logo.jpg" alt="Logo"> 
        </div>
        

        <div class="container d-flex justify-content-center align-items-center flex-column">
            <h1>Editar perfil:</h1>
    
            <!-- Formulário para editar o perfil -->
            <section>
                <form action="editar-perfil-cliente.php" method="POST">
                    <!-- Campo para editar o nome -->
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" required>
    
                    <!-- Campo para editar o e-mail -->
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>" required>
    
                    <!-- Campo para editar o endereço -->
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" value="<?php echo $usuario['endereco']; ?>" required>
    
                    <!-- Botão para enviar o formulário -->
                    <button type="submit">Atualizar Perfil</button>
                </form>
            </section>
            
            <!-- Link para voltar à página do perfil -->
            <div>
                <a href="perfil-cliente.php">Voltar para o perfil</a>
            </div>
        </div>
        <!-- Título da página -->
    </div>
</body>

</html>