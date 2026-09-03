<?php
require_once 'header.php';
require_once 'connection.php';

$id=$_GET['id'];

$sql="SELECT users.uid,users.name as username,category.*,products.* FROM products
JOIN users ON users.uid=products.user_id 
JOIN category ON category.cid=products.category_id
WHERE products.pid='$id'";

$result=mysqli_query($conn,$sql);
$product = mysqli_fetch_assoc($result);
?>

<h1>Product Details</h1>
<h2><?php echo $product['title']; ?></h2>
  <img src="uploads/<?php echo $product['image']?>" 
            width="200" height="200" alt="">
<p>
    Category: <?php echo $product['name']; ?>
    Vendor: <?php echo $product['username']; ?>
</p>
<p>Price: $<?php echo $product['price']; ?></p>
<p>Description: <?php echo $product['description']; ?></p>