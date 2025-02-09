<!DOCTYPE html>
<html lang="pt-br">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Mensagens</title>
</head>

<body>
     <?php

     // Iniciando a sessão
     session_start();

     // Variáveis de conexão com o Banco de Dados
     $servername = "localhost";
     $username = "root";
     $password = "usbw";
     $dbname = "dados";

     $conn = mysqli_connect($servername, $username, $password, $dbname);

     if (!$conn) {
          die("Falha na conexao: " . mysqli_connect_error());
     }

     // Verificando se o usuário está autenticado na sessão
     if (!isset($_SESSION['id_cliente'])) {
          die("Sessão não iniciada ou usuário não autenticado.");
     }

     // Buscando todas as informações do usuário que está logado
     $sql = "SELECT * FROM mensagem WHERE id_cliente = '{$_SESSION['id_cliente']}'";

     // Executa a consulta no banco para obter informações do cliente
     $result_cliente = $conn->query($sql);

     // Verifica se o cliente foi encontrado
     if ($result_cliente->num_rows > 0) {
          while ($chat = $result_cliente->fetch_assoc()) {
          
               $_SESSION["mensagem"] = $chat["mensagem"];

               echo $_SESSION["mensagem"] . "<br>";
          }
          exit;
     }

     // Fecha a conexão com o banco de dados
     $conn->close();
     ?>

</body>

</html>