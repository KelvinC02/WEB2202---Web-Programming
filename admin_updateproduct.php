<?php
    session_start();
    @include 'config.php';
    include_once 'session_timeout.php';

    $id = $_GET['edit'];
    if (isset($_POST["update_product"])) {
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

        if (empty($product_name) || empty($product_code) || empty($product_price) || empty($product_image) || empty($product_details)) {
            $message[] = 'Please Fill Out All';
        } else {
            $update = "UPDATE product SET name = '$product_name', code = '$product_code', price = '$product_price', image = '$product_image_2', product_details = '$product_details', product_type = '$product_type' WHERE id = $id";
            $upload = mysqli_query($conn, $update);
            if ($upload) {
                move_uploaded_file($product_image_tmp_name, $product_image_folder);
                echo '<script>alert("Product Updated successfully!")
                            document.location="admin_product.php"</script>';
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
            echo '<span class = "message">' . $message . '</span>';
        }
    }
?>

<div class="container">
    <div class="admin-product-form-container">

        <?php
            $select = mysqli_query($conn, "SELECT * FROM product WHERE id = $id");
            while ($row = mysqli_fetch_assoc($select)) {


        ?>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <h3>Update The Product</h3>
            <input type="text" placeholder="Enter Product Name" value="<?php $row['name'];?>" name="product_name" class="box">
            <input type="text" placeholder="Enter Product Code" value="<?php $row['price'];?>" name="product_code" class="box">
            <input type="number" placeholder="Enter Product Price" name="product_price" class="box">
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
            <input type="text" placeholder="Enter Product Details" name="product_details" class="box">
            <input type="radio" id="second-hand" name="product_type" value="Second-Hand">
            <label for="second-hand">Second-Hand</label>
            <input type="radio" id="recyclable-items" name="product_type" value="Recyclable-Items">
            <label for="recyclable-items">Recyclable-Items</label>
            <input type="submit" class="btn" name="update_product" value="Update Product">
            <a href="admin_product.php" class="btn">Go Back</a>
        </form>
        <?php }; ?>
    </div>
</body>
</html>

