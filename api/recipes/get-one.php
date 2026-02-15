<?php
session_start();
header('Content-Type: application/json');
include("../../config/config.php");

// Login kontrolü
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

// Recipe ID al
$recipe_id = $_GET['id'] ?? null;

if (!$recipe_id) {
    echo json_encode(['success' => false, 'message' => 'Recipe ID required']);
    exit();
}

try {
    $stmt = $conn->prepare("
        SELECT * FROM user_recipes 
        WHERE id = ? AND user_id = ?
    ");
    
    $stmt->bind_param("ii", $recipe_id, $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Recipe not found']);
        exit();
    }
    
    $recipe = $result->fetch_assoc();
    
    echo json_encode([
        'success' => true,
        'data' => $recipe
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
