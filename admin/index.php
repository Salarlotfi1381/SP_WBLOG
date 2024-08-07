<?php
session_start();
include 'access.php';
include 'header.php';
include '../db.php';
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت</title>
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
            <h1>پنل مدیریت</h1>
            <p>خوش آمدید، ادمین عزیز</p>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 سیستم وبلاگ SP. تمامی حقوق محفوظ است.</p>
    </footer>
</body>
</html>
