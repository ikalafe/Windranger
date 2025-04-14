<?php
session_start();
include 'header.php';
include 'db.php';
if(isset($_SESSION['is_logged']) === true){

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user_id = $_POST['user_id'];
        $first_name = mysqli_real_escape_string($conn,$_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn,$_POST['last_name']);
        $bio = mysqli_real_escape_string($conn,$_POST['bio']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);

        if($password === "") {
            $sql = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `bio` = '$bio' WHERE `user_id` = " . intval($user_id);

        } else {
            $sql = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `bio` = '$bio', `password` = '$password' WHERE `user_id` = " . intval($user_id);
            $password_change = true;
        }

        try {
            $result = mysqli_query($conn, $sql);

            if($result === true) {
                if($password_change === true) header("Location: logout.php");
                else header("Location: settings.php");
            }
        } catch (mysqli_sql_exception $e) {
            $message = $e->getMessage();
            print($message);
        }
        exit;
    }

    try {
        $sql = "SELECT * FROM `users` WHERE `user_id` = " . $_SESSION['user_id'];
        $result = mysqli_query($conn, $sql);
        $user_information = mysqli_fetch_assoc($result);

        // print_r($user_information);
    } catch (mysqli_sql_exception $e) {
        $message = $e->getMessage();
    }
?>

<body>
    <nav>
        <ul>
            <li><a href="#home">Panel</a></li>
            <li><a href="#about">Write</a></li>
            <li><a href="#services">My Posts</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php">Logout </a>(<?php echo $_SESSION['username'] ?>)</li>
        </ul>
    </nav>

    <main>
        <div class="container">
            <section class="hero">
                <h2>Settings</h2>
                <p>This is a simple and smooth template for your website. Customize it to fit your needs!</p>
            </section>

            <img src="<?= '/statics/images/' . md5($_SESSION['user_id']) . '.jpg'; ?>" onerror="this.src='/statics/images/image_profile.jpg'"><img>

            <input type="file" id="imageUpload" accept="image/*">
            <progress id="uploadProgress" max="100" value="0"></progress>
            <button id="uploadButton">Upload</button>
            <div id="message"></div>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
            <script src="/statics/upload.js"></script>

            <form action="settings.php" method="POST">
                <input type="hidden" name="user_id" value="<?= $user_information['user_id']; ?>">

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?=$user_information['username'];?>" disabled><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?=$user_information['email'];?>" disabled><br><br>

                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?=$user_information['first_name'];?>"><br><br>

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?=$user_information['last_name'];?>"><br><br>

                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio"><?=$user_information['bio'];?></textarea><br><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" require><br><br>

                <input type="submit" value="Update">
            </form>
        </div>
    </main>
    <?php } else { ?>
    <p>Redirecting you to Login page...</p>

    <script>
    setTimeout(() => {
        window.location.href = "/login.php";
        document.body.innerHTML = '<p>You are now being redirected to the login page</p>'
    }, 3000);
    </script>
    <?php } ?>
    <footer>
        <p>&copy; 2025 Kalafe Weblog System. All rights reserved.</p>
    </footer>
</body>

</html>