<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json; charset=utf-8');

error_reporting(0);
ini_set('display_errors', 0);

// Al estar en la carpeta api/, usamos '../db.php' para conectar con db.php que está en la raíz
require_once '../db.php'; 

$userId = $_SESSION['user_id'] ?? $_SESSION['id'] ?? $_SESSION['id_usuario'] ?? $_SESSION['usuario_id'] ?? null;

if (!$userId) {
    echo json_encode([
        'success' => false, 
        'message' => 'No se detectó una sesión activa. Por favor inicia sesión nuevamente.'
    ]);
    exit;
}

$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

$planCode = isset($data['plan_code']) ? trim($data['plan_code']) : '';

if (empty($planCode)) {
    echo json_encode([
        'success' => false, 
        'message' => 'No se recibió el código del plan.'
    ]);
    exit;
}

try {
    // Verificar si existe la variable de conexión ($pdo o $conn)
    if (!isset($pdo) && isset($conn)) {
        $pdo = $conn;
    }

    $stmt = $pdo->prepare("SELECT favoritos FROM usuarios WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $favoritosArray = [];
    if ($user && !empty($user['favoritos'])) {
        $decoded = json_decode($user['favoritos'], true);
        if (is_array($decoded)) {
            $favoritosArray = $decoded;
        }
    }

    $isFavorite = false;
    if (in_array($planCode, $favoritosArray)) {
        $favoritosArray = array_values(array_diff($favoritosArray, [$planCode]));
    } else {
        $favoritosArray[] = $planCode;
        $isFavorite = true;
    }

    $newFavoritesJson = json_encode($favoritosArray);
    $updateStmt = $pdo->prepare("UPDATE usuarios SET favoritos = ? WHERE id = ?");
    $updateStmt->execute([$newFavoritesJson, $userId]);

    echo json_encode([
        'success' => true,
        'is_favorite' => $isFavorite,
        'message' => $isFavorite ? 'Plan guardado' : 'Plan removido'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => 'Error de Base de Datos: ' . $e->getMessage()
    ]);
}