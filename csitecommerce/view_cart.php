<?php
require_once 'header.php';
require_once 'connection.php';

if (!isset($_SESSION['auth'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['auth']['uid'];

// Fetch cart items for the logged-in user joined with product details
$sql = "SELECT c.id AS cart_id, p.title, p.price, c.quantity, (p.price * c.quantity) AS total_price 
        FROM cart c 
        JOIN products p ON c.product_id = p.pid 
        WHERE c.user_id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<h1>Your Shopping Cart</h1>

<table border="1">
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Action</th>
    </tr>
    <?php 
    $grand_total = 0;
    while($row = mysqli_fetch_assoc($result)): 
        $grand_total += $row['total_price'];
    ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td>$<?php echo $row['price']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>$<?php echo $row['total_price']; ?></td>
            <td>
                <a href="remove_from_cart.php?id=<?php echo $row['cart_id']; ?>" 
                   onclick="return confirm('Are you sure you want to remove this item?')">
                   Remove
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
    <tr>
        <td colspan="4" align="right"><strong>Grand Total:</strong></td>
        <td><strong>$<?php echo $grand_total; ?></strong></td>
    </tr>
</table>

<form action="place_order.php" method="post" style="margin-top: 20px;">
    <button type="submit">Place Order</button>
</form>


<?php require_once 'footer.php'; ?>
