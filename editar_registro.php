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
        $registro = $result->fetch_assoc();
    } else {
        header('Location: pesquisar_registros.php');
        exit();
    }
} else {
    header('Location: pesquisar_registros.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lógica para editar o registro
    $placa = $_POST['placa'];
    $nome_motorista = $_POST['nome_motorista'];
    $cor_carro = $_POST['cor_carro'];
    $modelo_carro = $_POST['modelo_carro'];
    $local_destino = $_POST['local_destino'];
    $de_onde_vem = $_POST['de_onde_vem'];
    $historia_triste = $_POST['historia_triste'];

    $update_sql = "UPDATE registros SET
                    placa = '$placa',
                    nome_motorista = '$nome_motorista',
                    cor_carro = '$cor_carro',
                    modelo_carro = '$modelo_carro',
                    local_destino = '$local_destino',
                    de_onde_vem = '$de_onde_vem',
                    historia_triste = '$historia_triste'
                    WHERE id = $registro_id";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: pesquisar_registros.php");
        exit();
    } else {
        $error_message = "Erro ao editar o registro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="css/editar.css">
</head>
<body>
    <h2>Editar Registro</h2>
    <?php if (isset($error_message)) { echo "<p>$error_message</p>"; } ?>
    <form method="post" action="editar_registro.php?id=<?php echo $registro_id; ?>">
        <label for="placa">Placa:</label>
        <input type="text" name="placa" value="<?php echo $registro['placa']; ?>" required><br>

        <label for="nome_motorista">Nome do Motorista:</label>
        <input type="text" name="nome_motorista" value="<?php echo $registro['nome_motorista']; ?>" required><br>

        <label for="cor_carro">Cor do Carro:</label>
        <input type="text" name="cor_carro" value="<?php echo $registro['cor_carro']; ?>" required><br>

        <label for="modelo_carro">Modelo do Carro:</label>
        <input type="text" name="modelo_carro" value="<?php echo $registro['modelo_carro']; ?>" required><br>

        <label for="local_destino">Local de Destino:</label>
        <input type="text" name="local_destino" value="<?php echo $registro['local_destino']; ?>" required><br>

        <label for="de_onde_vem">De Onde Vem:</label>
        <input type="text" name="de_onde_vem" value="<?php echo $registro['de_onde_vem']; ?>" required><br>

        <label for="historia_triste">História Triste:</label>
        <textarea name="historia_triste" required><?php echo $registro['historia_triste']; ?></textarea><br>

        <input type="submit" value="Salvar Edições">
    </form>

    <a href="pesquisar_registros.php">Voltar para Pesquisa de Registros</a>
</body>
</html>
