<?php
session_start();
include 'header.php';
include 'db.php';
if(isset($_SESSION['is_logged']) === true){

    if($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $author_id = $_SESSION['user_id'];
            $category_id = $_POST['category'];

        try {
            $sql = "INSERT INTO `posts` (`title`, `content`, `author_id`, `category_id`) VALUE ('$title', '$content', '$author_id', '$category_id')";
            $result = mysqli_query($conn, $sql);
            
            if($result === true) {
                header("Location: my_posts.php?msg=Your post has been published successfully🎉");
            }
        } catch (mysqli_sql_exception $e) {
            $message = $e->getMessage();
            print($message);
        }
    }

    $sql = "SELECT * FROM `categories`";
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
                <h2>Write a blog post</h2>
                <p>This is a simple and smooth template for your website. Customize it to fit your needs!</p>
            </section>

            <form action="write_post.php" method="POST">

                <label for="title">Title:</label>
                <input type="text" id="title" name="title" placeholder="Title" require><br>

                <label for="content">Content:</label><br>
                <textarea style="width: 400px; height: 200px;" id="content" name="content" placeholder="Hi, in this post I want to talk about..."></textarea><br>

                <select name="category" id="category">
                    <?php foreach ($rows as $row) {
                        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                    } ?>
                </select>

                <input type="submit" value="Post">
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