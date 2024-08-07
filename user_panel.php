<?php
session_start();
include 'header.php';
if (isset($_SESSION['is_logged']) === true) {
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل کاربری</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        header {
            background-color: #343a40;
            padding: 10px 0;
        }
        header nav ul {
            list-style: none;
            padding: 0;
            text-align: center;
        }
        header nav ul li {
            display: inline;
            margin: 0 10px;
        }
        header nav ul li a {
            color: white;
            text-decoration: none;
        }
        header nav ul li a:hover {
            text-decoration: underline;
        }
        main {
            padding: 50px 15px;
            text-align: center;
        }
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">صفحه اصلی</a></li>
                <li><a href="user_panel.php">پنل کاربری</a></li>
                <li><a href="wirte_post.php">نوشتن پست</a></li>
                <li><a href="my_posts.php">پست‌های من</a></li>
                <li><a href="settings.php">تنظیمات</a></li>
                <li>(<?php echo $_SESSION['username']?>) <a href="logout.php">خروج</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h1>به پنل کاربری خوش آمدید</h1>
            <p>سلام <?php echo $_SESSION['username']; ?></p>
        </section>
    </main>
<?php } else { ?>
<p>در حال انتقال به صفحه ورود...</p>
<script>
    setTimeout(function () {
        window.location.href = 'login.php';
        document.body.innerHTML = '<p>در حال انتقال به صفحه جدید...</p>';
    }, 3000);
</script>
<?php } ?>
<footer>
    <p>&copy; 2023 سیستم وبلاگ SP. تمامی حقوق محفوظ است.</p>
</footer>
</body>
</html>
