<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pages/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Workers Aid</title>
</head>

<body>
    <div class="container-fluid bg-info min-vh-100">
        <header class="d-flex justify-content-between align-items-center w-100 p-3 border-bottom vh-25">
            <!-- Seção de Cabeçalho (Logo e Menu de Navegação) -->
            <nav class="navbar navbar-expand-lg navbar-light w-100">
                <div class="container-fluid d-flex justify-content-center align-items-center w-100">

                    <div class="navbar-brand">
                        <img width="125px" height="125px" class="rounded-circle" src="/pages/imgs/Logo.jpg" id="logo" alt="Logo">
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
        <!-- Fim do cabeçalho -->

        <section class="w-100 d-flex justify-content-center align-items-center vh-50">
            <form method="POST" action="/server/pesquisar.php" id="buscar"
                class="w-100 h-10 p-3 m-3 input-group d-flex justify-content-center">
                <input type="text" class="input-group-text w-50 bg-white p-3" id="buscador" name="buscador"
                    placeholder="Buscar por categoria"> <!-- Campo de texto para busca -->

                <button class="btn btn-outline-dark" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
            </form>
        </section>
        <!-- Seção de Busca -->

        <!-- Seção de Imagem Principal e Texto -->
        <section>
            <div class="container-fluid d-flex justify-content-center align-items-center flex-column p-2">
                
                <div class="d-flex align-items-center justify-content-center w-100 p-2 flex-column m-4">
                    <h1>Categorias</h1>
                    <!-- Categorias de serviços poderiam ser listadas aqui -->
                    <ul class="d-flex align-items-center justify-content-around w-50 m-3">
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
                                echo " <li class='p-3 list-group-item border border-dark rounded'> <a href='/server/servicos.php?id={$row['id_categoria']}' class='text-decoration-none'>" . $row["nome_categoria"] . "</a></li>";
                            }
                        } else {
                            echo "Não há nada";
                        }
                        ?>
                    </ul>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column m-4">
                    <h1>Profissionais que realizam trabalho voluntário</h1>

                    <ul class="d-flex align-items-center justify-content-between list-group-horizontal">

                        <?php

                        // Conectar ao banco de dados
                        $servername = "localhost";
                        $username = "root";
                        $password = "usbw";
                        $dbname = "dados";


                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Erro na conexão: " . $conn->connect_error);
                        }

                        $sql = "SELECT p.id_profissional, c.nome, p.descricao, p.id_categoria, p.avaliacao
                    FROM profissional p
                    JOIN clientes c ON c.id_situacao = p.id_profissional
                    WHERE p.voluntario = 1
                    ORDER BY p.avaliacao DESC
                    LIMIT 5";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                echo "<li class='list-group-item rounded w-10 m-1'><b>" . $row["nome"] . "</b><br>
                                  " . $row["descricao"] . " <br>
                                  " . $row["avaliacao"] . "⭐  
                            
                            
                            </li>";
                            }
                        }


                        ?>
                    </ul>
                </div>

            </div>

            <!-- Seção de Feedback -->
            <div class="d-flex justify-content-center align-items-center flex-column m-4">
                <div class="mb-3">
                    <h1>Feedback</h1> <!-- Título para a seção de feedback -->
                </div>

                <div class="d-flex m-1">
                    <!-- Depoimentos de clientes sobre o serviço -->
                    <p>"Estou muito satisfeito com a plataforma! Ela facilitou meu trabalho e ainda me proporcionou a
                        chance de ajudar ONGs com meu trabalho voluntário."</p>
                    <hr>
                    <p>"Encontrei os melhores mecânicos na plataforma! O serviço foi rápido, eficiente e com um
                        atendimento impecável. Fiquei impressionado com a qualidade e profissionalismo. Sem dúvida, é a
                        melhor opção para quem busca confiança e excelência."</p>
                    <hr>
                    <p>"Precisei de um técnico de TI para montar meu PC e encontrei o profissional perfeito através da
                        plataforma. O atendimento foi excelente, o serviço foi feito com precisão e rapidez, e meu
                        computador está funcionando perfeitamente. Recomendo a todos que buscam qualidade e confiança!"
                    </p>
                </div>

            </div>

        </section>

        <!-- Rodapé -->
        <footer class="d-flex justify-content-center align-items-center border-top w-100 bg-info">
            <p>Todos os direitos reservados</p>
        </footer>
    </div>
</body>

</html>