<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ServicÇs</title>
</head>

<body>

    <div class="tela_servico">

        <!-- Cabeçalho com a logo e menu -->
        <header>

            <!-- Logo do site -->
            <div class="logo">
                <img src="imgs/Logo.jpg" id="logo" alt="Logo">
            </div>

            <!-- Começo do menu suspenso -->
            <nav class="menu_suspenso">
                <ul>
                    <!-- Itens do menu -->
                    <li class="li">
                        <a href="login.html">Login</a>
                    </li>
                    <li class="li">
                        <a href="cadastro-cliente.html">Cadastro</a>
                    </li>
                    <li class="li">
                        <a href="quemsomos.html">Quem somos</a>
                    </li>
                </ul>
            </nav>

            <!-- Seção do perfil do usuário -->
            <div class="perfil">
                <form action="/server/perfil.php" method="GET">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                    </button>
                </form>
            </div>
        </header>

        <!-- Seção principal de conteúdo -->
        <section>

            <?php


            $servername = "localhost";
            $username = "root";
            $password = "usbw";
            $dbname = "dados";


            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            $id_cat = $_GET['id'];

            $categoria = "SELECT nome_categoria FROM categoria WHERE id_categoria = $id_cat";
            $resultado = $conn->query($categoria);

            if ($resultado->num_rows > 0) {
                $cate = $resultado->fetch_assoc();
                $nome_categoria = $cate["nome_categoria"];
            }



            echo "<h1> Precisando de um profissional em $nome_categoria? Veja nossos profissionais destaques em $nome_categoria  </h1>";

            echo "<div class='info-de-perfil'>";
            echo "<ul>";

            $sql = "SELECT * FROM profissional WHERE id_categoria = $id_cat";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    $id_profissional = $row["id_profissional"];

                    $voluntario = "Fornece trabalho voluntário!";

                    if ($row["voluntario"] != 1) {
                        $voluntario = "Não fornece trabalho voluntário!";
                    }

                    $sql2 = "SELECT * FROM clientes WHERE id_situacao = $id_profissional";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        $foto = $row2["foto_perfil"];
                    } else {
                        echo "Profissional não encontrado.";
                        $conn->close();
                        exit;
                    }

                    echo "<li>
                                <div class='img-perfil'>
                                    <img id='foto-servico' src='$foto' alt='imagem_de_perfil'>
                                </div>
                                <div class='prof-info'>
                                    <p class='nome'>" . $row2['nome'] . "</p>
                                    <p class='email'>" . $row2['email'] . "</p>
                                    <p class='descricao'>" . $row['descricao'] . "</p>
                                    <p>" . $voluntario . "</p>  
                                </div>
                            </li>";
                }
            } else {
                echo "Não há nada";
            }
            ?>
            </ul>
    </div>
    </section>

</body>

</html>