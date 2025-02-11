<?php
// Inicia a sessão para acessar as variáveis de sessão
session_start();

// Verifica se o usuário está logado, checando a existência da variável de sessão 'id_cliente'
if (!isset($_SESSION['id_cliente'])) {
     // Se o usuário não estiver logado, exibe uma mensagem de erro e interrompe a execução do código
     echo "Você não está logado.";
     exit;  // Impede que o restante do código seja executado
}

// Definindo as configurações do banco de dados
$servername = "localhost";  // Servidor onde o banco de dados está hospedado
$username = "root";         // Usuário do banco de dados
$password = "usbw";         // Senha do banco de dados
$dbname = "dados";          // Nome do banco de dados

// Conecta ao banco de dados
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica se a conexão com o banco de dados foi bem-sucedida
if (!$conn) {
     // Caso a conexão falhe, exibe um erro e interrompe a execução
     die("Falha na conexao: " . mysqli_connect_error());
}

// Obtém o valor de 'id_situacao' da variável de sessão, que é o ID do profissional que o usuário está visualizando
$id_situacao = $_SESSION["id_situacao"];

// Faz uma consulta para obter os dados do profissional com o id especificado
$sql = "SELECT * FROM profissional WHERE id_profissional = '$id_situacao' ";
$result = $conn->query($sql);

// Verifica se o resultado da consulta retornou algum profissional
if ($result->num_rows > 0) {
     // Se encontrado, armazena os dados do profissional
     $row = $result->fetch_assoc();
     $id_cat = $row["id_categoria"];  // Obtém o ID da categoria associada ao profissional
     $descricao = $row["descricao"];  // Obtém a descrição do profissional
} else {
     // Se nenhum profissional for encontrado, exibe uma mensagem e fecha a conexão
     echo "Categoria não encontrada.";
     $conn->close();
     exit;
}

// Faz uma segunda consulta para obter o nome da categoria do profissional usando o id da categoria
$sql2 = "SELECT * FROM categoria WHERE id_categoria = '$id_cat'";
$result2 = $conn->query($sql2);

// Verifica se o resultado da consulta da categoria retornou algum dado
if ($result2->num_rows > 0) {
     // Se encontrado, armazena o nome da categoria
     $row2 = $result2->fetch_assoc();
     $nome_categoria = $row2["nome_categoria"];
} else {
     // Se a categoria não for encontrada, exibe uma mensagem e fecha a conexão
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
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <!-- Inclui o arquivo CSS para estilizar a página -->
     <link rel="stylesheet" href="../pages/css/styleperfil.css">
     <title>Perfil Cliente</title>
</head>

<body class="bg-info">
     <!-- Exibe uma saudação para o usuário, utilizando o nome armazenado na variável de sessão 'nome' -->
     <div>
          <h1>Olá,
               <?php echo $_SESSION["nome"]; ?>!
          </h1>
     </div>

     <!-- Seção onde são exibidas as informações do usuário -->
     <section class="fundo">

          <h2>Informações do usuário:</h2>

          <div class="lista">
               <ul class="ul">
                    <!-- Exibe as informações do usuário, como nome, email, endereço e as informações do profissional -->
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
                         <?php echo $descricao; ?> <!-- Exibe a descrição do profissional -->
                    </li>
                    <li>Categoria:
                         <?php echo $nome_categoria; ?> <!-- Exibe o nome da categoria do profissional -->
                    </li>
               </ul>
          </div>

     </section>

     <!-- Links para o usuário editar o perfil, fazer logout ou voltar à página inicial -->
     <div class="edit">
          <a href="caixa-entrada.php" class="text-dark">Caixa de Mensagens</a>
          <a href="editar-perfil-profissional.php" class="text-dark">Editar Perfil</a>
          <a href="logout.php" class="text-dark">Sair</a>
          <a href="../index.php" class="text-dark">Voltar para página inicial</a>
     </div>
     
</body>

</html>
