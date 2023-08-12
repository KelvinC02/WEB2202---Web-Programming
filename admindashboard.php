<?php
    session_start();
    include_once 'session_timeout.php';
    @include "config.php";

$host = 'localhost';
$db = 'assignment';
$user = 'root';
$pass = '';
$attr = "mysql:host=$host;dbname=$db";
$opts =
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

function getUserAccessRoleByID($id)
{
    global $pdo;
    $query = "select user_type from users where id = " . $id;
    $result = $pdo->query($query);
    $row = $result->fetch();

    return $row['user_role'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard - Multi user role based login</title>
    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="External/css/bootstrap.min.css">
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" type="text/css" href="External/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="External/css/sb-admin.css">
</head>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="All Product">
                <a class="nav-link" href="admin_product.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Show All Product</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add Product">
                <a class="nav-link" href="admin_addproduct.php">
                    <i class="fa fa-fw fa fa-wpforms"></i>
                    <span class="nav-link-text">Add Product</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="All Admin">
                <a class="nav-link" href="admin_admin.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Show All Admin</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add Admin">
                <a class="nav-link" href="admin_addadmin.php">
                    <i class="fa fa-fw fa fa-wpforms"></i>
                    <span class="nav-link-text">Add Admin</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="All Admin">
                <a class="nav-link" href="admin_customer.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Show All Customer</span>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-3" style="padding-left: 1430px">
            <li class="nav-item">
                <a class="nav-link" href="signout.php">
                    <i class="fa fa-fw fa-sign-out"></i>Logout
                </a>
            </li>
        </ul>
    </div>
</nav>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>

        </ol>
        <h1 style="margin: 30px">Welcome to Admin Dashboard</h1>
