<?php
session_start();
require_once('config.php');

// Verificar se é uma solicitação AJAX e se é do tipo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
    // Solicitação inválida
    echo json_encode(['success' => false, 'message' => 'Solicitação inválida']);
    exit();
}

// Verificar se o ID está presente na solicitação POST
if (!isset($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID não fornecido']);
    exit();
}

$user_id = $_SESSION['user_id'];
$registro_id = $_POST['id'];

// Verificar se o usuário tem permissão para excluir o registro (adapte conforme necessário)
// ...

// Preparar e executar a consulta para excluir o registro
$sql = "DELETE FROM registros WHERE id = ? AND id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $registro_id, $user_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Registro excluído com sucesso']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao excluir o registro: ' . $stmt->error]);
}

exit();
?>
