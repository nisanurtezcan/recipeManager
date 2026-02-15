<?php
session_start();
header('Content-Type: application/json');
include("../../config/config.php");

// Kullanıcı login kontrolü
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$user_id = $_SESSION['id'];

try {
    // Kullanıcının kendi tariflerini çek
    $stmt = $conn->prepare("
        SELECT * FROM user_recipes 
        WHERE user_id = ? 
        ORDER BY created_at DESC
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $recipes = [];
    while ($row = $result->fetch_assoc()) {
        $recipes[] = $row;
    }
    
    echo json_encode([
        'success' => true,
        'data' => $recipes
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}

$conn->close();
?>