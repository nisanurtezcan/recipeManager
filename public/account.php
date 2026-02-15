<?php
session_start();
include("../config/config.php");

// Login kontrolü
if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'] ?? 'Guest';
$current_page = 'account';
$page_title = "My Account";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?> - Ayse's Pink Recipe Book</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <!-- Favicon -->
    <link rel="icon" href="../public/assets/pageImages/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/styles.css">

    <style>
       
    </style>
</head>
<body>

<?php include("../includes/navbar.php"); ?>

<div class="mainBackground">
    <div class="container">
        <div class="row">
            
            <!-- SOL TARAF: Add Recipe + My Recipes -->
            <div class="col-lg-6 mb-4">
                <h3 class="section-title mt-4">
    <i class="fa-solid fa-book me-2"></i>
    My Recipes
</h3>
                <?php include("../includes/recipe-adding.php"); ?>
                <?php include("../includes/recipe-mine.php"); ?>
            </div>


            
            <!-- SAĞ TARAF: Other Users' Recipes -->
            <div class="col-lg-6 mt-4 mb-4">
                <h3 class="section-title">
    <i class="fa-solid fa-users me-2"></i>
    Community Recipes
</h3>
                <?php include("../includes/recipe-others.php"); ?>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Account JS -->
<script src="./assets/js/account.js"></script>

</body>
</html>