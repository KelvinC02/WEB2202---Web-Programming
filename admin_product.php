<?php
    session_start();
    @include 'config.php';
    include_once 'session_timeout.php';

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM product WHERE id = $id");
        header("Location: admin_product.php");
    }
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
    $select = mysqli_query($conn, "SELECT * FROM product");
?>
<div class="container">
    <div class="product-display">
        <table class="product-display-table">
        <thead>
        <tr>
            <td>Product Image</td>
            <td>Product Name</td>
            <td>Product Code</td>
            <td>Product Price</td>
            <td>Product Type</td>
            <td>Product Details</td>
            <td colspan="2">Action</td>
        </tr>
        </thead>
            <?php
                while ($row = mysqli_fetch_assoc($select)) {

            ?>
            <tr>
                <td><img src="<?php echo $row['image'];?>" height="200px" width="200px"></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['code'];?></td>
                <td><?php echo "RM " .  number_format($row['price'], 2);?></td>
                <td><?php echo $row['product_type'];?></td>
                <td><?php echo $row['product_details'];?></td>
                <td>
                    <a href="admin_updateproduct.php?edit=<?php echo $row['id'];?>" class="btn"
                        <i class="fas fa-edit"></i> Edit </a>
                    <a href="admin_product.php?delete=<?php echo $row['id'];?>" class="btn"
                        <i class="fas fa-trash"></i> Delete </a>
                </td>
            </tr>
            <?php }; ?>
        </table>
        <a href="admindashboard.php" class="btn">Go Back</a>
    </div>
</div>
</body>
</html>
