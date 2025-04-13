<?php
$message = null;
include 'header.php';
echo '<h1>Forget Password</h1>';
include 'db.php';
include 'functions.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];    
    $confirm_password = $_POST["confirm_password"];    

    $sql = "UPDATE users SET `password` = '$password' WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);

    if($result === true) {
        $sql = "UPDATE users SET `token` = 'null' WHERE `username` = '$username'";
        $token_null = mysqli_query($conn, $sql);

        header("Location: login.php?msg=The new password has been set successfully🎉");
    }
}

if(array_key_exists('token', $_GET)) {
    $token = $_GET['token'];

    $sql = "SELECT * FROM `users` WHERE `token` = '$token'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $token_result = true;
    }
}

if (isset($token_result) === true) { ?>
    
<form action="reset_password.php" method="post">
    <label for="password"">New Password:</label>
    <input type="password" id="password" name="password" required>
    <input type="hidden" id="username" name="username" value="<?php echo $row['username']; ?>">


    <input type="submit" value="Reset the password"><br>
</form>

<?php } else {
    echo "The Provided token is not valid or expired, <a href='/login.php'>Go Back</a>";
}
include 'footer.php';
?>