<?php
session_start();

// config.php dosyasını dahil et
include("../../config/config.php");

header('Content-Type: application/json'); 

// JSON verisini al
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['logUser']) && isset($data['logPass'])) {
    $logUser = trim($data["logUser"]);
    $logPass = trim($data["logPass"]);

    if (!empty($logUser) && !empty($logPass)) {
        // Kullanıcı adı kontrolü
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $logUser); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $rowUser = $result->fetch_assoc();
            $passwordWithHash = $rowUser["password"];

            // Şifre doğrulaması
            if (password_verify($logPass, $passwordWithHash)) {
                // Oturum değişkenlerini başlat
                $_SESSION["id"] = $rowUser["id"];  
                $_SESSION["username"] = $logUser;  

                // Başarılı giriş
                echo json_encode(['success' => true, 'message' => 'Login successful']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid Password']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'User Does Not Exist']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'All Fields Are Required']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid Request']);
}
?>

