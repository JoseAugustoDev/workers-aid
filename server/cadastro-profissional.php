<?php
// Iniciando a sessão
session_start();

// Variáveis de conexão com o banco
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "dados";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
     die("Falha na conexão: " . mysqli_connect_error());
}

// Pegando os valores do formulário via POST e fazendo a proteção contra injeção SQL
$nome = mysqli_real_escape_string($conn, $_POST["nome"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$senha = mysqli_real_escape_string($conn, $_POST["senha"]);
$confirma_senha = mysqli_real_escape_string($conn, $_POST["senha-confirma"]);
$endereco = mysqli_real_escape_string($conn, $_POST["endereco"]);
$voluntario = mysqli_real_escape_string($conn, isset($_POST["voluntario"]) ? 1 : 0);
$categoria = mysqli_real_escape_string($conn, $_POST["servicos"]);
$descricao = mysqli_real_escape_string($conn, $_POST["desc"]);

// Adicionando foto de perfil e salvando na pasta 'uploads'
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

// Selecionando as categorias para o profissional poder escolher, por enquanto só pode 1 categoria por profissional
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

// Se a senha for igual, vai criar um usuario comum, com acesso a funcionalidades de um profissional
if ($confirma_senha === $senha) {

     $sql = "INSERT INTO profissional (voluntario, id_categoria, descricao, foto_perfil) 
            VALUES ($voluntario, $id_categoria, '$descricao', '$filePath')";

     if ($conn->query($sql) === TRUE) {
          echo "Inserido com sucesso!";
          header("Location: /pages/login.html");

     } else {
          echo "Erro ao inserir no banco de dados: " . $conn->error;
     }
} else {
     echo "As senhas precisam ser iguais.";
}

// Buscando o ID do profissional que acabou de ser inserido
$sql2 = "SELECT id_profissional FROM profissional WHERE descricao = '$descricao'";
$result2 = $conn->query($sql2);

// Verificando se o ID do profissional foi encontrado
if ($result->num_rows > 0) {
     $row = $result2->fetch_assoc();
     $id_profissional = $row["id_profissional"];

     $sql3 = "INSERT INTO clientes (nome, email, senha, endereco, foto_perfil, id_situacao) VALUES ('$nome', '$email', '$senha', '$endereco', '$filePath', '$id_profissional')";

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

// Fecha a conexão com o banco de dados
$conn->close();
?>