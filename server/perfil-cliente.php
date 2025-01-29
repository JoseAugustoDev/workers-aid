<?php
// Inicia a sessão do PHP, permitindo acessar variáveis de sessão
session_start();

// Verifica se o usuário está logado, ou seja, se a variável de sessão 'id_cliente' está definida
if (!isset($_SESSION['id_cliente'])) {
     // Caso não esteja logado, exibe uma mensagem e encerra a execução do script
     echo "Você não está logado.";
     exit;  // Impede que o restante do código seja executado
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
     <!-- Define o tipo de codificação de caracteres como UTF-8 -->
     <meta charset="UTF-8">
     <!-- Define a escala do viewport para dispositivos móveis -->
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Inclui a folha de estilo externa para a página -->
     <link rel="stylesheet" href="../pages/css/styleperfil.css">
     <!-- Define o título da página exibido na aba do navegador -->
     <title>Perfil Cliente</title>
</head>

<body>

     <!-- Exibe uma saudação com o nome do usuário, recuperado da variável de sessão 'nome' -->
     <div>
          <h1>Olá,
               <?php echo $_SESSION["nome"]; ?>!
          </h1>
     </div>

     <!-- Seção que contém as informações do usuário -->
     <section class="fundo">
          <h2>Informações do usuário:</h2>

          <div class="lista">
               <ul>
                    <!-- Exibe o nome, email e endereço do usuário a partir das variáveis de sessão -->
                    <li>Nome:
                         <?php echo $_SESSION["nome"]; ?>
                    </li>
                    <li>Email:
                         <?php echo $_SESSION["email"]; ?>
                    </li>
                    <li>Endereço:
                         <?php echo $_SESSION["endereco"]; ?>
                    </li>
               </ul>
          </div>
     </section>

     <!-- Links para editar o perfil, fazer logout ou voltar para a página inicial -->
     <div class="edit">
          <a href="editar-perfil-cliente.php">Editar Perfil</a>
          <a href="logout.php">Sair</a>
          <a href="../index.php">Voltar para página inicial</a>
     </div>

</body>

</html>
