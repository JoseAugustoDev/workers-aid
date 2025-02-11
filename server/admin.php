<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
     echo "Access Denied.";
     exit();
}

$conn = new mysqli("localhost", "root", "usbw", "dados");

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

     <h2>Adicionar Categoria</h2>
     <form method="POST" action="/server/adicionar_categoria.php">
          <input type="text" name="nome_categoria" placeholder="Nome da Categoria" required>
          <button type="submit" name="adicionar">Adicionar categoria</button>
     </form>

     <h2>Deletar Categoria</h2>
     <form method="POST" action="/server/deletar_categoria.php">
          <select name="id_categoria">
               <?php
               $result = $conn->query("SELECT * FROM categoria");
               while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id_categoria']}'>{$row['nome_categoria']}</option>";
               }
               ?>
          </select>
          <button type="submit" name="deletar">Deletar Categoria</button>
     </form>
</body>

</html>