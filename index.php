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
  <title>The Green World</title>
  <link rel="stylesheet" href="External/css/bootstrap.css">
  <link rel="stylesheet" href="css/background.css">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="External/mdb5/js/mdb.min.js"></script>
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
    <div class="container p-4" style="background-color:#FCF8E8 ; border-radius: 20px;">
      <div class="row">
        <div class="col-md-5 me-5">
          <h1 style="color: rgb(14, 110, 14);">Meet The Green World</h1>
          <p class="mt-4">
            <i>A Green World, is never an idea anymore. Let it comes into realistic, Let's everyone contribute in it, Let's protect our only Mother Earth</i>
          </p>
          <p class="mt-2">
            - By Mr.Kelvin, Founder of The Green World
          </p>
        </div>
        <div class="col-md-5">
          <video autoplay loop muted class="environment video" style="border-radius: 10px;">
            <source src="media/video.mp4" type="video/mp4">
          </video>
        </div>
      </div>
    </div>
    <div class="trending-product my-5">
      <div class="text-center py-3">
        <h3>Trending Product</h3>
      </div>
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
              <img src="media/secondhand3.jpeg" class="d-block w-100" alt="..." height="300px">
            <div class="carousel-caption d-none d-md-block">
              <h5>Second-Hand Clothes</h5>
              <p></p>
            </div>
          </div>
          <div class="carousel-item">
              <img src="media/secondhand4.jpeg" class="d-block w-100" alt="..." height="300px">
            <div class="carousel-caption d-none d-md-block">
              <h5>Second-Hand Electronics</h5>
              <p></p>
            </div>
          </div>
          <div class="carousel-item">
              <img src="media/secondhand5.jpg" class="d-block w-100" alt="..." height="300px">
            <div class="carousel-caption d-none d-md-block">
              <h5>Second-Hand Furniture</h5>
              <p></p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <div class="container my-5 p-4" style="background-color: #FCF8E8; border-radius: 20px;">
      <div class="row">
        <div class="col-md-6">
          <img src="media/worker.jpg" alt="">
        </div>
        <div class="col-md-6">
          <h5>Our Service</h5>
          <p class="mt-4">
            The Green World provided multiple services with Go Green as the only aim. We provided services such as selling second-hand products and recyclable products which mainly handmade by our workers.
            At all the branches of our company, we had set up a place to receive donation from the public in the form of products. All the products received will go through multiple testing to ensure the quality.
            Our products will always be your first choice and rest assure with the quality. Throwing all the unused products? Why not The Green World? Check us out by clicking the button below.
          </p>
          <a href="location.php">
            <button type="button" class="btn btn-outline-primary">Location</button>
          </a>
        </div>
      </div>
    </div>

    <!-- Carousel wrapper -->
    <div class="text-center">
      <h3>Customer Reviews</h3>
      <div id="carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-mdb-ride="carousel">
        <!-- Inner -->
        <div class="carousel-inner py-4">
          <!-- Single item -->
          <div class="carousel-item active">
            <div class="container">
              <div class="row">
                <div class="col-lg-4">
                  <img class="rounded-circle shadow-1-strong mb-4" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(1).webp" alt="avatar" style="width: 150px;" />
                  <h5 class="mb-3">Anna Deynah</h5>
                  <p>UX Designer</p>
                  <p class="text-muted">
                    <i class="fas fa-quote-left pe-2"></i>
                    Nice Products! I had purchased more than 10 Second-Hand Products from them and they all works fine!
                  </p>
                  <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                  </ul>
                </div>

                <div class="col-lg-4 d-none d-lg-block">
                  <img class="rounded-circle shadow-1-strong mb-4" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(32).webp" alt="avatar" style="width: 150px;" />
                  <h5 class="mb-3">John Doe</h5>
                  <p>Lecturer</p>
                  <p class="text-muted">
                    <i class="fas fa-quote-left pe-2"></i>
                    All the products' quality were assured. The Customer Service is good when I asked for a refund for a broke item once before
                  </p>
                  <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li>
                      <i class="fas fa-star-half-alt fa-sm"></i>
                    </li>
                  </ul>
                </div>

                <div class="col-lg-4 d-none d-lg-block">
                  <img class="rounded-circle shadow-1-strong mb-4" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" alt="avatar" style="width: 150px;" />
                  <h5 class="mb-3">Maria Kate</h5>
                  <p>Photographer</p>
                  <p class="text-muted">
                    <i class="fas fa-quote-left pe-2"></i>
                    I have bought a Second-Hand camera from this company and the camera just work like a new one! Can't believe that
                  </p>
                  <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="far fa-star fa-sm"></i></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Single item -->
          <div class="carousel-item">
            <div class="container">
              <div class="row">
                <div class="col-lg-4">
                  <img class="rounded-circle shadow-1-strong mb-4" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(6).webp" alt="avatar" style="width: 150px;" />
                  <h5 class="mb-3">Anna Deynah</h5>
                  <p>Student</p>
                  <p class="text-muted">
                    <i class="fas fa-quote-left pe-2"></i>
                    I bought different Second-Hand clothes from them...Well the quality is still good and very suitable for student like me who don't have much money
                  </p>
                  <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                  </ul>
                </div>

                <div class="col-lg-4 d-none d-lg-block">
                  <img class="rounded-circle shadow-1-strong mb-4" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(8).webp" alt="avatar" style="width: 150px;" />
                  <h5 class="mb-3">John Doe</h5>
                  <p>Retired</p>
                  <p class="text-muted">
                    <i class="fas fa-quote-left pe-2"></i>
                    I purchased different recyclable products for decoration of my garden. Although it is from recyclable products, but the quality is good
                  </p>
                  <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li>
                      <i class="fas fa-star-half-alt fa-sm"></i>
                    </li>
                  </ul>
                </div>

                <div class="col-lg-4 d-none d-lg-block">
                  <img class="rounded-circle shadow-1-strong mb-4" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(7).webp" alt="avatar" style="width: 150px;" />
                  <h5 class="mb-3">Maria Kate</h5>
                  <p>Preferred not to say</p>
                  <p class="text-muted">
                    <i class="fas fa-quote-left pe-2"></i>
                    I used to buy bag from them as gift for my parent. My mum likes it much! Just that the delivery takes some times but it is still acceptable..
                  </p>
                  <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="far fa-star fa-sm"></i></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Controls -->
        <div class="d-flex justify-content-center mb-4">
          <button class="carousel-control-prev position-relative" type="button" data-mdb-target="#carouselMultiItemExample" data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next position-relative" type="button" data-mdb-target="#carouselMultiItemExample" data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <!-- Inner -->
      </div>
      <!-- Carousel wrapper -->
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