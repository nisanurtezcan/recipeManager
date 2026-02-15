
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ</title>
  <!--Link for the Icons-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="../public/assets/pageImages/logo.png" type="image/x-icon">

</head>

<body>

<?php include("../includes/navbar.php"); ?>

  <!-- Bootstrap Bundle JS (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

    <!--bg-body-tertiary -- rengi otomatik ayarlar-->

  <div class="container mt-5">
    <h2 class="text-center mb-4">Frequently Asked Questions</h2>
    <div class="accordion" id="faqAccordion">
      <!-- Question 1 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="faqHeadingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
            <i class="fa-solid fa-question-circle me-2"></i> Can I submit my own recipes to the site?
          </button>
        </h2>
        <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo"
          data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Yes! We love to feature community recipes. Please register to share your creations. Then, you can login and submit your recipes. Also, you can see other users' recipes!
          </div>
        </div>
      </div>

      <!-- Question 2 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="faqHeadingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree">
            <i class="fa-solid fa-question-circle me-2"></i> Are the recipes beginner-friendly?
          </button>
        </h2>
        <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree"
          data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Absolutely! We have a wide range of recipes, from beginner-friendly dishes to more advanced culinary
            challenges.
          </div>
        </div>
      </div>

      <!-- Question 3 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="faqHeadingFive">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#faqCollapseFive" aria-expanded="false" aria-controls="faqCollapseFive">
            <i class="fa-solid fa-question-circle me-2"></i> How do I contact customer support?
          </button>
        </h2>
        <div id="faqCollapseFive" class="accordion-collapse collapse" aria-labelledby="faqHeadingFive"
          data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            You can reach our support team through the <a href="/pages/contact.html">Contact Us</a> page. We're here
            to help!
          </div>
        </div>
      </div>

    </div>
  </div>

</body>

</html>