<?php
session_start();
include_once 'session_timeout.php';
require_once 'dbcontroller.php';
@include "config.php";

$db_handle = new DBController();
if(!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM product WHERE code='" . $_GET["code"] . "'");
                //get the first data only with index [0]
                $itemArray = array($productByCode[0]["code"] => array('name' => $productByCode[0]["name"],
                    'code' => $productByCode[0]["code"], 'quantity' => $_POST["quantity"],
                    'price' => $productByCode[0]["price"], 'image' => $productByCode[0]["image"]));

                if (!empty($_SESSION["cart_item"])) {
                    //checking new add item with currect Cart
                    if (in_array($productByCode[0]["code"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {

                            if ($productByCode[0]["code"] == $k) {
                                //if the quantity  is empty, starting the quantity from Zero
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                //if the item already in the Cart, add the quantity
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } //if current item is not in the cart, add the item
                    else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    //if the session is empty, start the new session.
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="External/css/bootstrap.css">
    <link rel="stylesheet" href="css/background.css">
    <link rel="stylesheet" href="css/productdetails.css">
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
                    <li><a class="dropdown-item" href="checkout.php">Checkout</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
  </header>
    <main class="mt-5">
        <?php
            $conn = mysqli_connect("localhost","root", "", "assignment");
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $sql = "SELECT * FROM product WHERE id = $id";
                $retval = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($retval)) {

        ?>
        <div class="container">
            <div class="row">
                <div class="col">
                    <img src="<?php echo $row["image"]; ?>" alt="" style="width: 400px; height: 400px">
                </div>
                <div class="col-md-7">
                    <h4>
                        <?php
                            if ($row["product_details"] == null) {
                                echo $row["name"];
                            } else {
                                echo $row["name"];
                                echo " - " . $row["product_details"];
                            }
                        ?>
                    </h4>
                    <div class="price text-center mt-5" style="font-size:20px ;">
                        <b><?php echo "RM " . $row["price"]?></b>
                    </div>
<!--                    <div class="row mt-4">-->
<!--                        <div class="col-md-3 mt-4">-->
<!--                            <h5>Condition: </h5>-->
<!--                        </div>-->
<!--                        <div class="col-md-5 mt-3">-->
<!--                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">-->
<!--                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>-->
<!--                                <label class="btn btn-outline-primary" for="btnradio1">70% New</label>-->
<!---->
<!--                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">-->
<!--                                <label class="btn btn-outline-primary" for="btnradio2">95% New</label>-->
<!--                              </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="row mt-4">
                        <div class="col-md-3 mt-4">
                            <h5>Quantity: </h5>
                        </div>
                        <div class="col-md-5" style="margin-top: 23px">
                            <form method="post" action="cart.php?action=add&code=<?php echo $row["code"]; ?>">
                                    <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="36" style="text-align: center"/>
                                        <div class="row mt-4 ms-1">
                                        <input type="submit" class="btn btn-outline-primary btn-lg" value="Add to Cart">
                                        </div>
                            </form>
<!--                            <form action="#" method="post">-->
<!--                            <select class="form-select" aria-label="Default select example" name="number[]">-->
<!--                                <option selected>(Quantity)</option>-->
<!--                                <option value="1">One</option>-->
<!--                                <option value="2">Two</option>-->
<!--                                <option value="3">Three</option>-->
<!--                                <option value="4">Four</option>-->
<!--                                <option value="5">Five</option>-->
<!--                                <option value="6">Six</option>-->
<!--                                <option value="7">Seven</option>-->
<!--                                <option value="8">Eight</option>-->
<!--                                <option value="9">Nine</option>-->
<!--                              </select>-->
<!--                                --><?php
//                                    $numbers = $_POST["number[]"];
//                                ?>
<!--                            </form>-->
<!--                            </div>-->
<!--                        <div class="col" style="margin-top: 20px">-->
<!--                            <form action="#" method="post">-->
<!--                            <input type="submit" name="confirm" value="Confirm">-->
<!--                            </form>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
            <?php
            }
            }
            ?>
        </div>
    </main>
</body>
<!-- Footer -->
<br>
<br>
<br>
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