<?php
session_start();
include 'header.php';
include 'db.php';

# safe query:
$post_id = intval($_GET['post_id']);
$sql = "SELECT * FROM `posts` WHERE post_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['title']; ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            direction: rtl;
            text-align: right;
            font-family: 'Vazir', sans-serif;
        }
        header {
            background-color: #f8f9fa;
            padding: 10px 0;
        }
        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }
        header nav ul li {
            display: inline;
            margin: 0 10px;
        }
        header nav ul li a {
            text-decoration: none;
            color: #007bff;
        }
        main {
            padding: 20px;
        }
        footer {
            background-color: #f8f9fa;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Vazir&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">صفحه اصلی</a></li>
                <li><a href="all_posts.php">همه پست‌ها</a></li>
                <li><a href="user_panel.php">پنل کاربری</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <section>
            <h1><?php echo $row['title']; ?></h1>
            <p><?php echo $row['content']; ?></p>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 سیستم وبلاگ SP. کلیه حقوق محفوظ است.</p>
    </footer>
</body>
</html>
