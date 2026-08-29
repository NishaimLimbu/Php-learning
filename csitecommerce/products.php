<?php
require_once "header.php";
require_once "connection.php";

if(!isset($_SESSION['auth'])){
    header("Location:category.php");

}
if (!empty($_POST)){
    $name=$_POST['name'];
    $sql = "INSERT INTO products (name) VALUES ('$name')";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Product added sucessfully";
    }else{
        echo "Product not added";
    }
}
?>
<h1>Product</h1>
<form action="" method="post">
    Name: <input type="text" name="name" required><br>
    Quantity : <input type="number" name="quantity" required><br>
    Price : <input type="number" name="price" required><br>
    <button type="submit">Add Product</button>
</form>
<?php
require_once "footer.php";
?>