<?php
require_once 'connection.php';
session_start();

if (!isset($_SESSION['auth']) || !isset($_GET['id'])) {
    header("Location: view_cart.php");
    exit;
}

$cart_id = intval($_GET['id']);
$user_id = $_SESSION['auth']['uid'];

// Delete the item only if it belongs to the logged-in user
$sql = "DELETE FROM cart WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $cart_id, $user_id);
mysqli_stmt_execute($stmt);

header("Location: view_cart.php");
exit;
?>
