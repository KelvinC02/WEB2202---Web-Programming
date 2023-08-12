<?php
    session_start();
    include_once 'session_timeout.php';
    @include 'config.php';
    require_once 'SQL_login.php';


if (isset($_POST['submit'])) {
    try {
        $pdo = new PDO($attr, $user, $pass, $opts);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
    $name = sanitise($pdo, $_POST['name']);
    $email = sanitise($pdo, $_POST['email']);
    $feedback = sanitise($pdo, $_POST['feedback']);

    $validation = data_validation($_POST['email'], "/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/", "email");
    if (($name != "") && ($email != "") && ($feedback != "")) {
      if ($validation == "") {
          $query = "INSERT INTO contactus (id, name, email, feedback) VALUES (NULL, $name, $email, $feedback)";
          $result = $pdo->query($query);
          if (!$result) {
              die("Error: " . mysqli_error());
          } else {
              echo '<script>alert("Your feedback is received")
                    document.location = "contactus.php"</script>';
          }
      } else {
          echo alert($validation);
          echo '<script>document.location = "contactus.php"</script>';
      }
    } else {
      echo '<script>alert("Please fill in all the fields!")
              document.location = "contactus.php"</script>';
    }
}

    function sanitise($pdo, $str)
    {
        $str = htmlentities($str);
        return $pdo->quote($str);
    }

    function data_validation($data, $data_pattern, $data_type)
    {
        if (preg_match($data_pattern, $data)) {
            return "";
        } else {
            return " Invalid data for " . $data_type . ";";
        }
    }

    function alert($str)
    {
        print ("<script>alert('$str')</script>");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="External/css/bootstrap.css">
    <link rel="stylesheet" href="css/contactus.css">
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
    <div class="contact-box">
        <div class="contact-section">
            <div class="contact-info">
                <div class="phone">
                    <img src="media/telephone.png" alt=""></img> 
                    <strong>Phone : +601125567123</strong>
                </div>
                <div class="email">
                <img src="media/email.png" alt=""></img> 
                <strong>Email : contactus@thegreenworld.com</strong>
                </div>
                <div>
                    <img src="media/location.png" alt=""></img> 
                    <a href="location.php">Location</a>
                </div>
        
            </div>
            <div class="contact-form">
                <h2>Feedback Form</h2>
                <form method="post" action="contactus.php">
                    <input type="text" name="name" class="text-box" placeholder="Your Name" required>
                    <input type="text" name="email" class="text-box" placeholder="Your Email" required>
                    <textarea rows="5" name="feedback" placeholder="Your Message" required></textarea>
                <!--Send Feedback Form to Database-->
                <div class="button">
                    <input type="submit" name="submit" value="Submit">
                </div>
                </form>
            </div>
        </div>
    </div>
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