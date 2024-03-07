<?php
session_start();
require_once('config.php');

// Destruir todas as variáveis de sessão
session_unset();

// Destruir a sessão
session_destroy();

// Fechar a conexão com o banco de dados (se necessário)
if (isset($conn)) {
    $conn->close();
}

// Redirecionar para a página de login
header('Location: login.php');
exit();
?>
