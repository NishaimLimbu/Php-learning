<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSiteCommerce</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav>
        <a href="home.php">Home</a>
        <a href="about.php">About us</a>
        <a href="category.php">Category</a>
        <a href="products.php">Products</a>
        <a href="contact.php">Contact</a>
        <a href="view_cart.php">View Cart</a>
        <?php if(isset($_SESSION['auth'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>
<main style="padding: 20px;">
