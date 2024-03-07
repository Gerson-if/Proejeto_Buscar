<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>

<?php
    session_start();
    require_once('config.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            header('Location: painel_admin.php');
            exit();
        } else {
            $error_message = "Usuário ou senha incorretos.";
        }
    }
?>

    <form method="post" action="login.php">
        <h2>Login</h2>
        <?php if (isset($error_message)) { echo "<p class='error-message'>$error_message</p>"; } ?>
        <label for="username">Usuário:</label>
        <input type="text" name="username" required>

        <label for="password">Senha:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Entrar">
        <p>somente adminstradores permidos</p>
    </form>
</body>
</html>
