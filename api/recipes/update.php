<?php
session_start();
header('Content-Type: application/json');
include("../../config/config.php");

// Login kontrolü
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$user_id = $_SESSION['id'];

// POST verilerini al
$data = json_decode(file_get_contents('php://input'), true);

// Gerekli alanları kontrol et
if (!isset($data['recipe_id']) || !isset($data['recipe_name'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit();
}

$recipe_id = (int)$data['recipe_id'];
$recipe_name = trim($data['recipe_name']);
$category = trim($data['category'] ?? '');
$description = trim($data['description'] ?? '');
$ingredients = trim($data['ingredients'] ?? '');
$instructions = trim($data['instructions'] ?? '');

try {
    // Önce tarif bu kullanıcıya ait mi kontrol et
    $checkStmt = $conn->prepare("SELECT user_id FROM user_recipes WHERE id = ?");
    $checkStmt->bind_param("i", $recipe_id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Recipe not found']);
        exit();
    }
    
    $recipe = $checkResult->fetch_assoc();
    
    if ($recipe['user_id'] != $user_id) {
        echo json_encode(['success' => false, 'message' => 'You can only edit your own recipes']);
        exit();
    }
    
    // Tarifi güncelle
    $stmt = $conn->prepare("
        UPDATE user_recipes 
        SET title = ?, 
            category = ?, 
            description = ?, 
            ingredients = ?, 
            instructions = ?,
            updated_at = CURRENT_TIMESTAMP
        WHERE id = ? AND user_id = ?
    ");
    
    $stmt->bind_param(
        "sssssii", 
        $recipe_name, 
        $category, 
        $description, 
        $ingredients, 
        $instructions,
        $recipe_id,
        $user_id
    );
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Recipe updated successfully',
            'recipe_id' => $recipe_id
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Failed to update recipe'
        ]);
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => 'Error: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
