<?php
session_start();
require_once '../config/db.php'; // Sube un nivel para encontrar config/db.php

header('Content-Type: application/json');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit;
}

$userId = $_SESSION['user_id'];

try {
    // Actualizar la base de datos para que active_reminder sea 0
    $stmt = $pdo->prepare("UPDATE usuarios SET active_reminder = 0 WHERE id = ?");
    $result = $stmt->execute([$userId]);

    echo json_encode(['success' => $result]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}