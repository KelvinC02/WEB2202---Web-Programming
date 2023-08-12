<?php
session_start();
@include 'config.php';
include_once 'session_timeout.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE userid = $id");
    header("Location: admin_customer.php");
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
$select = mysqli_query($conn, "SELECT * FROM users WHERE usertype = 'user'");
?>
<div class="container">
    <div class="product-display">
        <table class="product-display-table">
            <thead>
            <tr>
                <td>Customer First Name</td>
                <td>Customer Last Name</td>
                <td>Customer Phone Number</td>
                <td>Customer Address</td>
                <td>Customer Email</td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($select)) {

                ?>
                <tr>
                    <td><?php echo $row['firstname'];?></td>
                    <td><?php echo $row['lastname'];?></td>
                    <td><?php echo $row['phonenumber'];?></td>
                    <td><?php echo $row['address'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td>
                        <a href="admin_updatecustomer.php?edit=<?php echo $row['userid'];?>" class="btn"
                        <i class="fas fa-edit"></i> Edit </a>
                        <a href="admin_customer.php?delete=<?php echo $row['userid'];?>" class="btn"
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
