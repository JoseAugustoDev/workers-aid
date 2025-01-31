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

// Verificando se o usuário está autenticado na sessão
if (!isset($_SESSION['id_cliente'])) {
    die("Sessão não iniciada ou usuário não autenticado.");
}

// Buscando todas as informações do usuário que está logado
$sql = "SELECT * FROM clientes WHERE id_cliente = '{$_SESSION['id_cliente']}'";

// Executa a consulta no banco para obter informações do cliente
$result_cliente = $conn->query($sql);
$result_profissional = $conn->query($sql2);

// Verifica se o cliente foi encontrado
if ($result_cliente->num_rows > 0) {
    $usuario = $result_cliente->fetch_assoc(); // Obtém os dados do usuário em formato associativo

    // Armazena as informações do usuário na sessão para usá-las posteriormente
    $_SESSION["id_cliente"] = $usuario["id_cliente"];
    $_SESSION["nome"] = $usuario["nome"];
    $_SESSION["email"] = $usuario["email"];
    $_SESSION["senha"] = $usuario["senha"];
    $_SESSION["endereco"] = $usuario["endereco"];
    $_SESSION["id_situacao"] = $usuario["id_situacao"];

    // Verificando se o usuário é profissional
    if ($_SESSION["id_situacao"] != 0) {
        // No usário profissional o campo id_situação é o mesmo do id_profissional. Logo, se for diferente de 0 signfica que o usuario é um profissional
        header("Location: /server/perfil-profissional.php");
        
    }  else {
        // No usário comum o campo id_situacao é sempre 0
        header("Location: /server/perfil-cliente.php");

    }

    exit;

} else {
    echo "Usuário não encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>