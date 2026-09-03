<?php
require_once 'connection.php';
session_start();

if (!isset($_SESSION['auth'])) {
    echo "Please <a href='login.php'>login</a> to add items to cart.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['quantity'])) {
    // Using 'uid' as the primary key
    $user_id = $_SESSION['auth']['uid']; 
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    // Insert into cart table
    // Ensure the 'cart' table exists in your database
    $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iii", $user_id, $product_id, $quantity);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Product added to cart! <a href='home.php'>Continue shopping</a>";
        } else {
            echo "Failed to add product to cart: " . mysqli_error($conn);
        }
    } else {
        echo "Database error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
