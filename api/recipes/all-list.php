<?php
session_start();
header('Content-Type: application/json');
include("../../config/config.php");

// Kullanıcı login kontrolü
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in', 'debug' => 'Session id not set']);
    exit();
}

$current_user_id = $_SESSION['id'];

try {
    // Önce user_recipes tablosu var mı kontrol et
    $check_table = $conn->query("SHOW TABLES LIKE 'user_recipes'");
    if ($check_table->num_rows == 0) {
        echo json_encode([
            'success' => false, 
            'message' => 'Table user_recipes does not exist',
            'debug' => 'Please create the user_recipes table first'
        ]);
        exit();
    }
    
    // Diğer kullanıcıların tariflerini çek (kendi hariç)
    $stmt = $conn->prepare("
        SELECT ur.*, u.username 
        FROM user_recipes ur 
        JOIN users u ON ur.user_id = u.id 
        WHERE ur.user_id != ? AND ur.is_public = 1
        ORDER BY ur.created_at DESC
    ");
    
    if (!$stmt) {
        echo json_encode([
            'success' => false,
            'message' => 'Query preparation failed',
            'debug' => $conn->error
        ]);
        exit();
    }
    
    $stmt->bind_param("i", $current_user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $recipes = [];
    while ($row = $result->fetch_assoc()) {
        $recipes[] = $row;
    }
    
    echo json_encode([
        'success' => true,
        'data' => $recipes,
        'count' => count($recipes),
        'current_user_id' => $current_user_id
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage(),
        'debug' => $e->getTraceAsString()
    ]);
}

$conn->close();
?>
