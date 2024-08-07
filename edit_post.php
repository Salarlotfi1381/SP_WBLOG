<?php
session_start();
include 'header.php';
include 'db.php';

if (isset($_SESSION['is_logged']) === true) {
    // Check if post_id is set in the GET request
    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];

        // Get the post data
        $sql = "SELECT * FROM posts WHERE post_id = $post_id AND author_id = " . $_SESSION['user_id'];
        $result = mysqli_query($conn, $sql);
        $post = mysqli_fetch_assoc($result);

        if (!$post) {
            echo "پست یافت نشد یا شما اجازه ویرایش این پست را ندارید.";
            exit;
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category'];

            try {
                $sql = "UPDATE posts SET title = '$title', content = '$content', category_id = '$category_id' WHERE post_id = $post_id";
                $result = mysqli_query($conn, $sql);

                if ($result === true) {
                    header("Location: my_posts.php?msg=پست شما با موفقیت به‌روزرسانی شد!");
                    exit;
                }
            } catch (mysqli_sql_exception $e) {
                $message = $e->getMessage();
            }
        }

        // Get categories for the select dropdown
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($conn, $sql);
        $categories = mysqli_fetch_all($result);
    } else {
        echo "شناسه پست مشخص نشده است.";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش پست</title>
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
        .form-container {
            background: #f8f9fa;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            text-align: right;
        }
        .form-container h1 {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .form-container label {
            display: block;
            margin-top: 10px;
        }
        .form-container input[type="text"], .form-container textarea, .form-container select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
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
        <section class="form-container">
            <h1>ویرایش پست</h1>
            <form action="" method="POST">
                <label for="title">عنوان:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" placeholder="عنوان"><br>

                <label for="content">محتوا:</label><br>
                <textarea id="content" name="content" placeholder="سلام، در این پست می‌خواهم درباره..."><?php echo htmlspecialchars($post['content']); ?></textarea><br>

                <label for="category">دسته‌بندی:</label>
                <select id="category" name="category">
                    <?php foreach($categories as $category) {
                        $selected = ($category[0] == $post['category_id']) ? 'selected' : '';
                        echo '<option value="' . $category[0] . '" ' . $selected . '>' . $category[1] . '</option>';
                    } ?>
                </select><br>

                <input type="submit" value="به‌روزرسانی پست">
            </form>

            <?php if (isset($message)) {
                echo "<p>$message</p>";
            } ?>
        </section>
    </main>
<?php } else { ?>
<p>در حال انتقال به صفحه ورود...</p>
<script>
    setTimeout(function () {
        window.location.href = 'login.php';
        document.body.innerHTML = '<p>در حال انتقال به صفحه جدید.</p>';
    }, 3000);
</script>
<?php } ?>
<footer>
    <p>&copy; 2023 سیستم وبلاگ SP . تمامی حقوق محفوظ است.</p>
</footer>
</body>
</html>
