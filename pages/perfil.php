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
     <title>Perfil</title>
</head>

<body>

     <h1>Olá,
          <?php echo $_SESSION["nome"]; ?>!
     </h1>


     <h2>Informações do usuário:</h2>
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

     <a href="editar-perfil.php">Editar Perfil</a>

</body>

</html>