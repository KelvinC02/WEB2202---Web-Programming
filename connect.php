<?php
    session_start();
    include_once 'session_timeout.php';
    require_once 'SQL_login.php';
    if (isset($_POST['email']) && isset($_POST['password'])) {
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
        $usertype = sanitise($pdo, $_POST['user_type']);

        $validation = data_validation($_POST['email'],  "/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/" , "email");
        $validation .= data_validation($_POST['password'], '/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,20}$/', "password- at least one letter, at least one number, and there have to be 6-12 characters");
        $validation .= data_validation($_POST['phonenumber'], "/^[0-9]{10,11}+$/", "phonenumber");

        $sql = "SELECT * FROM users WHERE email = $email";
        $re = $pdo->query($sql);
        $rw = $re->fetch();

        if ($rw > 0) {
            echo '<script>alert("Email taken! Please choose another email");
                    document.location = "register.php"</script>';
            exit();
        } elseif ($password != $password1) {
            echo '<script>alert("Please enter the same password!");
                    document.location = "register.php"</script>';
        } else {
            if ($validation == "") {
                $query = "INSERT INTO users (userid, firstname, lastname, phonenumber, address, email, password, usertype) VALUES (NULL, $firstname, $lastname, $phonenumber, $address, $email, '$passwordhash', $usertype)";
                $result = $pdo->query($query);
                if (!$result) {
                    die("Error: " . mysqli_error());
                }
                echo '<script>alert("You have successfully register! Back to login");
                        document.location = "login.php"</script>';
            } else {
                echo alert($validation);
                echo '<script>document.location = "register.php"</script>';
            }
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
