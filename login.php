<?php
    session_start();
    include_once 'session_timeout.php';
    @include "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Login</title>
    <link rel="stylesheet" href="External/css/bootstrap.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/background.css">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>
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
    <main class="mt-5">
        <div class = "login">
            <div class = "login_container">
                <img src = "media/login.png" alt="" class = "logo_login">
                <h1>Log In Here</h1>
                <form action="userlogin.php" method="post">
                    <p>Email :</p>
                    <input type = "text" name="email" placeholder="Enter Your Email" required>
                    <p>Password :</p>
                    <input type = "password" name="pwd" placeholder="Enter Your Password" required>
					          <button type="submit" name="submit">Log In</button>
					          <br> 
                    <br>
                    <a href = "#">Forget Password ?</a>
                    <br>
                    <a href = "register.php">Don't have an account ?</a>
                </form>
            </div>
        </div>
    </main>
</body>
<br>
<br>
<br>
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