<!DOCTYPE html>
<html lang="pt-br">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/style.css">
     <title>Cadastro de Profissional</title>
</head>

<body>
     <div class="container">
          <img src="imgs/logo.jpg" alt="Logo">
          <section>
               <h1>Cadastro de Profissional</h1>
               <div class="cadastro">
                    <form action="/server/cadastro-profissional.php" method="POST" enctype="multipart/form-data">
                         <!-- Campo Nome -->
                         <label for="text">Nome:</label>
                         <input type="text" name="nome" required>

                         <!-- Campo Email -->
                         <label for="email">Email:</label>
                         <input type="email" name="email" required>

                         <!-- Campo Senha -->
                         <label for="senha">Senha:</label>
                         <input type="password" name="senha" required>

                         <!-- Campo Confirmar Senha -->
                         <label for="senha-confirma">Confirme a Senha:</label>
                         <input type="password" name="senha-confirma" required>

                         <!-- Campo Endereço -->
                         <label for="endereco">Endereço:</label>
                         <input type="text" name="endereco" required>

                         <!-- Campo Voluntário (Checkbox) -->
                         <label for="voluntario">Gostaria de oferecer Trabalho Voluntário:
                              <input type="checkbox" name="voluntario">
                         </label>

                         <!-- Seletor de Categoria de Serviços -->
                         <select name="servicos" id="categoria-servicos" required>
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
                                        echo "<option value='$categoria'>" . $row["nome_categoria"] . "</option>";
                                   }
                              } else {
                                   echo "Não há nada";
                              }
                              ?>
                         </select>

                         <!-- Campo de Descrição do Profissional -->
                         <textarea name="desc" id="descricao" cols="30" rows="10">Forneça uma breve descrição</textarea>

                         <!-- Campo para Foto de Perfil -->
                         <label for="foto-perfil">Adicionar Foto de Perfil:
                              <input type="file" name="foto-perfil" id="foto-perfil">
                         </label>

                         <!-- Botão de envio -->
                         <button type="submit">Cadastrar</button>
                    </form>
          </section>
     </div>
</body>

</html>