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
     die("Falha na conexao: " . mysqli_connect_error());
}

$id_situacao = $_SESSION["id_situacao"];

$sql = "SELECT * FROM profissional WHERE id_profissional = '$id_situacao' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     $row = $result->fetch_assoc();
     $id_cat = $row["id_categoria"];
     $descricao = $row["descricao"];

} else {
     echo "Categoria não encontrada.";
     $conn->close();
     exit;
}

$sql2 = "SELECT * FROM categoria WHERE id_categoria = '$id_cat'";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
     $row2 = $result2->fetch_assoc();
     $nome_categoria = $row2["nome_categoria"];

} else {
     echo "Categoria não encontrada.";
     $conn->close();
     exit;
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/styleperfil.css">
     <title>Perfil Cliente</title>
</head>

<body>
     <section class="fundo">
          <div>
               <h1>Olá,
                    <?php echo $_SESSION["nome"]; ?>!
               </h1>

               <h3>Informações do usuário:</h3>
          </div>

          <div class="lista">
               <ul class="ul">
                    <li>Nome:
                         <?php echo $_SESSION["nome"]; ?>
                    </li>
                    <li>Email:
                         <?php echo $_SESSION["email"]; ?>
                    </li>
                    <li>Endereço:
                         <?php echo $_SESSION["endereco"]; ?>
                    </li>
                    <li>Descrição:
                         <?php echo $descricao; ?>
                    </li>
                    <li>Categoria:
                         <?php echo $nome_categoria; ?>
                    </li>
               </ul>
          </div>

     </section>

     <div>
          <a href="editar-perfil-profissional.php">Editar Perfil</a>
     </div>

     <div>
          <a href="/server/logout.php">Sair</a>
     </div>

</body>

</html>