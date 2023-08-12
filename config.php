<?php
    $conn = mysqli_connect("localhost", "root", "", "assignment");

    if (!$conn) {
        echo "Database connection failed";
    }

    $tables = array("CREATE TABLE IF NOT EXISTS product(
                        id INT(11) PRIMARY KEY AUTO_INCREMENT,
                        name VARCHAR(255),
                        code VARCHAR(255),
                        image VARCHAR(255),
                        price VARCHAR(255),
                        product_type VARCHAR(255),
                        product_details VARCHAR(255))",

                "CREATE TABLE IF NOT EXISTS users(
                    userid INT(11) PRIMARY KEY AUTO_INCREMENT,
                    firstname VARCHAR(100),
                    lastname VARCHAR(100),
                    phonenumber VARCHAR(50),
                    address VARCHAR(255),
                    email VARCHAR(255),
                    password VARCHAR(255),
                    usertype VARCHAR(50))",

                "CREATE TABLE IF NOT EXISTS contactus(
                    id INT(11) PRIMARY KEY AUTO_INCREMENT,
                    name VARCHAR(255),
                    email VARCHAR(255),
                    feedback VARCHAR(255))",


                "CREATE TABLE IF NOT EXISTS testing(
                    id INT(11) PRIMARY KEY AUTO_INCREMENT,
                    name VARCHAR(255))");


        for ($i = 0; $i < count($tables); $i++) {
            $conn->query($tables[$i]);

}
?>