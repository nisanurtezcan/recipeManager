<?php 
header('Content-Type: application/json');
include("../../config/config.php");

$category = $_GET['category'] ?? 'all';

try {
    $recipes = [];
    
    if ($category !== 'all') {
        // Prepared statement ile kategori filtrele
        $stmt = $conn->prepare("SELECT * FROM home_recipes WHERE category = ? ORDER BY created_at DESC");
        $stmt->bind_param("s", $category); // "s" = string parametresi
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Sonuçları diziye çevir
        while ($row = $result->fetch_assoc()) {
            $recipes[] = $row;
        }
        
        $stmt->close();
        
    } else {
        // Tüm tarifleri getir
        $result = $conn->query("SELECT * FROM home_recipes ORDER BY created_at DESC");
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $recipes[] = $row;
            }
        }
    }
    
    echo json_encode([
        'success' => true,
        'data' => $recipes,
        'category' => $category
    ]);
    
} catch (Exception $exception) {
    echo json_encode([
        'success' => false,
        'message' => 'Database Error: ' . $exception->getMessage()
    ]);
}

$conn->close();
?>