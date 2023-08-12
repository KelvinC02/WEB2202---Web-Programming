<?php
    session_start();
    include_once 'session_timeout.php';
    @include 'config.php';
    if (isset($_POST["add_product"])) {
        $product_name = $_POST["product_name"];
        $product_code = $_POST["product_code"];
        $product_price = $_POST["product_price"];
        $product_image = $_FILES["product_image"]["name"];
        $product_image_tmp_name = $_FILES["product_image"]["tmp_name"];
        $product_image_folder = 'media/' . $product_image;
        $product_details = $_POST["product_details"];
        $product_image_2 = "media/" . $product_image;
        if (!empty($_POST["product_type"])) {
            $product_type = $_POST["product_type"];
        }

        if (empty($product_name) || empty($product_code) || empty($product_price) || empty($product_image)) {
            $message[] = 'please fill out all';
        } else {
            $insert = "INSERT INTO product(name, code, image, price, product_type, product_details) VALUES ('$product_name', '$product_code', '$product_image_2', '$product_price', '$product_type', '$product_details')";
            $upload = mysqli_query($conn, $insert);
            if ($upload) {
                move_uploaded_file($product_image_tmp_name, $product_image_folder);
                echo '<script>alert("New Product added successfully!")
                        document.location="admindashboard.php"</script>';
            } else {
                $message[] = 'Product fail to add';
            }
        }
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.css">
    <link rel="stylesheet" href="css/addproduct.css">
</head>
<body>
<?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo "<span class='message'>.$message.</span>";
        }
    }
?>
    <div class="container">
        <div class="admin-product-form-container">
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                <h3>Add New Product</h3>
                <input type="text" placeholder="Enter Product Name" name="product_name" class="box">
                <input type="text" placeholder="Enter Product Code" name="product_code" class="box">
                <input type="number" placeholder="Enter Product Price" name="product_price" class="box">
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
                <input type="text" placeholder="Enter Product Details" name="product_details" class="box">
                <input type="radio" id="second-hand" name="product_type" value="Second-Hand">
                <label for="second-hand">Second-Hand</label>
                <input type="radio" id="recyclable-items" name="product_type" value="Recyclable-Items">
                <label for="recyclable-items">Recyclable-Items</label>
                <input type="submit" class="btn" name="add_product" value="Add Product">
                <a href="admindashboard.php" class="btn">Go Back</a>
            </form>
        </div>
    </div>
</body>
</html>