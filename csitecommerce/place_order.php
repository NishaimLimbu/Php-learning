<?php
require_once 'connection.php';
session_start();

if (!isset($_SESSION['auth'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['auth']['uid'];

// 1. Calculate Total and fetch items
$sql = "SELECT p.pid, p.price, c.quantity 
        FROM cart c 
        JOIN products p ON c.product_id = p.pid 
        WHERE c.user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$total_amount = 0;
$cart_items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $total_amount += ($row['price'] * $row['quantity']);
    $cart_items[] = $row;
}

if (empty($cart_items)) {
    echo "Your cart is empty.";
    exit;
}

// 2. Insert into orders table
$sql_order = "INSERT INTO orders (user_id, total_amount) VALUES (?, ?)";
$stmt_order = mysqli_prepare($conn, $sql_order);
mysqli_stmt_bind_param($stmt_order, "id", $user_id, $total_amount);
mysqli_stmt_execute($stmt_order);
$order_id = mysqli_insert_id($conn);

// 3. Insert items into order_items table
$sql_item = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
$stmt_item = mysqli_prepare($conn, $sql_item);

foreach ($cart_items as $item) {
    mysqli_stmt_bind_param($stmt_item, "iiid", $order_id, $item['pid'], $item['quantity'], $item['price']);
    mysqli_stmt_execute($stmt_item);
}

// 4. Clear the cart
$sql_clear = "DELETE FROM cart WHERE user_id = ?";
$stmt_clear = mysqli_prepare($conn, $sql_clear);
mysqli_stmt_bind_param($stmt_clear, "i", $user_id);
mysqli_stmt_execute($stmt_clear);

echo "Order placed successfully! Your Order ID is: " . $order_id . ". <a href='home.php'>Continue shopping</a>";
?>
