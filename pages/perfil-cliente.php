<?php
session_start();

if (!isset($_SESSION['id_cliente'])) {
     echo "Você não está logado.";
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

     <div>
          <h1>Olá,
               <?php echo $_SESSION["nome"]; ?>!
          </h1>
     </div>

     <section class="fundo">

          <h2>Informações do usuário:</h2>

          <div class="lista">
               <ul>
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

     <div class="edit">
          <a href="editar-perfil-cliente.php">Editar Perfil</a>
          <a href="/server/logout.php">Sair</a>
          <a href="../index.php">Voltar para página inicial</a>
     </div>

</body>

</html>