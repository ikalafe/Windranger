<?php
session_start();
$message = null;
include 'header.php';
echo "<h1>Login</h1>";
include 'db.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE `username`='$username' AND `password`='$password'";
        $result = mysqli_query($conn, $sql);

        if($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['is_logged'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['user_id'];
            header("Location: user_panel.php");
        } else {
            $message = "Invalid username or password.<br> Please try again, if you can not remember <a href='forget_password.php?username=$username'>Click here</a>";
            $username = $_POST["username"];
        }
    } 
?>

<form action="login.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password"">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
        
    <input type="submit" value="Login"><br>
    <a href="register.php">Need a registeration?</a><br>
</form>
<?php
if(array_key_exists('msg', $_GET)){
    $message = $_GET['msg'];
}
if(isset($message)){
    echo "<p>$message</p>";
}
include 'footer.php';
?>