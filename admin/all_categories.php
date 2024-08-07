<?php
session_start();
include 'access.php'; // Ensure access control
include 'header.php'; // Include header if necessary
include '../db.php'; // Include database connection
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت دسته بندی‌ها</title>
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
        .category-list {
            list-style: none;
            padding: 0;
        }
        .category-list li {
            background: #f8f9fa;
            margin-bottom: 10px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .category-list li a {
            text-decoration: none;
            color: #007bff;
        }
        .category-list li a:hover {
            text-decoration: underline;
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
        <section>
            <h1 class="mb-4">مدیریت دسته بندی‌ها</h1>

            <!-- List of Categories -->
            <ul class="category-list">
                <?php
                $sql = "SELECT * FROM `categories`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>";
                    echo "<a href='#'><strong>" . $row['category_name'] . "</strong></a>";
                    echo "<br>";
                    echo "<p>" . $row['category_description'] . "</p>";
                    echo "</li>";
                }
                ?>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 سیستم وبلاگ SP. تمامی حقوق محفوظ است.</p>
    </footer>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
