<?php
session_start();
@include 'config.php';
require_once 'SQL_login.php';
include_once 'session_timeout.php';

$id = $_GET['edit'];
if (isset($_POST["update_customer"])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    $passwordhash = password_hash($password, PASSWORD_DEFAULT);
    $usertype = "user";

    $validation = data_validation($_POST['email'],  "/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/" , "email");
    $validation .= data_validation($_POST['password'], '/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,12}$/', "password- at least one letter, at least one number, and there have to be 6-12 characters");
    $validation .= data_validation($_POST['phonenumber'], "/^[0-9]{10,11}+$/", "phonenumber");

    if ($password != $password1) {
        echo '<script>
                alert("Password Not Match!");
                document.location = "admin_updatecustomer.php";
                </script>';
    } elseif (empty($firstname) || empty($lastname) || empty($phonenumber) || empty($address) || empty($email) || empty($password) || empty($password1)) {
        $message[] = 'Please fill out all';
    } elseif ($validation == "") {
        $update = "UPDATE users SET firstname ='$firstname', lastname ='$lastname', phonenumber ='$phonenumber', address ='$address', email ='$email', password ='$passwordhash', usertype ='$usertype' WHERE userid = $id";
        $upload = mysqli_query($conn, $update);
        if ($upload) {
            echo '<script>alert("Customer Update Successfully!");
                        document.location="admin_customer.php"</script>';
        } else {
            $message[] = "Customer fail to update";
        }
    }
};

function data_validation($data, $data_pattern, $data_type){
    if (preg_match($data_pattern, $data)) {
        return "";
    } else {
        return " Invalid data for " .  $data_type . ";";
    }
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
if (isset($message)) {
    foreach ($message as $message) {
        echo '<span class = "message">' . $message . '</span>';
    }
}
?>

<div class="container">
    <div class="admin-product-form-container">

        <?php
        $select = mysqli_query($conn, "SELECT * FROM users WHERE userid = $id");
        while ($row = mysqli_fetch_assoc($select)) {


            ?>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                <h3>Update Customer</h3>
                <input type="text" placeholder="Enter First Name" name="firstname" class="box">
                <input type="text" placeholder="Enter Last Name" name="lastname" class="box">
                <input type="text" placeholder="Enter Phone Number" name="phonenumber" class="box">
                <input type="text" placeholder="Enter Address" name="address" class="box">
                <input type="email" placeholder="Enter Email" name="email" class="box">
                <input type="password" placeholder="Enter Password" name="password" class="box">
                <input type="password" placeholder="Re-Enter Password" name="password1" class="box">
                <input type="submit" class="btn" name="update_customer" value="Update Customer">
                <a href="admin_customer.php" class="btn">Go Back</a>
            </form>
        <?php }; ?>
    </div>
</body>
</html>

