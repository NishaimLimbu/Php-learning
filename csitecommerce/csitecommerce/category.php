<?php
require_once "header.php";
require_once "connection.php";

if(!isset($_SESSION['auth'])){
    header("Location:login.php");

}
if (!empty($_POST)){
    $name=$_POST['name'];
    $sql = "INSERT INTO category (name) VALUES ('$name')";
    $result = mysqli_query($conn, $sql);
    if ($result){
        $_SESSION['success']="Category added sucessfully";
        header ("Location:category.php");
        }else{
        $_SESSION['error']="Category added sucessfully";
        header ("Location:category.php");
    }
}
$querry="SELECT * FROM category";
$cat=mysqli_query($conn, $querry);
?>
<h1>Category</h1>
<form action="" method="post">
    Name: <input type="text" name="name" required><br>
    <button>Add Category</button>
</form>
<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>Name</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($cat)):?>
    <tr>
        <td><?php echo $row['cid']; ?></td>
        <td><?php echo $row['name']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php
require_once "footer.php";
?>