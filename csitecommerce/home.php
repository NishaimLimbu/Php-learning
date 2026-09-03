<?php 
require_once 'header.php';
require_once 'connection.php';

$sql="SELECT * FROM products";
$result=mysqli_query($conn,$sql);
?>

<h1>Product List</h1>

<ul class="product-list">
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <li class="product-item">
            <img src="uploads/<?php echo $row['image']?>" 
            width="200" height="200" alt="">
            <h2><?php echo $row['title']; ?></h2>
            <p><?php echo $row['description']; ?></p>
            <p>Price: $<?php echo $row['price']; ?></p>
            <p>
                <a href="product_details.php?id=<?php echo $row['pid']; ?>">
                    Product Details
                </a> 
            </p>
            <p>
                <!-- now add to cart -->
                <form action="cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $row['pid']; ?>">
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit">Add to Cart</button>
            </p>
        </li>
    <?php endwhile; ?>
</ul>

<?php 
require_once 'footer.php';
?>