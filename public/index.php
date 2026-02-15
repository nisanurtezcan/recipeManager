<?php
session_start();
include("../config/config.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ayse's Pink Recipe Book</title>

  <!-- Main CSS -->
  <link rel="stylesheet" href="style.css">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Favicon -->
    <link rel="icon" href="../public/assets/pageImages/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="./assets/css/styles.css">


  <style>
    
  </style>
</head>

<body>
<?php include("../includes/navbar.php"); ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- NAVBAR -->
  
  <!-- HERO -->
  <div class="container my-4">
    <div class="row">
      
      <!-- Carousel -->
      <div class="col-md-6">
        <div id="carouselExampleDark" class="carousel carousel-dark slide">
          
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></button>
          </div>

          <div class="carousel-inner">
            <div class="carousel-item active"><img src="./assets/pageImages/carousel1.png" class="img-fluid" alt=""></div>
            <div class="carousel-item"><img src="./assets/pageImages/carousel2.png" class="img-fluid" alt=""></div>
            <div class="carousel-item"><img src="./assets/pageImages/carousel3.png" class="img-fluid" alt=""></div>
          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>

          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>

        </div>
      </div>

      <!-- Text -->
      <div class="col-md-6 d-flex align-items-center">
        <p style="font-size: 19px; margin: 2rem;">
           "Welcome to the home of the most delicious recipes! Explore a world of flavors with our collection of soups,
        meat dishes, vegetable dishes, drinks, desserts, oven dishes, rice and pasta, and pastries.
        Browse each category below to find your next favorite dish!
        <br>
        <br>
        Register now to save your favorite recipes to your personal account and share your own culinary creations with
        the world!"
        </p>
      </div>

    </div>
  </div>

  <!-- CATEGORY CARDS -->
<div class="container my-5">
  <h3 class="text-center">RECIPES</h3>

  <div class="row justify-content-center mt-4">

    <?php
    $cards = [
      ["img"=>"./assets/uploads/homepageRecipePics/mp_coffee.png", "text"=>"Summer Coolers: Drinks", "category"=>"drinks", "btn"=>"See Drinks"],
      ["img"=>"./assets/uploads/homepageRecipePics/mp_baklava.png", "text"=>"Sweet Delights: Desserts", "category"=>"desserts", "btn"=>"See Desserts"],
      ["img"=>"./assets/uploads/homepageRecipePics/mp_kebab.png", "text"=>"Hearty Meat Dishes", "category"=>"meat", "btn"=>"See Meals"],
      ["img"=>"./assets/uploads/homepageRecipePics/mp_simit.png", "text"=>"Golden Pastries", "category"=>"pastries", "btn"=>"See Bakeries"],
      ["img"=>"./assets/uploads/homepageRecipePics/mp_eggplant.png", "text"=>"Perfect Oven Dishes", "category"=>"oven", "btn"=>"See Oven Dishes"],
      ["img"=>"./assets/uploads/homepageRecipePics/mp_rice.png", "text"=>"Rice and Pasta", "category"=>"rice", "btn"=>"See Rice & Pasta"],
      ["img"=>"./assets/uploads/homepageRecipePics/mp_soup.png", "text"=>"Warm Soups", "category"=>"soups", "btn"=>"See Soups"],
      ["img"=>"./assets/uploads/homepageRecipePics/mp_stuffedPepper.png", "text"=>"Vegetable Dishes", "category"=>"vegetable", "btn"=>"See Vegetables"]
    ];

    foreach ($cards as $c): ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
        <div class="card card-mainPage h-100">
          <img src="<?= $c['img'] ?>" class="card-img-top" alt="<?= $c['text'] ?>">
          <div class="card-body">
            <p class="card-text"><?= $c['text'] ?></p>
            <!-- DİKKAT: link yerine category kullanıyoruz -->
            <a href="category.php?type=<?= $c['category'] ?>" class="btn btn-primary"><?= $c['btn'] ?></a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</div>

</body>
</html>
