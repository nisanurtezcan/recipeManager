<?php
session_start();

// Oturumdan tüm değişkenleri temizle
session_unset();

// Oturumu tamamen yok et
session_destroy();

// Cookie'yi de temizle (güvenlik için)
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Kullanıcıyı ana sayfaya yönlendir
header("Location: ../../public/index.php");
exit();
?>