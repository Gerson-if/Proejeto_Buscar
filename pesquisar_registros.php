<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Recuperar registros do banco de dados
$sql = "SELECT * FROM registros WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);

if ($stmt->execute()) {
    $result = $stmt->get_result();
} else {
    // Trate o erro conforme necessário
    die("Erro na execução da consulta: " . $stmt->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pesquisar Registros</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="css/pesquisa.css">
</head>
<body>

    <h1>Pesquisar Registros</h1>

<!-- Barra de Navegação -->
<header>
    <nav>
        <div id="navbar">
            <a href="adicionar_registro.php">Adicionar Novo Registro</a>
            <a href="painel_admin.php">Voltar ao Painel </a>
        </div>
        <br>
        <input type="text" id="searchInput" placeholder="Pesquisar...">
    </nav>
</header>

    <ul id="registrosList">
        <?php
        if ($result) {
            while ($row = $result->fetch_assoc()) :
        ?>
                <li data-id="<?= $row['id'] ?>">
                    <span><?= $row['placa'] ?></span>
                    <span><?= $row['nome_motorista'] ?></span>
                    <span><?= $row['cor_carro'] ?></span>
                    <span><?= $row['modelo_carro'] ?></span>
                    <span><?= $row['local_destino'] ?></span>
                    <span><?= $row['de_onde_vem'] ?></span>
                    <span><?= $row['historia_triste'] ?></span>
                    <a href="visualizar_registro.php?id=<?= $row['id'] ?>" class="btnVisualizar">Visualizar</a>
                    <a href="editar_registro.php?id=<?= $row['id'] ?>" class="btnEditar">Editar</a>
                    <button class="btnExcluir" data-id="<?= $row['id'] ?>">Excluir</button>
                </li>
        <?php
            endwhile;
        } else {
            // Trate o caso em que $result é nulo
            echo "Erro na obtenção dos resultados da consulta.";
        }
        ?>
    </ul>
   

    <script>
        // Adicionar evento de pesquisa em tempo real
        $(document).ready(function () {
            $("#searchInput").on("input", function () {
                var searchTerm = $(this).val().toLowerCase();
                $("#registrosList li").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1)
                });
            });

            // Adicionar evento de exclusão
            $(document).on("click", ".btnExcluir", function () {
                var id = $(this).data("id");
                if (confirm('Deseja realmente excluir este registro?')) {
                    // Implemente a chamada Ajax para excluir o registro
                    $.ajax({
                        url: 'excluir_registro.php',
                        type: 'POST',
                        data: { id: id },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                alert('Registro excluído com sucesso!');
                                // Atualizar a lista ou recarregar a página
                                $("#registrosList li[data-id='" + id + "']").remove();
                            } else {
                                alert('Erro ao excluir o registro: ' + response.message);
                            }
                        },
                        error: function(error) {
                            alert('Erro ao excluir o registro.');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
