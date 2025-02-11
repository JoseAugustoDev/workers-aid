<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pages/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Trabalho Final</title> <!-- Título da página que aparece na aba do navegador -->
</head>

<body class="bg-primary">
    <div class="container bg-info">
        <header class="d-flex bg-info justify-content-between align-items-center w-100 p-3 border-bottom">
            <!-- Seção de Cabeçalho (Logo e Menu de Navegação) -->
            <div class="logo">
                <img width="125px" height="125px" class="rounded-circle" src="/pages/imgs/Logo.jpg" id="logo" alt="Logo"> <!-- Exibe a imagem do logo -->
            </div>

            <!-- Barra de Navegação -->
            <nav class="menu_suspenso">
                <ul class="d-flex align-items-center justify-content-between list-group-horizontal">
                    <!-- Links de navegação para diferentes páginas do site -->
                    <li class="list-group-item rounded-pill">
                        <a class="text-decoration-none" href="/pages/login.html">Login</a>
                    </li>
                    <li class="list-group-item rounded-pill">
                        <a class="text-decoration-none" href="/pages/tipo-usuario.html">Cadastro</a>
                    </li>
                    <li class="list-group-item rounded-pill">
                        <a class="text-decoration-none" href="/pages/quemsomos.html">Quem somos</a>
                    </li>
                </ul>
            </nav>
            <!-- Fim da barra de navegação -->

            <!-- Seção de Perfil do Usuário -->
            <div class="perfil">
                <?php 

                    if (isset($_SESSION['id_cliente'])) {
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
            </div>
        </header>
        <!-- Fim do cabeçalho -->
                    
        <section class="w-100 d-flex justify-content-center align-items-center">
            <form method="POST" action="/server/pesquisar.php" id="buscar" class="w-100 h-10 p-3 input-group d-flex justify-content-center">
                <input type="text" class="input-group-text w-50 bg-white" id="buscador" name="buscador" placeholder="buscar"> <!-- Campo de texto para busca -->

                <button class="btn btn-outline-dark" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
             </form>
        </section>
        <!-- Seção de Busca -->

        <!-- Seção de Imagem Principal e Texto -->
        <section>
            <div class="container d-flex justify-content-center align-items-center flex-column p-2">
                <div class="imagem_tela_principal">
                    <!-- <img src="/pages/imgs/imagem_principal.png" alt="serviços"> Imagem de destaque -->
                </div>

                <h1>Categorias</h1>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <!-- Categorias de serviços poderiam ser listadas aqui -->
                        <ul class="d-flex align-items-center justify-content-between list-group-horizontal">
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
                                    echo "<a href='/server/servicos.php?id={$row['id_categoria']}' class='text-decoration-none'> <li class='p-2 m-2 item-categoria list-group-item rounded-pill'>" . $row["nome_categoria"] . "</li></a>";
                                }
                            } else {
                                echo "Não há nada";
                            }
                        ?>
                        </ul>
                    </div>
                </div>
                <div class="texto-secundaria">
                    <p>
                        Transformando conexões em soluções: somos uma empresa dedicada a criar pontes entre
                        profissionais e pessoas, oferecendo serviços de qualidade com inovação, confiança e
                        compromisso. Nosso propósito é simplificar a vida de nossos clientes, proporcionando acesso
                        fácil e rápido a especialistas em diversas áreas.
                    </p>
                </div>

            </div>

            <!-- Seção de Feedback -->
            <div class="d-flex justify-content-center align-items-center flex-column">
                <div class="titulo-feedback">
                    <h1>Feedback</h1> <!-- Título para a seção de feedback -->
                </div>

                <div class="d-flex">
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
        <footer class="d-flex justify-content-center align-items-center border-top">
            <p>Todos os direitos reservados</p> <!-- Texto de direitos autorais -->
        </footer>
    </div>
</body>

</html>