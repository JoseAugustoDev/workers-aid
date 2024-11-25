<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "dados";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
     die("Falha na conexão: " . mysqli_connect_error());
}

$nome = mysqli_real_escape_string($conn, $_POST["nome"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$senha = mysqli_real_escape_string($conn, $_POST["senha"]);
$confirma_senha = mysqli_real_escape_string($conn, $_POST["senha-confirma"]);
$endereco = mysqli_real_escape_string($conn, $_POST["endereco"]);
$voluntario = mysqli_real_escape_string($conn, isset($_POST["voluntario"]) ? 1 : 0);
$categoria = mysqli_real_escape_string($conn, $_POST["servicos"]);
$descricao = mysqli_real_escape_string($conn, $_POST["desc"]);

if (isset($_FILES['foto-perfil']) && $_FILES['foto-perfil']['error'] === UPLOAD_ERR_OK) {
     $uploadDir = 'uploads/';
     $fileName = basename($_FILES['foto-perfil']['name']);
     $filePath = $uploadDir . $fileName;

     if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0777, true);
     }

     if (!move_uploaded_file($_FILES['foto-perfil']['tmp_name'], $filePath)) {
          echo "Erro ao fazer upload do arquivo.";
          $conn->close();
          exit;
     }
} else {
     echo "Erro: Nenhum arquivo enviado ou problema no upload.";
     $conn->close();
     exit;
}

$sql = "SELECT id_categoria FROM categoria WHERE nome_categoria = '$categoria'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     $row = $result->fetch_assoc();
     $id_categoria = $row["id_categoria"];
} else {
     echo "Categoria não encontrada.";
     $conn->close();
     exit;
}

if ($confirma_senha === $senha) {

     $sql = "INSERT INTO profissional (voluntario, id_categoria, descricao) 
            VALUES ($voluntario, $id_categoria, '$descricao')";

     if ($conn->query($sql) === TRUE) {
          echo "Inserido com sucesso!";
          header("Location: /pages/login.html");

     } else {
          echo "Erro ao inserir no banco de dados: " . $conn->error;
     }
} else {
     echo "As senhas precisam ser iguais.";
}

$sql2 = "SELECT id_profissional FROM profissional WHERE descricao = '$descricao'";
$result2 = $conn->query($sql2);

if ($result->num_rows > 0) {
     $row = $result2->fetch_assoc();
     $id_profissional = $row["id_profissional"];

     $sql3 = "INSERT INTO clientes (nome, email, senha, endereco, id_situacao) VALUES ('$nome', '$email', '$senha', '$endereco', '$id_profissional')";

     if ($conn->query($sql3) === TRUE) {
          echo "Inserido com sucesso!";
          header("Location: /pages/login.html");
          
     } else {
          echo "Erro ao inserir no banco de dados: " . $conn->error;
     }
} else {
     echo "Categoria não encontrada.";
     $conn->close();
     exit;
}

$conn->close();
?>