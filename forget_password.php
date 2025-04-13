<?php
$message = null;
include 'header.php';
echo '<h1>Forget Password</h1>';
include 'db.php';
include 'functions.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];    

    $sql = "SELECT * FROM `users` WHERE `username`='$username'";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        $random_string = md5(generateRandomString(10));
        $sql = "UPDATE `users` SET `token` = '$random_string' WHERE `username` = '$username'";
        $update_result = mysqli_query($conn, $sql);

        $reset_url = "<a href='http://" . $_SERVER['HTTP_HOST'] . "/reset_password.php?token=$random_string'>Click here to reset your password</a>";
        print($reset_url);
        $message = "The reset link has been sent to your email address: " . $row['email'];
    }
}
?>

<form action="forget_password.php" method="post">

    <label for="username"">Username:</label>
    <input type="username" id="username" name="username" value="<?php if(array_key_exists("username", $_GET)) echo $_GET["username"]; ?>" required>
        
    <input type="submit" value="Reset"><br>
</form>

<?php
if(isset($message)) {
    echo "<p>$message</p>";
}
include 'footer.php'
?>