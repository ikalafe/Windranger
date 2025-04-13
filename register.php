<?php
include 'header.php';
echo '<h1>Registration</h1>';
include 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if username or email already exists
    $check_sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $check_result = mysqli_query($conn, $check_sql);

    if(mysqli_num_rows($check_result) > 0) {
        echo "<p style='color: red;'>This username or email is already registered. Please choose different ones.</p>";
    } else {
        try {
            $sql = "INSERT INTO `users` (`username`, `email`, `password`) VALUE ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $sql);

            if($result === true) {
                header("Location: login.php?msg=You have registered successfully🎉, Please Login");
            }
        } catch (mysqli_sql_exception $e) {
            var_dump($e->getMessage());
        }
    }
}
?>

<form action="register.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="email"">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password"">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
        
    <input type="submit" value="Register"><br>
    <a href="login.php">You've already an account?</a>
</form>

<?php
include 'footer.php';
?>