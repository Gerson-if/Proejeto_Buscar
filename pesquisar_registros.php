<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Recuperar registros do banco de dados
$sql = "SELECT * FROM registros WHERE id_usuario = $user_id";
$result = $conn->query($sql);
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
    <h2>Pesquisar Registros</h2>

    <input type="text" id="searchInput" placeholder="Pesquisar...">
    
    <ul id="registrosList">
        <?php while ($row = $result->fetch_assoc()) : ?>
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
                <button class="btnExcluir">Excluir</button>
            </li>
        <?php endwhile; ?>
    </ul>
   <footer>
   <a href="adicionar_registro.php">Adicionar Novo Registro</a>
    <a href="painel_admin.php">Voltar</a>
    <a href="logout.php">Sair</a>
   </footer>

    <script>
        // Adicionar evento de pesquisa em tempo real
        $(document).ready(function () {
            $("#searchInput").on("input", function () {
                var searchTerm = $(this).val().toLowerCase();
                $("#registrosList li").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1)
                });
            });
        });

        $(document).on("click", ".btnExcluir", function () {
            var id = $(this).closest("li").data("id");
            if (confirm('Deseja realmente excluir este registro?')) {
                // Implemente a chamada Ajax para excluir o registro
                $.ajax({
                    url: 'excluir_registro.php',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        alert('Registro excluído com sucesso!');
                        // Atualizar a lista ou recarregar a página
                        $("#registrosList li[data-id='" + id + "']").remove();
                    },
                    error: function(error) {
                        alert('Erro ao excluir o registro.');
                    }
                });
            }
        });
    </script>
</body>
</html>
