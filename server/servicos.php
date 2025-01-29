<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link para o arquivo CSS de estilo -->
    <link rel="stylesheet" href="../pages/css/style.css">
    <title>Serviços</title>
</head>

<body>

    <div class="tela_servico">

        <!-- Cabeçalho com a logo e menu -->
        <header>

            <!-- Logo do site -->
            <div class="logo">
                <img src="../pages/imgs/Logo.jpg" id="logo" alt="Logo">
            </div>

            <!-- Menu suspenso com links de navegação -->
            <nav class="menu_suspenso">
                <ul>
                    <!-- Itens do menu -->
                    <li class="li">
                        <a href="../pages/login.html">Login</a>
                    </li>
                    <li class="li">
                        <a href="../pages/tipo-usuario.html">Cadastro</a>
                    </li>
                    <li class="li">
                        <a href="../pages/quemsomos.html">Quem somos</a>
                    </li>
                </ul>
            </nav>

            <?php 
                // Verifica se o usuário está logado (checa a variável de sessão)
                if (isset($_SESSION['id_cliente'])) {
                    // Se o usuário estiver logado, mostra o botão para acessar o perfil
                    echo "<form action='/server/perfil.php' method='GET'>
                            <button type='submit'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='currentColor'
                                    class='bi bi-person-circle' viewBox='0 0 16 16'>
                                    <path d='M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0' />
                                    <path fill-rule='evenodd'
                                        d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1' />
                                </svg>
                            </button>
                        </form>
                        ";
                } else {
                    // Caso contrário, exibe o ícone que leva à página de login
                    echo "<a href='/pages/login.html'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='currentColor'
                                class='bi bi-person-circle' viewBox='0 0 16 16'>
                                <path d='M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0' />
                                <path fill-rule='evenodd'
                                    d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1' />
                            </svg>
                        </a>
                    ";
                }
                ?>
        </header>

        <!-- Seção principal de conteúdo onde os serviços serão listados -->
        <section>

            <?php

            // Variáveis para a conexão com o banco de dados
            $servername = "localhost";
            $username = "root";
            $password = "usbw";
            $dbname = "dados";

            // Estabelece a conexão com o banco de dados
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verifica se houve erro na conexão
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);  // Encerra o script caso haja erro na conexão
            }

            // Obtém o id da categoria da URL
            $id_cat = $_GET['id'];

            // Consulta para pegar o nome da categoria com o id fornecido
            $categoria = "SELECT nome_categoria FROM categoria WHERE id_categoria = $id_cat";
            $resultado = $conn->query($categoria);

            // Verifica se a categoria foi encontrada e obtém o nome da categoria
            if ($resultado->num_rows > 0) {
                $cate = $resultado->fetch_assoc();
                $nome_categoria = $cate["nome_categoria"];
            }

            // Exibe o nome da categoria na página
            echo "<h1> Precisando de um profissional em $nome_categoria? Veja nossos profissionais destaques em $nome_categoria  </h1>";

            echo "<div class='info-de-perfil'>";
            echo "<ul>";

            // Consulta para obter todos os profissionais da categoria selecionada
            $sql = "SELECT * FROM profissional WHERE id_categoria = $id_cat";
            $result = $conn->query($sql);

            // Verifica se há profissionais na categoria
            if ($result->num_rows > 0) {

                // Itera sobre todos os profissionais encontrados
                while ($row = $result->fetch_assoc()) {

                    // Obtém o id do profissional
                    $id_profissional = $row["id_profissional"];

                    // Verifica se o profissional oferece trabalho voluntário ou não
                    $voluntario = "Fornece trabalho voluntário!";
                    if ($row["voluntario"] != 1) {
                        $voluntario = "Não fornece trabalho voluntário!";
                    }

                    // Consulta para obter as informações do cliente (usuário) associado ao profissional
                    $sql2 = "SELECT * FROM clientes WHERE id_situacao = $id_profissional";
                    $result2 = $conn->query($sql2);

                    // Verifica se encontrou o cliente/profissional
                    if ($result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        $foto = $row2["foto_perfil"];  // Obtém a foto de perfil do profissional
                    } else {
                        // Se o profissional não for encontrado, exibe uma mensagem de erro e fecha a conexão
                        echo "Profissional não encontrado.";
                        $conn->close();
                        exit;
                    }

                    // Exibe as informações de cada profissional da categoria
                    echo "<li>
                                <div class='img-perfil'>
                                    <img id='foto-servico' src='$foto' alt='imagem_de_perfil'>
                                </div>
                                <div class='prof-info'>
                                    <p class='nome'>" . $row2['nome'] . "</p>  <!-- Nome do profissional -->
                                    <p class='email'>" . $row2['email'] . "</p> <!-- Email do profissional -->
                                    <p class='descricao'>" . $row['descricao'] . "</p> <!-- Descrição do serviço -->
                                    <p>" . $voluntario . "</p>  <!-- Informações sobre trabalho voluntário -->
                                </div>
                            </li>";
                }
            } else {
                // Caso não haja profissionais, exibe uma mensagem de "não há nada"
                echo "Não há nada";
            }
            ?>
            </ul>
        </div>
    </section>

</body>

</html>
