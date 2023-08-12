<?php
    require_once 'SQL_login.php';   
try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

    if (isset($_POST['email']) && isset($_POST['pwd'])) {
        $email_temp = sanitise($pdo, $_POST['email']);
        $password_temp = sanitise($pdo, $_POST['pwd']);
        $query = "SELECT * FROM users WHERE email =$email_temp";
        $result = $pdo->query($query);

        if (!$result->rowCount()) {
            echo '<script>alert("User Not Found");
                    document.location = "login.php"</script>';
        };

        $row = $result->fetch();
        $id = $row['userid'];
        $email = $row['email'];
        $password = $row['password'];

        if (password_verify($password_temp, $password)) {
            session_start();
            $_SESSION['userid'] = $id;
            $_SESSION['email'] = $email;
            if ($row['usertype'] == "admin") {
                echo '<script>document.location = "admindashboard.php"</script>';
            } elseif ($row['usertype'] == "user") {
                echo '<script>document.location = "index.php"</script>';
            }
        } else {
            echo '<script>alert("Invalid Password");
                    document.location = "login.php"</script>';
        }
    } else {
        echo '<script>alert("Please enter your email and password")
                document.location = "login.php"</script>';
    }

function sanitise($pdo, $str)
{
    $str = htmlentities($str);
    return $pdo->quote($str);
}
?>