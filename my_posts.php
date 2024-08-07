<?php
session_start();
include 'header.php';
include 'db.php';
if (isset($_SESSION['is_logged']) === true) {

    $sql = "SELECT * FROM posts where author_id = " . $_SESSION['user_id'];
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پست‌های من</title>
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
        .post-list {
            background: #f8f9fa;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            text-align: right;
        }
        .post-list p {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .post-list p:last-child {
            border-bottom: none;
        }
        .post-list a {
            color: #007bff;
            text-decoration: none;
        }
        .post-list a:hover {
            text-decoration: underline;
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
            <h1>پست‌های وبلاگ من</h1>
        </section>
        <div class="post-list">
            <?php
            foreach ($rows as $row) {
                echo '<p>', $row[1], '  <br> منتشر شده در: ', $row[5], '<br> | <a href="view_post.php?post_id=' . $row[0] . '">مشاهده</a> | <a href="edit_post.php?post_id=' . $row[0] . '">ویرایش</a> | <a href="delete_post.php?post_id=' . $row[0] . '">حذف</a></p>';
            }

            if (array_key_exists('msg', $_GET)) {
                $message = $_GET['msg'];
            }
            if (isset($message)) {
                echo "<p>$message</p>";
            }
            ?>
        </div>
    </main>
<?php } else { ?>
<p>در حال هدایت به صفحه ورود...</p>
<script>
    // Delay the redirection for 3 seconds (adjust as needed)
    setTimeout(function () {
        // Specify the URL you want to redirect to
        window.location.href = 'login.php';

        // Display a message (optional)
        document.body.innerHTML = '<p>در حال هدایت به صفحه جدید...</p>';
    }, 3000); // 3000 milliseconds (3 seconds)
</script>
<?php } ?>
<footer>
    <p>&copy; 2023 سیستم وبلاگ SP . تمامی حقوق محفوظ است.</p>
</footer>
</body>
</html>
