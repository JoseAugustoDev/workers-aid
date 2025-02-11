<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_cliente'])) {
     header("Location: /pages/login.html");
     exit();
}

$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "dados";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
     die("Falha na conexão: " . $conn->connect_error);
}

$id_cliente = $_SESSION['id_cliente'];

?>

<!DOCTYPE html>
<html lang="pt">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <title>Caixa de Entrada</title>
</head>

<body class="bg-info p-3 mb-2 bg-primary text-white">
     <div class="container justify-content-center align-items-center w-50 p-3 text-center vh-100">

          <h1>Caixa de Entrada</h1>

          <table class="table">
               <tr>
                    <th scope="col">Remetente</th>
                    <th scope="col">Mensagem</th>
                    <th scope="col">Ação</th>
               </tr>

               <?php

               $get_profissional = "SELECT nome, id_situacao FROM clientes WHERE id_cliente = $id_cliente";
               $result_prof = $conn->query($get_profissional);

               if ($result_prof->num_rows > 0) {
                    while ($row = $result_prof->fetch_assoc()) {

                         $id_profissional = $row["id_situacao"];
                    }
               }

               // Consulta para buscar mensagens recebidas pelo cliente
               $sql = "SELECT * FROM mensagem WHERE id_profissional = $id_profissional";

               $result = $conn->query($sql);

               if (!$result) {
                    die("Erro na consulta SQL: " . $conn->error);
               }

               if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                         $id_remetente = $row["id_cliente"];

                         $sql_nome_remetente = "SELECT nome FROM clientes WHERE id_cliente = $id_remetente";
                         $result2 = $conn->query($sql_nome_remetente);

                         if ($result2->num_rows > 0) {
                              while ($row2 = $result2->fetch_assoc()) {
                                   $nome_remetente = $row2["nome"];

                              }

                         }

                         echo "<tr>
                              <td>" . $nome_remetente . "</td>
                              <td>" . substr($row['mensagem'], 0, 50) . "...</td>
                              <td><a href='visualizar-mensagem.php?id=" . $row['id_mensagem'] . "'>Abrir</a></td>
                         </tr>";
                    }
               } else {
                    echo "<tr><td colspan='3'>Nenhuma mensagem recebida.</td></tr>";
               }
               ?>
          </table>
     </div>

     <button class="btn btn-dark text-white float-right fixed-bottom">
          <a href="/server/perfil-profissional.php" class="color-light">Voltar</a>
     </button>
</body>

</html>

<?php
$conn->close();
?>