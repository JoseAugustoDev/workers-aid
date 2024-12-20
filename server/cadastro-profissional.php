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
          $id_profissional = $conn->insert_id;

          foreach ($categorias as $categoria) {
               $sql_categoria = "SELECT id_categoria FROM categoria WHERE nome_categoria = '$categoria'";
               $result_categoria = $conn->query($sql_categoria);
     } 
     if ($result_categoria->num_rows > 0) {
                $row_categoria = $result_categoria->fetch_assoc();
                $id_categoria = $row_categoria["id_categoria"];

                $sql_relacao = "INSERT INTO profissional_categoria (id_profissional, id_categoria) VALUES ($id_profissional, $id_categoria)";
                if (!$conn->query($sql_relacao)) {
                    echo "Erro ao associar categoria: " . $conn->error;
                }
            } else {
                echo "Categoria não encontrada: $categoria";
            }
        }

        echo "Profissional inserido com sucesso!";
        header("Location: /pages/login.html");
          else {
          echo "Erro ao inserir no banco de dados: " . $conn->error;
     }
} else {
          echo "As senhas precisam ser iguais.";
}

$conn->close();
?>