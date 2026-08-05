<?php
require_once 'conexao.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = :id");
        $stmt->execute(['id' => $id]);
    } catch (PDOException $e) {
        // Tratamento silencioso ou log de erro
    }
}

header("Location: index.php");
exit;
?>