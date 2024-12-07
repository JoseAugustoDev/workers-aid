<?php
session_start();

if (!isset($_SESSION['id_cliente'])) {
    echo "Você não está logado.";
    exit;
}


$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "dados";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}


$id_cliente = $_SESSION['id_cliente'];
$sql = "SELECT * FROM clientes WHERE id_cliente = '$id_cliente'";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    $usuario = mysqli_fetch_assoc($result);
} else {
    echo "Erro ao buscar dados do usuário.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $novo_email = mysqli_real_escape_string($conn, $_POST['email']);
    $novo_endereco = mysqli_real_escape_string($conn, $_POST['endereco']);

    $update_sql = "UPDATE clientes SET nome = '$novo_nome', email = '$novo_email', endereco = '$novo_endereco' WHERE id_cliente = '$id_cliente'";

    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['nome'] = $novo_nome;
        $_SESSION['email'] = $novo_email;
        $_SESSION['endereco'] = $novo_endereco;
        echo "Perfil atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar perfil: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="css/styleeditarperfil.css">

</head>

<body>   

    <h1>Editar perfil:</h1>

    <section>

        <img id="imglogin" src="imgs/logo.jpg" alt="Logo"> 

        <form action="editar-perfil-cliente.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>" required>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="<?php echo $usuario['endereco']; ?>" required>

            <button type="submit">Atualizar Perfil</button>
        </form>

    </section>

    <div>
        <a href="perfil-cliente.php">Voltar para o perfil</a>
    </div>

</body>

</html>