<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $registro_id = $_GET['id'];

    $user_id = $_SESSION['user_id'];
    $user_sql = "SELECT * FROM usuarios WHERE id = $user_id";
    $user_result = $conn->query($user_sql);
    $user = $user_result->fetch_assoc();

    $sql = "SELECT * FROM registros WHERE id = $registro_id AND id_usuario = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Marcar registro como excluído (soft delete)
        $update_sql = "UPDATE registros SET excluido = 1 WHERE id = $registro_id";

        if ($conn->query($update_sql) === TRUE) {
            header('Location: pesquisar_registros.php');
            exit();
        } else {
            $error_message = "Erro ao excluir o registro: " . $conn->error;
        }
    } else {
        header('Location: pesquisar_registros.php');
        exit();
    }
} else {
    header('Location: pesquisar_registros.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Registro</title>
</head>
<body>
    <h2>Excluir Registro</h2>
    <?php if (isset($error_message)) { echo "<p>$error_message</p>"; } ?>
    <p>Tem certeza de que deseja excluir este registro?</p>
    <form method="post" action="excluir_registro.php?id=<?php echo $registro_id; ?>">
        <input type="submit" value="Sim, Excluir">
    </form>

    <a href="pesquisar_registros.php">Não, Voltar</a>
    <a href="logout.php">Sair</a>
</body>
</html>
