
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact</title>
    <!--Link for the Icons-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="icon" href="../public/assets/pageImages/logo.png" type="image/x-icon">
  </head>

  <body>
    <?php include("../includes/navbar.php"); ?>

    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <!--bg-body-tertiary -- rengi otomatik ayarlar-->
    

    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card p-4 shadow-lg border-0">
            <h4 class="text-center mb-4">Contact Us</h4>
            <div class="mb-3">
              <i class="fa-solid fa-phone me-2 text-primary"></i>
              <strong>Phone:</strong> +90 546 144 5019
            </div>
            <div class="mb-3">
              <i class="fa-solid fa-envelope me-2 text-primary"></i>
              <strong>Email:</strong> contact@aysessrecipes.com
            </div>
            <div class="mb-3">
              <i class="fa-solid fa-map-marker-alt me-2 text-primary"></i>
              <strong>Address:</strong> 123 Recipe Street, Food City, Dessert Country
            </div>
            <div class="text-center">
              You can find our contact information here!
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
