<?php
    session_start();
    include_once 'session_timeout.php';
    @include "config.php";
    require_once 'SQL_login.php';
    if (isset($_POST["add_admin"])) {
        try {
            $pdo = new PDO($attr, $user, $pass, $opts);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $firstname = sanitise($pdo, $_POST['firstname']);
        $lastname = sanitise($pdo, $_POST['lastname']);
        $phonenumber = sanitise($pdo, $_POST['phonenumber']);
        $address = sanitise($pdo, $_POST['address']);
        $email = sanitise($pdo, $_POST['email']);
        $password = sanitise($pdo, $_POST['password']);
        $password1 = sanitise($pdo, $_POST['password1']);
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
        $usertype = "admin";

        $validation = data_validation($_POST['email'], "/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/", "email");
        $validation .= data_validation($_POST['password'], '/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,20}$/', "password- at least one letter, at least one number, and there have to be 6-12 characters");
        $validation .= data_validation($_POST['phonenumber'], "/^[0-9]{10,11}+$/", "phonenumber");

        $sql = "SELECT * FROM users WHERE email = $email";
        $re = $pdo->query($sql);
        $rw = $re->fetch();

        if ($rw > 0) {
            echo '<script>alert("Email taken! Please choose another email");
                document.location = "admin_addadmin.php"</script>';
        } else {
            if ($password != $password1) {
                echo '<script>
                    alert("Password Not Match!");
                    document.location = "admin_addadmin.php";
                    </script>';
            } elseif (empty($firstname) || empty($lastname) || empty($phonenumber) || empty($address) || empty($email) || empty($password) || empty($password1)) {
                $message[] = 'Please fill out all';
            } elseif ($validation == "") {
                $insert = "INSERT INTO users(firstname, lastname, phonenumber, address, email, password, usertype) VALUES ($firstname, $lastname, $phonenumber, $address, $email, '$passwordhash', '$usertype')";
                $upload = mysqli_query($conn, $insert);
                if ($upload) {
                    echo '<script>alert("New Admin added successfully");
                            document.location="admindashboard.php"</script>';
                } else {
                    $message[] = "Admin fail to add";
                }
            }
        }
    }
function data_validation($data, $data_pattern, $data_type){
    if (preg_match($data_pattern, $data)) {
        return "";
    } else {
        return " Invalid data for " .  $data_type . ";";
    }
}

function sanitise($pdo, $str) {
    $str = htmlentities($str);
    return $pdo -> quote($str);
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
        echo "<span class='message'>.$message.</span>";
    }
}
?>
<div class="container">
    <div class="admin-product-form-container">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <h3>Add New Admin</h3>
            <input type="text" placeholder="Enter First Name" name="firstname" class="box">
            <input type="text" placeholder="Enter Last Name" name="lastname" class="box">
            <input type="text" placeholder="Enter Phone Number" name="phonenumber" class="box">
            <input type="text" placeholder="Enter Address" name="address" class="box">
            <input type="email" placeholder="Enter Email" name="email" class="box">
            <input type="password" placeholder="Enter Password" name="password" class="box">
            <input type="password" placeholder="Re-Enter Password" name="password1" class="box">
            <input type="submit" class="btn" name="add_admin" value="Add Admin">
            <a href="admindashboard.php" class="btn">Go Back</a>
        </form>
    </div>
</div>
</body>
</html>
