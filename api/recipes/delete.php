<?php
session_start();
header('Content-Type: application/json');
include("../../config/config.php");

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$user_id = $_SESSION['id'];
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['recipe_id'])) {
    echo json_encode(['success' => false, 'message' => 'Recipe ID required']);
    exit();
}

$recipe_id = (int)$data['recipe_id'];

try {
    // Sadece kendi tarifini silebilir
    $stmt = $conn->prepare("DELETE FROM user_recipes WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $recipe_id, $user_id);
    
    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Recipe deleted']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Recipe not found or not authorized']);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

$conn->close();
?>