<?php 
require_once 'header.php';
require_once 'connection.php';

if(!empty($_POST)){
    $email = $_POST['email'];
    $password=md5($_POST['password']);
    $query="SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        $user = mysqli_fetch_assoc($result);
        $_SESSION['auth'] =$user;
        header("Location:dashboard.php");
    } else {
        echo "Invalid email or password";
    }
}
?>
<h1>login</h1>
<form action="" method="post">
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button>Login</button>
</form>
<?php 
require_once 'footer.php';
?>