<?php
    session_start();
    include_once 'session_timeout.php';
    @include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <link rel="stylesheet" href="External/css/bootstrap.css">
  <link rel="stylesheet" href="css/aboutus.css">
  <link rel="stylesheet" href="css/background.css">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark px-5">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
          <img src="media/logo2.png" alt="" style="width:70px ; height: 90px; margin-left: 30px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar">
          <ul class="nav nav-pills">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="padding: 0px 50px ; font-size: 20px; color: white;">About Us</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="aboutus.php">About Us</a></li>
                <li><a class="dropdown-item" href="location.php">Location</a></li>
                <li><a class="dropdown-item" href="contactus.php">Contact Us</a></li>
                <li><a class="dropdown-item" href="helpcentre.php">Help Centre</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="padding: 0px 50px ; font-size: 20px; color: white;">Product</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="productcategories.php">All Products</a></li>
                <li><a class="dropdown-item" href="secondhandproduct.php">Second-Hand</a></li>
                <li><a class="dropdown-item" href="recyclableproduct.php">Recyclable</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="padding: 0px 50px ; font-size: 20px; color: white;">Account</a>
                <ul class="dropdown-menu">
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo "<li><a class='dropdown-item' href='cart.php'>View Cart</a></li>";
                        echo "<li><a class='dropdown-item' href='signout.php'>Sign Out</a></li>";
                    } else {
                        echo "<li><a class='dropdown-item' href='register.php'>Register</a></li>";
                        echo "<li><a class='dropdown-item' href='login.php'>Sign In</a></li>";
                    }
                    ?>
                </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="padding: 0px 50px ; font-size: 20px; color: white;">Cart</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="cart.php">Show Cart</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main class="my-5">
    <div class="container">
      <div class="row p-4" style="background-color:#FCF8E8 ; border-radius: 20px;">
        <div class="col-md-7">
          <img src="media/logo2.png" alt="" width="250px" height="300px">
        </div>
        <div class="col-md-5" style="align-self:center ;">
          <h1>About Us</h1>
        </div>
      </div>
      <div class="row">
        <div class="bg-secondary text-white my-5 py-4 px-5">
          <div class="title" style="align-content: center; text-align: center;">
            <h3>Brand History</h3>
          </div>
          <div class="content">
            <p><b>The Green World</b> is a company under Mr. Kelvin with the intention of "Go Green". The risen of the amount of wastes over the World had became a serious issue. The Green World has always adhered to the concept of "As Green As Possible". We take all our minor efforts together and make it big.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <h1 style="align-items:center; text-align:center;">Mission</h1>
      <div class="mission-frame">
        <div class="mission-container">
          <div class="mission-image">
            <img src="media/green.jpg" alt="Brand Philosophy">
          </div>
          <div class="Mission_Text">
            <h3>Brand Philosophy</h3>
              <p>The Green World are always committed to the mission of creating a better and healthier planet to all the residents of our Mother Earth. We seeks to provide customers with quality assured second-hand products and self-made products from recyclable items. Make 3R (Reduce, Reuse, Recycle) comes in once.</p>
          </div>
        </div>
        <div class="mission-container">
          <div class="mission-image">
            <img src="media/vision.png" alt="Brand Vision">
          </div>
          <div class="mission-text">
            <h3>Vision</h3>
            <p>As one of the residents of our Mother Earth, Go Green is an essential characteristic that everyone should practice. The Green World is committed in encouraging more people to realise on the importance of "GREEN" by taking their effort in solving this global issue of excessive wastes.</p>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
<!-- Footer -->
<footer class="text-center text-lg-start text-muted py-3">
  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i></i>The Green World
          </h6>
          <p>
            The Green World is a company running businesses that focus on the marketing of various products specifically in Selangor state was founded by Mr Kelvin in the year 2020
            with the rising of various environmental issues and promotion of the United States Sustainable Development Goals
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Products
          </h6>
          <p>
            <a href="secondhandproduct.php" class="text-reset">Second-Hand</a>
          </p>
          <p>
            <a href="recyclableproduct.php" class="text-reset">Recyable</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="index.php" class="text-reset">Home Page</a>
          </p>
          <p>
            <a href="aboutus.php" class="text-reset">About Us</a>
          </p>
          <p>
            <a href="productcategories.php" class="text-reset">Products</a>
          </p>
          <p>
            <a href="login.php" class="text-reset">Login</a>
          </p>
        </div>
      </div>
      <!-- Grid row -->
    </div>
  </section>

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2022 Copyright:
    <div class="text-reset fw-bold">The Green World</d>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->

</html>