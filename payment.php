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

        $name = sanitise($pdo, $_POST['fname']);
        $phone = sanitise($pdo, $_POST['phone']);
        $address = sanitise($pdo, $_POST['address']);
        $city = sanitise($pdo, $_POST['city']);
        $state = sanitise($pdo, $_POST['state']);
        $zip = sanitise($pdo, $_POST['zip']);
        $cardname = sanitise($pdo, $_POST['cardname']);
        $cardnumber = sanitise($pdo, $_POST['cardnumber']);
        $expmonth = sanitise($pdo, $_POST['expmonth']);
        $expyear = sanitise($pdo, $_POST['expyear']);
        $cvv = sanitise($pdo, $_POST['cvv']);

        $validation = data_validation($_POST['phone'], "/^[0-9]{10,11}+$/", "phonenumber");
        $validation .= data_validation($_POST['zip'], "/^[0-9]{5}+$/", "zip");
        $validation .= data_validation($_POST['cardnumber'], "/^[0-9]{16}+$/", "cardnumber");
        $validation .= data_validation($_POST['expmonth'], "/^[0-9]{2}+$/", "expmonth");
        $validation .= data_validation($_POST['expyear'], "/^[0-9]{4}+$/", "expyear");
        $validation .= data_validation($_POST['cvv'], "/^[0-9]{3}+$/", "cvv");

        if (($name != "") && ($phone != "") && ($address != "") && ($city != "") && ($state != "") && ($zip != "") && ($cardname != "") && ($cardnumber != "") && ($expmonth != "") && ($expyear != "") && ($cvv != "")) {
            if ($validation == "") {
                echo '<script>alert("You have successfully placed your order! We will send the tracking number to your registered email as soon as possible!")
                        document.location = "index.php"</script>';
                unset($_SESSION["cart_item"]);

            } else {
                echo alert($validation);
                echo '<script>document.location = "checkout.php"</script>';
            }
        } else {
            echo '<script>alert("Please fill in all the details")
                        document.location = "payment.php"</script>';
        }
    }

function sanitise($pdo, $str) {
    $str = htmlentities($str);
    return $pdo -> quote($str);
}

function data_validation($data, $data_pattern, $data_type){
    if (preg_match($data_pattern, $data)) {
        return "";
    } else {
        return " Invalid data for " .  $data_type . ";";
    }
}

function alert($str) {
    print ("<script>alert('$str')</script>");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment</title>
    <link rel="stylesheet" href="External/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/payment.css">
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

<div class ="web-color">
    <div class="billing-container">
        <form method="post" action="payment.php">
            <div class="row">
                <div class="col-50">
                    <h3>Billing Address</h3>

                    <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                    <input type="text" name = "fname" placeholder=""  value="">
                    <label for="phone"><i class="fa fa-phone" aria-hidden="true"></i> Phone</label>
                    <input type="text" name="phone" placeholder=""  value="">
                    <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                    <input type="text" name="address" placeholder=""  value="">
                    <label for="city"><i class="fa fa-institution"></i> City</label>
                    <input type="text" name="city" placeholder=""  value="">

                    <div class="row">
                        <div class="col-50">
                            <label for="state">State</label>
                            <input type="text" name="state" placeholder=""  value="">
                        </div>
                        <div class="col-50">
                            <label for="zip">Zip</label>
                            <input type="text" name="zip" placeholder=""  value="">
                        </div>
                    </div>
                </div>

                <div class="col-50">
                    <h3>Payment</h3>
                    <label for="fname">Accepted Cards</label>
                    <div class="icon-container">
                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                        <i class="fa fa-cc-amex" style="color:blue;"></i>
                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                        <i class="fa fa-cc-discover" style="color:orange;"></i>
                    </div>
                    <label for="cname">Name on Card</label>
                    <input type="text" name="cardname" placeholder=""  value="">
                    <label for="ccnum">Card number</label>
                    <input type="text" name="cardnumber" placeholder=""  value="">
                    <label for="expmonth">Exp Month</label>
                    <input type="text" name="expmonth" placeholder=""  value="">
                    <div class="row">
                        <div class="col-50">
                            <label for="expyear">Exp Year</label>
                            <input type="text" name="expyear" placeholder=""  value="">
                        </div>
                        <div class="col-50">
                            <label for="cvv">CVV</label>
                            <input type="text" name="cvv" placeholder=""  value="">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="billing_btn">Continue to check out</button>
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
