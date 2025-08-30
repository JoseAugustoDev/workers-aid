<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
     echo "Access Denied.";
     exit();
}

$conn = new mysqli("localhost", "root", "usbw", "capix_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (isset($_POST['add_category'])) {
          $category_name = $_POST['category_name'];
          $stmt = $conn->prepare("INSERT INTO categoria (nome_categoria) VALUES (?)");
          $stmt->bind_param("s", $category_name);
          $stmt->execute();
     }

     if (isset($_POST['delete_category'])) {
          $category_id = $_POST['category_id'];
          $stmt = $conn->prepare("DELETE FROM categoria WHERE id_categoria = ?");
          $stmt->bind_param("i", $category_id);
          $stmt->execute();
     }
}
?>

<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <title>Painel Admin</title>
</head>

<body class="bg-info p-3 mb-2 bg-primary text-white">
     <h1>Painel do Administrador</h1>
     <div class="container-fluid d-flex justify-content-center align-items-center flex-column w-100">

          <h2>Adicionar Categoria</h2>
          <form class="d-flex w-50 justify-content-center align-items-center m-2" method="POST"
               action="/server/adicionar_categoria.php">
               <input class="form-control container-center m-2" type="text" name="nome_categoria"
                    placeholder="Nome da Categoria" required>
               <button class="btn btn-submit" type="submit" name="adicionar">Adicionar categoria</button>
          </form>

          <h2>Deletar Categoria</h2>
          <form class="d-flex w-50 justify-content-center align-items-center m-2" method="POST"
               action="/server/deletar_categoria.php">
               <select name="id_categoria" class="form-control container-center m-2">
                    <?php
                    $result = $conn->query("SELECT * FROM categoria");
                    while ($row = $result->fetch_assoc()) {
                         echo "<option value='{$row['id_categoria']}'>{$row['nome_categoria']}</option>";
                    }
                    ?>
               </select>
               <button class="btn btn-submit" type="submit" name="deletar">Deletar Categoria</button>
          </form>
     </div>

     <div class="container-fluid m-0">
          <h1>Feedback dos Usuários</h1>
          <ul class="d-flex align-items-center justify-content-around flex-column w-50 m-3">

               <?php
               $sql = "SELECT * FROM feedback fb
                    JOIN clientes on fb.id_cliente = clientes.id_cliente";

               $resultado = $conn->query($sql);
               while ($row2 = $resultado->fetch_assoc()) {
                    echo "<li class='p-3 list-group-item border border-dark rounded text-dark w-100 m-2'>
                         Nome: " . $row2["nome"] . " <br>
                         Comentário: " . $row2["comentario"] . "<br>
                         Nota:" . $row2["nota"] . "⭐ <br>
                    </li>";
               }
               ?>
          </ul>
     </div>
</body>

</html>