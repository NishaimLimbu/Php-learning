<?php 
require_once 'header.php';
require_once 'connection.php';

if(!empty($_POST)){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $gender=$_POST['gender'];
    $sql="INSERT INTO users(name,email,password,gender) 
    VALUES('$name','$email','$password','$gender')";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "Account created successfully";
    }else{
        echo "Account creation failed";
    }
}

?>
<h1>register</h1>

<form action="" method="post">
    Name: <input type="text" name="name" required><br> <br>
    Email: <input type="email" name="email" required><br> <br>
    Password: <input type="password" name="password" required><br> <br>
    Gender: <select name="gender" required>
        <option value="">Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="others">Other</option>
    </select><br> <br>
    <button>Create Account</button>
</form>


<?php 
require_once 'footer.php';
?>