<?php
// Iniciando a sessão para manter o estado do usuário
session_start();

// Variáveis de conexão com o banco de dados
$servername = "localhost"; // Endereço do servidor
$username = "root";        // Nome de usuário do banco de dados
$password = "usbw";        // Senha do banco de dados
$dbname = "dados";         // Nome do banco de dados

// Conectando ao banco de dados
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificando se a conexão foi bem-sucedida
if (!$conn) {
     die("Falha na conexão: " . mysqli_connect_error()); // Encerra o script e exibe o erro de conexão
}

// Pegando os valores do formulário via POST e protegendo contra injeção SQL
$nome = mysqli_real_escape_string($conn, $_POST["nome"]); // Nome do usuário
$email = mysqli_real_escape_string($conn, $_POST["email"]); // E-mail do usuário
$senha = mysqli_real_escape_string($conn, $_POST["senha"]); // Senha do usuário
$confirma_senha = mysqli_real_escape_string($conn, $_POST["senha-confirma"]); // Confirmação da senha
$endereco = mysqli_real_escape_string($conn, $_POST["endereco"]); // Endereço do usuário
$voluntario = mysqli_real_escape_string($conn, isset($_POST["voluntario"]) ? 1 : 0); // Verifica se o usuário é voluntário
$categoria = mysqli_real_escape_string($conn, $_POST["servicos"]); // Categoria de serviço escolhida
$descricao = mysqli_real_escape_string($conn, $_POST["desc"]); // Descrição do profissional

// Adicionando foto de perfil e salvando na pasta 'uploads'
if (isset($_FILES['foto-perfil']) && $_FILES['foto-perfil']['error'] === UPLOAD_ERR_OK) {
     $uploadDir = 'uploads/'; // Diretório onde a foto será salva
     $fileName = basename($_FILES['foto-perfil']['name']); // Nome do arquivo
     $filePath = $uploadDir . $fileName; // Caminho completo do arquivo

     // Verifica se o diretório existe, caso contrário, cria o diretório
     if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0777, true);
     }

     // Move o arquivo para o diretório de uploads
     if (!move_uploaded_file($_FILES['foto-perfil']['tmp_name'], $filePath)) {
          echo "Erro ao fazer upload do arquivo."; // Exibe erro se o upload falhar
          $conn->close(); // Fecha a conexão com o banco de dados
          exit; // Encerra o script
     }
} else {
     echo "Erro: Nenhum arquivo enviado ou problema no upload."; // Exibe erro se não houver arquivo ou problema no upload
     $conn->close(); // Fecha a conexão com o banco de dados
     exit; // Encerra o script
}

// Selecionando o ID da categoria escolhida pelo profissional
$sql = "SELECT id_categoria FROM categoria WHERE nome_categoria = '$categoria'";
$result = $conn->query($sql);

// Verifica se a categoria foi encontrada
if ($result->num_rows > 0) {
     $row = $result->fetch_assoc(); 
     $id_categoria = $row["id_categoria"]; 
} else {
     echo "Categoria não encontrada."; // Exibe erro se a categoria não for encontrada
     $conn->close(); // Fecha a conexão com o banco de dados
     exit; 
}

// Verifica se as senhas coincidem
if ($confirma_senha === $senha) {
     // Insere os dados do profissional na tabela 'profissional'
     $sql = "INSERT INTO profissional (voluntario, id_categoria, descricao, foto_perfil) 
            VALUES ($voluntario, $id_categoria, '$descricao', '$filePath')";

     // Executa a query e verifica se foi bem-sucedida
     if ($conn->query($sql) === TRUE) {
          echo "Inserido com sucesso!";
          header("Location: /pages/login.html"); 
     } else {
          echo "Erro ao inserir no banco de dados: " . $conn->error; 
     }
} else {
     echo "As senhas precisam ser iguais."; // Exibe erro se as senhas não coincidirem
}

// Busca o ID do profissional que acabou de ser inserido
$sql2 = "SELECT id_profissional FROM profissional WHERE descricao = '$descricao'";
$result2 = $conn->query($sql2);

// Verifica se o ID do profissional foi encontrado
if ($result2->num_rows > 0) {
     $row = $result2->fetch_assoc(); // Obtém a linha do resultado
     $id_profissional = $row["id_profissional"]; // Armazena o ID do profissional

     // Insere os dados do cliente na tabela 'clientes'
     $sql3 = "INSERT INTO clientes (nome, email, senha, endereco, foto_perfil, id_situacao) 
              VALUES ('$nome', '$email', '$senha', '$endereco', '$filePath', '$id_profissional')";

     // Executa a query e verifica se foi bem-sucedida
     if ($conn->query($sql3) === TRUE) {
          echo "Inserido com sucesso!"; // Mensagem de sucesso
          header("Location: /pages/login.html"); // Redireciona para a página de login
     } else {
          echo "Erro ao inserir no banco de dados: " . $conn->error; // Exibe erro se a inserção falhar
     }
} else {
     echo "Categoria não encontrada."; // Exibe erro se o ID do profissional não for encontrado
     $conn->close(); // Fecha a conexão com o banco de dados
     exit; // Encerra o script
}

// Fecha a conexão com o banco de dados
$conn->close();
?>