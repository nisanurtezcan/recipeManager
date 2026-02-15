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

if (!isset($data['recipe_name']) || !isset($data['category']) || !isset($data['description'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit();
}

$recipe_name = trim($data['recipe_name']);
$category = trim($data['category']);
$description = trim($data['description']);
$ingredients = trim($data['ingredients'] ?? '');
$instructions = trim($data['instructions'] ?? '');

try {
    $stmt = $conn->prepare("
        INSERT INTO user_recipes (user_id, title, category, description, ingredients, instructions) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("isssss", $user_id, $recipe_name, $category, $description, $ingredients, $instructions);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Recipe added successfully',
            'recipe_id' => $conn->insert_id
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add recipe']);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

$conn->close();
?>