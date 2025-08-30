<?php
    session_start();

    // Variáveis para conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "usbw";
    $dbname = "capix_db";

    // Conectando ao banco de dados
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Verificando se a conexão foi bem-sucedida
    if (!$conn) {
        die("Falha na conexao: " . mysqli_connect_error());
    }
    $pesquisar = $_POST['buscador'];
    $result_profissao = "SELECT id_categoria FROM categoria WHERE nome_categoria LIKE '%$pesquisar%' LIMIT 8";
    $result_profissao = mysqli_query($conn, $result_profissao);

    while ($rows_profisao = mysqli_fetch_array($result_profissao)) {
        header("Location: servicos.php?id={$rows_profisao['id_categoria']}");
    }



?>