<?php
require_once 'header.php';
require_once 'connection.php';

if(!isset($_SESSION['auth'])){
    header("Location:login.php");
    exit;
}

$query = "SELECT * FROM category";
$data = mysqli_query($conn, $query);

if(!empty($_POST)) {

    $userId = $_SESSION['auth']['uid'];
    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    if(!move_uploaded_file($tmp_name, "uploads/$image")){
        echo "Image upload failed";
    }

    $query = "INSERT INTO products 
    (user_id, category_id, title, quantity, price, description, image)
    VALUES 
    ('$userId', '$category_id', '$title', '$quantity', '$price', '$description', '$image')";

    $result = mysqli_query($conn, $query);

    if($result) {
        echo "Product added successfully";
    }
    else {
        echo "Product not added";
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">

    Category:
    <select name="category_id" required>
        <option value="">Select Category</option>

        <?php foreach($data as $cat){ ?>
            <option value="<?php echo $cat['cid']; ?>">
                <?php echo $cat['name']; ?>
            </option>
        <?php } ?>

    </select>
    <br>

    Title:
    <input type="text" name="title" required>
    <br>

    Quantity:
    <input type="number" name="quantity" required>
    <br>

    Price:
    <input type="number" name="price" required>
    <br>

    Description:
    <input type="text" name="description" required>
    <br>

    Image:
    <input type="file" name="image" required>
    <br>

    <button type="submit">ADD PRODUCT</button>

</form>
