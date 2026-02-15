<?php
include("../../config/config.php");

header('Content-Type: application/json'); // JSON yanıtı göndereceğimizi belirtiyoruz

// JSON verisini al
$data = json_decode(file_get_contents("php://input"));

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($data->regUser)) {
    $regUser = trim($data->regUser);
    $regEmail = trim($data->regEmail);
    $regPass = trim($data->regPass);

    // Tüm alanların doldurulup doldurulmadığını kontrol et
    if (!empty($regUser) && !empty($regEmail) && !empty($regPass)) {
        try {
            // Kullanıcı adının mevcut olup olmadığını kontrol et
            $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
            $stmt->bind_param("s", $regUser);
            $stmt->execute();
            $stmt->bind_result($userExists);
            $stmt->fetch();
            $stmt->close();

            // Email adresinin mevcut olup olmadığını kontrol et
            $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $stmt->bind_param("s", $regEmail);
            $stmt->execute();
            $stmt->bind_result($emailExists);
            $stmt->fetch();
            $stmt->close();

            if ($userExists == 0 && $emailExists == 0) {
                // Şifreyi hashle ve veritabanına ekle
                $dbPass = password_hash($regPass, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (username, email, password, registration_date) VALUES (?, ?, ?, NOW())");
                $stmt->bind_param("sss", $regUser, $regEmail, $dbPass);
                $result = $stmt->execute();

                if ($result) {
                    // Başarılı ise JSON yanıtı gönder
                    echo json_encode([
                        "success" => true,
                        "message" => "Registration successful!"
                    ]);
                } else {
                    // Başarısız ise JSON yanıtı gönder
                    echo json_encode([
                        "success" => false,
                        "message" => "Registration failed! Please try again."
                    ]);
                }
                $stmt->close();
            } else {
                // Kullanıcı adı veya email zaten varsa JSON yanıtı gönder
                $message = $userExists > 0 ? "Username already exists!" : "Email already exists!";
                echo json_encode([
                    "success" => false,
                    "message" => $message
                ]);
            }
        } catch (Exception $e) {
            // Hataları logla ve JSON yanıtı gönder
            echo json_encode([
                "success" => false,
                "message" => "Error: " . $e->getMessage()
            ]);
        }
    } else {
        // Form alanları eksikse JSON yanıtı gönder
        echo json_encode([
            "success" => false,
            "message" => "All fields are required!"
        ]);
    }
} else {
    // Geçersiz istek için JSON yanıtı gönder
    echo json_encode([
        "success" => false,
        "message" => "Invalid request!"
    ]);
}
exit();
?>
