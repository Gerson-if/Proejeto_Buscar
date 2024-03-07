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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Registro</title>
    <link rel="stylesheet" href="css/visualizar.css">

</head>
<body>
    <h2>Visualizar Registro</h2>
    <p><strong>Placa:</strong> <?php echo $registro['placa']; ?></p>
    <p><strong>Nome do Motorista:</strong> <?php echo $registro['nome_motorista']; ?></p>
    <p><strong>Cor do Carro:</strong> <?php echo $registro['cor_carro']; ?></p>
    <p><strong>Modelo do Carro:</strong> <?php echo $registro['modelo_carro']; ?></p>
    <p><strong>Local de Destino:</strong> <?php echo $registro['local_destino']; ?></p>
    <p><strong>De Onde Vem:</strong> <?php echo $registro['de_onde_vem']; ?></p>
    <p><strong>História Triste:</strong> <?php echo $registro['historia_triste']; ?></p>
    <p><strong>Data de Cadastro:</strong> <?php echo $registro['data_cadastro']; ?></p>

    <a href="pesquisar_registros.php">Voltar</a>
    <a href="logout.php">Sair</a>
</body>
</html>
