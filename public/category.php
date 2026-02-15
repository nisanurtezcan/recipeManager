<?php
// public/category.php
session_start();
include("../config/config.php");

// URL'den kategori al - örn: category.php?type=desserts
$category = $_GET['type'] ?? 'all';

// Kategori isimleri için güzel başlıklar
$category_titles = [
    'desserts' => 'Desserts',
    'drinks' => 'Drinks',
    'soups' => 'Soups',
    'meat' => 'Meat & Chicken Dishes',
    'pastries' => 'Pastries',
    'oven' => 'Oven Dishes',
    'rice' => 'Rice & Pasta',
    'vegetable' => 'Vegetable Dishes',
    'all' => 'All Recipes'
];

$page_title = $category_titles[$category] ?? 'Recipes';
$is_logged_in = isset($_SESSION['id']);
$username = $_SESSION['username'] ?? '';
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
    <link rel="stylesheet" href="./assets/css/styles.css">

    <style>
       
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg" style="background-color: #4a2040;">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php">
                <img src="./assets/pageImages/smallLogo.png" alt="Logo" width="60" height="60">
                Ayse's Pink Recipe Book
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1)"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php">
                            <i class="fa-solid fa-home"></i> Home
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <?php if ($is_logged_in): ?>
                        <li class="nav-item me-3">
                            <span class="text-white">
                                <i class="fa-solid fa-user me-2"></i>
                                <?= htmlspecialchars($username) ?>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a href="account.php" class="btn btn-outline-light me-2">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a href="../api/auth/logout.php" class="btn btn-danger">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="./login.html" class="btn btn-outline-light">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- SAYFA BAŞLIĞI -->
    <div class="container my-5">
        <h2 class="text-center mb-4">
            <i class="fa-solid fa-utensils me-2"></i>
            <?= $page_title ?>
        </h2>
        
        <!-- YÜKLENİYOR MESAJI -->
        <div id="loading" class="loading">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3">Loading recipes...</p>
        </div>
        
        <!-- TARİFLERİN GÖSTERİLECEĞİ YER -->
        <div id="recipes-container" class="row" style="display: none;"></div>
        
        <!-- HATA MESAJI -->
        <div id="error-message" class="alert alert-danger" style="display: none;"></div>
        
        <!-- BOŞ SONUÇ MESAJI -->
        <div id="empty-message" class="alert alert-info" style="display: none;">
            No recipes found in this category yet.
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- TARİFLERİ YÜKLEYEN JAVASCRIPT -->
    <script>
        // Sayfa yüklendiğinde çalışacak
        document.addEventListener('DOMContentLoaded', function() {
            loadRecipes();
        });
        
        function loadRecipes() {
            const category = "<?= $category ?>"; // PHP'den JavaScript'e kategori gönder
            const apiUrl = `../api/home/list.php?category=${category}`;
            
            // API'ye istek at
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    // Yükleme ekranını gizle
                    document.getElementById('loading').style.display = 'none';
                    
                    if (data.success && data.data.length > 0) {
                        // Tarifleri göster
                        displayRecipes(data.data);
                    } else {
                        // Boş sonuç mesajı göster
                        document.getElementById('empty-message').style.display = 'block';
                    }
                })
                .catch(error => {
                    // Hata olursa
                    console.error('Error:', error);
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('error-message').textContent = 'Failed to load recipes. Please try again.';
                    document.getElementById('error-message').style.display = 'block';
                });
        }
        
        function displayRecipes(recipes) {
            const container = document.getElementById('recipes-container');
            container.style.display = 'flex'; // Container'ı göster
            container.innerHTML = ''; // Önceki içeriği temizle
            
            // Her tarif için kart oluştur
            recipes.forEach(recipe => {
                const card = createRecipeCard(recipe);
                container.innerHTML += card;
            });
        }
        
        function createRecipeCard(recipe) {
            return `
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card recipe-card-main h-100 shadow-sm">
                        <img src="${recipe.image_path}" class="card-img-top" alt="${recipe.title}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">${recipe.title}</h5>
                            <p class="card-text text-muted">${recipe.description || 'Delicious recipe'}</p>
                            <p class="card-text text-muted">Ingredients: ${recipe.ingredients || 'N/A'}</p>
                            
                            ${recipe.prep_time ? `
                                <p class="small mb-1">
                                    <i class="fa-solid fa-clock"></i> 
                                    Prep: ${recipe.prep_time} min
                                </p>
                            ` : ''}
                            ${recipe.cook_time ? `
                                <p class="small mb-1">
                                    <i class="fa-solid fa-clock"></i> 
                                    Cook: ${recipe.cook_time} min
                                </p>
                            ` : ''}
                            <hr>
                            <p class="card-text">Instructions: ${recipe.instructions || 'N/A'}</p>
                        </div>
                    </div>
                </div>
            `;
        }
    </script>
</body>
</html>
