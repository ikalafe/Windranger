<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalafe Weblog System</title>
    <link rel="stylesheet" href="/statics/style.css">
    <script src="/statics/functions.js"></script>
</head>
<?php
$is_logged = $_COOKIE['is_logged'];
$user_id = $_COOKIE['user_id'];
if($is_logged == 'true' and !is_null($user_id)){
?>

<body>
    <nav>
        <ul>
            <li><a href="#home">Panel</a></li>
            <li><a href="#about">Write</a></li>
            <li><a href="#services">My Posts</a></li>
            <li><a href="#contact">Settings</a></li>
            <li><a href="#contact" onclick="deleteAllCookies();redirect('/login.php');">Logout </a>(<?php echo $_COOKIE['username'] ?>)</li>
        </ul>
    </nav>

    <main>
        <div class="container">
            <section class="hero">
                <h2>Welcome to the panel</h2>
                <p>This is a simple and smooth template for your website. Customize it to fit your needs!</p>
            </section>

            <section id="about">
                <h3>About Us</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.</p>
            </section>

            <section id="services">
                <h3>Our Services</h3>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat.</p>
            </section>

            <section id="contact">
                <h3>Contact Us</h3>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                    pariatur.</p>
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