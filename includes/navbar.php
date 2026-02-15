<?php 
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$is_logged_in = isset($_SESSION['id']);
$username = $_SESSION['username'] ?? 'Guest';
$current_page = $current_page ?? '';
?>

<nav class="navbar navbar-expand-lg" style="background-color: #4a2040;">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center text-white" href="index.php">
        <img src="../public/assets/pageImages/logo.png" alt="Logo" width="70" height="70">
        <span class="ms-2">Ayse's Pink Recipe Book</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon" style="filter: invert(1)"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-white <?= $current_page === 'home' ? 'active fw-bold' : '' ?>" href="index.php">
              <i class="fa-solid fa-house ms-2"></i> Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white <?= $current_page === 'about' ? 'active fw-bold' : '' ?>" href="aboutUs.php">
              <i class="fa-solid fa-users ms-2"></i> About Us
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white <?= $current_page === 'contact' ? 'active fw-bold' : '' ?>" href="contact.php">
              <i class="fa-solid fa-phone ms-2"></i> Contact
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white <?= $current_page === 'faq' ? 'active fw-bold' : '' ?>" href="faq.php">
              <i class="fa-solid fa-question ms-2"></i> FAQs
            </a>
          </li>
        </ul>

        <ul class="navbar-nav d-flex flex-row align-items-center ms-lg-4">
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
              <a href="login.html" class="btn btn-outline-light me-2">Login</a>
            </li>
            <li class="nav-item">
              <a href="register.html" class="btn btn-light text-dark">Register</a>
            </li>
          <?php endif; ?>
        </ul>

      </div>
    </div>
</nav>