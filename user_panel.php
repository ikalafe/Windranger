<?php
session_start();
include 'header.php';
if(isset($_SESSION['is_logged']) === true){
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
                <h2>Welcome to the panel</h2>
                <p>Hello <?php echo $_SESSION['username']; ?></p>
            </section>
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