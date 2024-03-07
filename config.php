<?php
// Conectar ao banco de dados (substitua com suas credenciais)
$conn = new mysqli("localhost", "root", "root", "app_database");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
