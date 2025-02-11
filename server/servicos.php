<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link para o arquivo CSS de estilo -->
     <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/script.js" defer></script>
    <title>Serviços</title>
</head>

<body class="bg-info">

    <div class="tela_servico">

        <!-- Cabeçalho com a logo e menu -->
        <header class="d-flex justify-content-between align-items-center w-100 p-3 border-bottom vh-25">
            <!-- Seção de Cabeçalho (Logo e Menu de Navegação) -->
            <nav class="navbar navbar-expand-lg navbar-light w-100">
                <div class="container-fluid d-flex justify-content-center align-items-center w-100">

                    <div class="navbar-brand">
                        <a href="../index.php">
                            <img width="125px" height="125px" class="rounded-circle" src="/pages/imgs/Logo.jpg" id="logo" alt="Logo">
                        </a>
                    </div>

                    <!-- Barra de Navegação -->
                    <ul class="navbar-nav d-flex align-items-center justify-content-evenly list-group-horizontal collapse navbar-collapse w-50">
                        <!-- Links de navegação para diferentes páginas do site -->
                        <li class="nav-item list-group-item rounded border border-dark">
                            <a class="text-decoration-none" href="/pages/login.html">Login</a>
                        </li>
                        <li class="nav-item list-group-item rounded border border-dark">
                            <a class="text-decoration-none" href="/pages/tipo-usuario.html">Cadastro</a>
                        </li>
                        <li class="nav-item list-group-item rounded border border-dark">
                            <a class="text-decoration-none" href="/pages/quemsomos.html">Quem somos</a>
                        </li>
                    </ul>
                    <!-- Fim da barra de navegação -->

                    <!-- Seção de Perfil do Usuário -->
                    <div class="perfil">
                        <?php
                        session_start();

                        if (isset($_SESSION['id_cliente'])) {
                            echo "<form action='/server/perfil.php' method='GET' class='d-flex justify-content-center align-items-center w-100'>
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
                            echo "<a href='/pages/login.html' class='d-flex justify-content-center align-items-center w-100'>
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
                    </div>
        
                </div>
            </nav>
        </header>

        <!-- Seção principal de conteúdo onde os serviços serão listados -->
        <section class="d-flex justify-content-center align-items-center flex-column mt-5 p-4">

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
            echo "<h1> Veja nossos profissionais destaques em $nome_categoria  </h1>";

            echo "<div class='container'>";
            echo "<ul class='d-flex align-items-center justify-content-around flex-column w-100 m-3'>";

            // Consulta para obter todos os profissionais da categoria selecionada
            $sql = "SELECT * FROM profissional WHERE id_categoria = $id_cat";
            $result = $conn->query($sql);

            // Verifica se há profissionais na categoria
            if ($result->num_rows > 0) {

                // Itera sobre todos os profissionais encontrados
                while ($row = $result->fetch_assoc()) {

                    // Obtém o id do profissional
                    $id_profissional = $row["id_profissional"];

                    $sqlMedia = "SELECT AVG(nota) as media FROM avaliacao WHERE id_profissional = $id_profissional";
                    $resultMedia = $conn->query($sqlMedia);

                    // Verifica se a consulta foi bem-sucedida e se retornou um valor válido
                    if ($resultMedia && $rowMedia = $resultMedia->fetch_assoc()) {
                        $media = $rowMedia['media'] !== null ? round($rowMedia['media'], 1) : "Sem avaliações";
                    } else {
                        $media = "Sem avaliações"; // Caso não haja avaliações ou a consulta falhe
                    }


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
                        $foto = $row2["foto_perfil"]; // Obtém a foto de perfil do profissional
                        $nome = $row2["nome"];
                    } else {
                        // Se o profissional não for encontrado, exibe uma mensagem de erro e fecha a conexão
                        echo "Profissional não encontrado.";
                        $conn->close();
                        exit;
                    }


                    // Exibe as informações de cada profissional da categoria
                    echo "<li class='d-flex justify-content-between align-items-center p-3 m-3 list-group-item border border-dark w-100 rounded'>
                            <div class='img-perfil'>
                                <img id='foto-servico' src='$foto' alt='imagem_de_perfil'>
                            </div>
                            <div class='prof-info'>
                                <p class='nome'>" . $row2['nome'] . "</p>  <!-- Nome do profissional -->
                                <p class='email'>" . $row2['email'] . "</p> <!-- Email do profissional -->
                                <p class='descricao'>" . $row['descricao'] . "</p> <!-- Descrição do serviço -->
                                <p class='avaliacao'> Avaliação média: " . ($media !== "Sem avaliações" ? $media . " ⭐" : "Sem avaliações") . "</p>

                                <p>" . $voluntario . "</p>  <!-- Informações sobre trabalho voluntário -->
                            </div>
                            <div class='d-flex flex-column'>
                                <button class='m-1' onClick='abrirModal($id_profissional)'>Avaliar</button>
                                <button class='m-1' onClick='abrirModalMensagem($id_profissional)'>Enviar Mensagem</button>
                            </div>
                           </li>";

                    echo "<dialog class='modal-avl justify-content-center align-items-center flex-column w-50 rounded-3' id='modalAvaliacao_$id_profissional' style='display: none;'>
                                <div class='w-100 d-flex justify-content-center align-items-center flex-column'>
                                    <p class='m-2'><b>Qual a sua avaliação para $nome?</b></p>

                                    <label for='nota_$id_profissional'>Nota (1 a 5):</label>
                                    <input class='m-2' type='number' name='nota' id='nota_$id_profissional' min='1' max='5' required>

                                    <textarea class='w-50 p-3 m-1' name='comentarios' id='comentario_$id_profissional' rows='5' placeholder='Deixe seu comentário!'></textarea>

                                    <button class='rounded bold p-3 w-50 m-1' type='submit' onClick='enviarAvaliacao($id_profissional)'>Enviar</button>
                                    <button class='rounded bold p-3 w-50 m-1' type='button' onClick='fecharModal($id_profissional)'>Fechar</button>
                                </div>
                        </dialog>";

                    echo "<dialog class='modal-avl justify-content-center align-items-center flex-column w-50 rounded-3' id='modalMensagem_$id_profissional' style='display: none;'>
                                <p><b>Escreva sua mensagem para $nome:</b></p>
                                <textarea class='w-50 p-3 m-1' id='mensagem_$id_profissional' rows='5' placeholder='Digite sua mensagem...'></textarea>
                                <button class='rounded bold p-3 w-50 m-1' type='submit' onClick='enviarMensagem($id_profissional)'>Enviar</button>
                                <button class='rounded bold p-3 w-50 m-1' type='button' onClick='fecharModalMensagem($id_profissional)'>Fechar</button>
                            </dialog>";


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