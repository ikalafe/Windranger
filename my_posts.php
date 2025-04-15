<?php
session_start();
include 'header.php';
include 'db.php';
if(isset($_SESSION['is_logged']) === true){


    $sql = "SELECT * FROM `posts` WHERE `author_id` = " . $_SESSION['user_id'];
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);

?>

<body>
    <nav>
        <ul>
            <li><a href="user_panel.php">Panel</a></li>
            <li><a href="write_post.php">Write</a></li>
            <li><a href="my_posts.php">Posts</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php">Logout </a>(<?php echo $_SESSION['username'] ?>)</li>
        </ul>
    </nav>

    <main>
        <div class="container">
            <section class="hero">
                <h1>
                    My blog posts
                </h1>
            </section>

            <?php
                foreach ($rows as $row) {
                    echo '- ',$row[1], ' Published in: ', $row[5], '<a href="view_post.php?post_id=' . $row[0] . '"> | View👁️ | </a>', '<a href="edit_post.php?post_id=' . $row[0] . '"> Edit✍️</a>', '<a href="delete_post.php?post_id=' . $row[0] . '"> | Delete ❌ | </a>','<br>';
                }

                echo '<br>';

                if(array_key_exists('msg', $_GET)){
                    $message = $_GET['msg'];
                }
                if(isset($message)){
                    echo "<p>$message</p>";
                }
            ?>
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