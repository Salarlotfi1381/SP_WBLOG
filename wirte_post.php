<?php
session_start();
include 'header.php';
include 'db.php';

if (isset($_SESSION['is_logged']) === true) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author_id = $_SESSION['user_id'];
        $category_id = $_POST['category'];

        try {
            $sql = "INSERT INTO `posts` (title, content, author_id, category_id) value ('$title', '$content', '$author_id', '$category_id')";
            $result = mysqli_query($conn, $sql);

            if ($result === true){
                header("Location: my_posts.php?msg=پست شما با موفقیت منتشر شد!");
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            $message = $e->getMessage();
        }
        
    }

    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نوشتن پست جدید</title>
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
            max-width: 600px;
        }
        .form-container label {
            display: block;
            margin-bottom: 10px;
        }
        .form-container input[type="text"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .form-container input[type="submit"] {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background: #0056b3;
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
            <h1>نوشتن یک پست جدید برای وبلاگ</h1>
        </section>

        <div class="form-container">
            <form action="" method="POST">
                <label for="title">موضوع:</label>
                <input type="text" id="title" name="title" placeholder="موضوع را وارد کنید" required>

                <label for="content">نوشته:</label>
                <textarea id="content" name="content" placeholder="نوشته خود را وارد کنید" required></textarea>
            
                <label for="category">دسته‌بندی:</label>
                <select id="category" name="category" required>
                    <?php foreach($rows as $row) {
                        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                    } ?>
                </select>

                <input type="submit" value="ارسال پست">
            </form>
        </div>
    </main>
<?php } else { ?>
<p>در حال هدایت به صفحه ورود...</p>
<script>
    setTimeout(function () {
        window.location.href = '/login.php';
        document.body.innerHTML = '<p>در حال هدایت به صفحه جدید...</p>';
    }, 3000);
</script>
<?php } ?>
<footer>
    <p>&copy; 2023 سیستم وبلاگ SP. تمامی حقوق محفوظ است.</p>
</footer>
</body>
</html>
