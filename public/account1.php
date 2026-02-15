<?php
session_start();
include("../config/config.php");

// Login kontrolü
if (!isset($_SESSION['id'])) {
    header("Location: ../pages/login.html");
    exit();
}

$username = $_SESSION['username'] ?? 'Guest';
?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Ayse's Pink Recipe Book</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <style>
        .btn-primary {
            background-color: #4a2040 !important;
            border-color: #4a2040 !important;
        }
        .btn-primary:hover {
            background-color: #632850 !important;
        }
        .dashboard-card {
            transition: transform 0.3s;
            cursor: pointer;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg" style="background-color: #4a2040;">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php">
                <img src="./assets/images/smallLogo.png" alt="Logo" width="60" height="60">
                Ayse's Pink Recipe Book
            </a>
            
            <!-- Welcome Message -->
            <span class="text-white me-3">
                <i class="fa-solid fa-user me-2"></i>
                Welcome, <strong><?= htmlspecialchars($username) ?></strong>
            </span>
            
            <!--
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1)"></span>
            </button>
-->
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="index.php" class="btn btn-outline-light me-2">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="../api/auth/logout.php" class="btn btn-danger">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- DASHBOARD -->
    <div class="container my-5">
        <h2 class="text-center mb-5">
            <i class="fa-solid fa-utensils me-2"></i>
            Your Recipe Dashboard
        </h2>
        
        <div class="row g-4">
            <!-- Kart 1: Add Recipe -->
            <div class="col-md-4">
                <div class="card dashboard-card h-100 text-center p-4 shadow" onclick="window.location.href='add-recipe.php'">
                    <div class="card-body">
                        <i class="fa-solid fa-plus-circle fa-4x text-success mb-3"></i>
                        <h4 class="card-title">Add New Recipe</h4>
                        <p class="card-text">Share your culinary creations with the world</p>
                    </div>
                </div>
            </div>
            
            <!-- Kart 2: My Recipes -->
            <div class="col-md-4">
                <div class="card dashboard-card h-100 text-center p-4 shadow" onclick="window.location.href='my-recipes.php'">
                    <div class="card-body">
                        <i class="fa-solid fa-book fa-4x text-primary mb-3"></i>
                        <h4 class="card-title">My Recipes</h4>
                        <p class="card-text">View and manage your own recipes</p>
                    </div>
                </div>
            </div>
            
            <!-- Kart 3: Explore Recipes -->
            <div class="col-md-4">
                <div class="card dashboard-card h-100 text-center p-4 shadow" onclick="window.location.href='all-recipes.php'">
                    <div class="card-body">
                        <i class="fa-solid fa-users fa-4x text-warning mb-3"></i>
                        <h4 class="card-title">Explore Recipes</h4>
                        <p class="card-text">Discover recipes from other users</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Stats (Opsiyonel) -->
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="alert alert-info text-center">
                    <i class="fa-solid fa-info-circle me-2"></i>
                    <strong>Tip:</strong> Don't forget to check out the homepage for featured recipes!
                    <a href="index.php" class="alert-link">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>