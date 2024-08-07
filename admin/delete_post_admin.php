<?php
session_start();
include 'access.php'; // Ensure only admin access
include 'header.php';
include '../db.php';

// Fetch all posts with author name and category name
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT posts.post_id, posts.title, posts.content, posts.publication_date, users.username AS author_name, categories.category_name
            FROM posts
            INNER JOIN users ON posts.author_id = users.user_id
            INNER JOIN categories ON posts.category_id = categories.category_id
            WHERE users.username LIKE '%$search%' OR categories.category_name LIKE '%$search%'
            ORDER BY posts.publication_date DESC";
} else {
    $sql = "SELECT posts.post_id, posts.title, posts.content, posts.publication_date, users.username AS author_name, categories.category_name
            FROM posts
            INNER JOIN users ON posts.author_id = users.user_id
            INNER JOIN categories ON posts.category_id = categories.category_id
            ORDER BY posts.publication_date DESC";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo 'Error fetching posts: ' . mysqli_error($conn);
    exit;
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت پست‌ها</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            padding-top: 60px;
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
            font-size: 18px;
        }
        header nav ul li a:hover {
            text-decoration: underline;
        }
        main {
            padding: 50px 15px;
        }
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .card {
            margin: 15px auto;
            max-width: 700px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 22px;
            margin-bottom: 10px;
        }
        .card-text {
            color: #6c757d;
            font-size: 16px;
            margin-bottom: 15px;
        }
        .btn {
            margin-right: 10px;
        }
        .search-bar {
            margin-bottom: 30px;
        }
        .search-bar input[type="text"] {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">خانه</a></li>
                <li><a href="backup.php">پشتیبان‌گیری از دیتابیس</a></li>
                <li><a href="all_users.php">مدیریت کاربران</a></li>
                <li><a href="delete_post_admin.php">مدیریت پست‌ها</a></li>
                <li><a href="add_category.php">افزودن دسته بندی جدید</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="container">
            <div class="row">
                <div class="col-12">
                    <h1>پنل مدیریت - همه پست‌ها</h1>
                    <p>خوش آمدید، ادمین</p>
                </div>
            </div>

            <section class="search-bar">
                <div class="row">
                    <div class="col-12">
                        <form action="" method="POST" class="form-inline">
                            <label for="search">جستجو بر اساس نام کاربری یا دسته‌بندی:</label>
                            <input type="text" id="search" name="search" class="form-control" value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
                            <input type="submit" value="جستجو" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </section>

            <?php
            // Loop through each post and display its details
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h3 class="card-title">عنوان: ' . htmlspecialchars($row['title']) . '</h3>';
                echo '<p class="card-text">نویسنده: ' . htmlspecialchars($row['author_name']) . '</p>';
                echo '<p class="card-text">تاریخ انتشار: ' . htmlspecialchars($row['publication_date']) . '</p>';
                echo '<p class="card-text">دسته‌بندی: ' . htmlspecialchars($row['category_name']) . '</p>';
                echo '<a href="view_post.php?post_id=' . $row['post_id'] . '" class="btn btn-info">نمایش</a>';
                echo '<form action="delete_post_confirm.php" method="POST" style="display:inline-block;">';
                echo '<input type="hidden" name="post_id" value="' . $row['post_id'] . '">';
                echo '<input type="submit" value="حذف" class="btn btn-danger">';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 SP  Weblog System. تمامی حقوق محفوظ است.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
