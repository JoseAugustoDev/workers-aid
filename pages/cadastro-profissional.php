<!DOCTYPE html>
<html lang="pt-br">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <title>Cadastro de Profissional</title>
</head>

<body class="bg-info p-3 mb-2 bg-primary text-white">
     <div class="container justify-content-center align-items-center w-50 p-3 text-center vh-100 ">

          <h1>Cadastro de Profissional</h1>
          <div class="d-flex justify-content-center align-items-center flex-column">
               <form class="d-flex justify-content-center align-items-center flex-column" action="/server/cadastro-profissional.php" method="POST" enctype="multipart/form-data">
                    <!-- Campo Nome -->
                    <label for="text">Nome:</label>
                    <input class="form-control container-center" type="text" name="nome" required>

                    <!-- Campo Email -->
                    <label for="email">Email:</label>
                    <input class="form-control container-center" type="email" name="email" required>

                    <!-- Campo Senha -->
                    <label for="senha">Senha:</label>
                    <input class="form-control container-center" type="password" name="senha" required>

                    <!-- Campo Confirmar Senha -->
                    <label for="senha-confirma">Confirme a Senha:</label>
                    <input class="form-control container-center" type="password" name="senha-confirma" required>

                    <!-- Campo Endereço -->
                    <label for="endereco">Endereço:</label>
                    <input class="form-control container-center" type="text" name="endereco" required>

                    <!-- Campo Voluntário (Checkbox) -->
                    <label for="voluntario">Gostaria de oferecer Trabalho Voluntário:
                         <input class="m-2" type="checkbox" name="voluntario">
                    </label>

                    <!-- Seletor de Categoria de Serviços -->
                    <select name="servicos" class="form-control container-center" id="categoria-servicos" required>
                         <option value="">Selecione uma Categoria: </option>
                         <?php
                         $servername = "localhost";
                         $username = "root";
                         $password = "usbw";
                         $dbname = "dados";


                         $conn = new mysqli($servername, $username, $password, $dbname);

                         if ($conn->connect_error) {
                              die("Conexão falhou: " . $conn->connect_error);
                         }

                         $sql = "SELECT id_categoria, nome_categoria FROM categoria";
                         $result = $conn->query($sql);

                         if ($result->num_rows > 0) {

                              while ($row = $result->fetch_assoc()) {
                                   $categoria = $row["nome_categoria"];
                                   echo "<option value='$categoria'>" . $categoria . "</option>";
                              }
                         } else {
                              echo "Não há nada";
                         }
                         ?>
                    </select>

                    <!-- Campo de Descrição do Profissional -->
                    <textarea name="desc" class="form-control container-center m-2" id="descricao" cols="30" rows="10">Forneça uma breve descrição</textarea>

                    <!-- Campo para Foto de Perfil -->
                    <label for="foto-perfil">Adicionar Foto de Perfil:
                         <input class="form-control container-center" type="file" name="foto-perfil" id="foto-perfil">
                    </label>

                    <!-- Botão de envio -->
                    <button class="btn btn-primary w-25 p-2 align-text-bottom mt-3" type="submit">Cadastrar</button>
               </form>

          </div>
</body>

</html>