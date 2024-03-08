<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $placa = $_POST['placa'];
    $nome_motorista = $_POST['nome_motorista'];
    $cor_carro = $_POST['cor_carro'];
    $modelo_carro = $_POST['modelo_carro'];
    $local_destino = $_POST['local_destino'];
    $de_onde_vem = $_POST['de_onde_vem'];
    $historia_triste = $_POST['historia_triste'];
    $id_usuario = $_SESSION['user_id'];

    $sql = "INSERT INTO registros (placa, nome_motorista, cor_carro, modelo_carro, local_destino, de_onde_vem, historia_triste, id_usuario)
            VALUES ('$placa', '$nome_motorista', '$cor_carro', '$modelo_carro', '$local_destino', '$de_onde_vem', '$historia_triste', $id_usuario)";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Sucesso";
    } else {
        $error_message = "Erro ao adicionar o registro: " . $conn->error;
        echo "<script>alert('$error_message');</script>";
    }
}

$user_id = $_SESSION['user_id'];
$user_sql = "SELECT * FROM usuarios WHERE id = $user_id";
$user_result = $conn->query($user_sql);
$user = $user_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Novo Registro</title>
    <link rel="stylesheet" href="css/cadastro.css">

</head>
<body>
    <?php if (isset($error_message)) { echo "<p>$error_message</p>"; } ?>
    <form method="post" action="adicionar_registro.php">
       <h1>Adicionar Novo Registro</h1>
        <label for="placa">Placa:</label>
        <input type="text" name="placa" required><br>

        <label for="nome_motorista">Nome do Motorista:</label>
        <input type="text" name="nome_motorista" required><br>

        <label for="cor_carro">Cor do Carro:</label>
        <input type="text" name="cor_carro" required><br>

        <label for="modelo_carro">Modelo do Carro:</label>
        <input type="text" name="modelo_carro" required><br>

        <label for="local_destino">Local de Destino:</label>
        <input type="text" name="local_destino" required><br>

        <label for="de_onde_vem">De Onde Vem:</label>
        <input type="text" name="de_onde_vem" required><br>

        <label for="historia_triste">História Triste:</label>
        <textarea name="historia_triste" required></textarea><br>

        <input type="submit" value="Adicionar Registro">
    </form>

    <a href="pesquisar_registros.php">Pesquisar Registros</a>
    <a href="painel_admin.php">Voltar</a>
   <!--<a href="logout.php">Sair</a> -->
</body>
</html>
