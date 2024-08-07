<?php
session_start();
include 'access.php';
include '../db.php';
include 'header.php';
include 'mysql-backup.php';

$result = false;
$sql = false;
$msg = false;

if (isset($_GET['operation'])) {
    $op = $_GET['operation'];

    if ($op == 'search' && isset($_GET['keyword'])) {
        $keyword = mysqli_real_escape_string($conn, $_GET['keyword']);
        $sql = "SELECT * FROM `users` WHERE username LIKE '%$keyword%' OR email LIKE '%$keyword%'";
        $result = mysqli_query($conn, $sql);
    } elseif ($op == 'delete' && isset($_GET['user_id'])) {
        $user_id = intval($_GET['user_id']);
        $sql = "DELETE FROM `users` WHERE user_id = $user_id";
        $result = mysqli_query($conn, $sql);
    } elseif ($op == 'export-user' && isset($_GET['user_id'])) {
        $user_id = intval($_GET['user_id']);
        $sql = "SELECT * FROM `users` WHERE user_id = $user_id";
        $result = mysqli_query($conn, $sql);
        $export = true;
    } elseif ($op == 'import-user' && isset($_GET['obj'])) {
        $import = unserialize(base64_decode($_GET['obj']));
    }
} else {
    $sql = "SELECT * FROM `users` LIMIT 0,50";
    $result = mysqli_query($conn, $sql);
}

$boolean_operation = false;

if ($result === true) {
    $boolean_operation = true;
}

if ($boolean_operation) {
    $msg = "Operation has been done";
} else {
    if ($result !== false) {
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت کاربران</title>
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
            max-width: 400px;
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
            <div class="container">
                <h1 class="mb-4">همه کاربران</h1>
                <?php 
                if ($msg) {
                    echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($msg) . '</div><meta http-equiv="refresh" content="0;url=all_users.php">';
                } else {
                    if (isset($rows) && count($rows) > 0) {
                        foreach ($rows as $row) { ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">نام کاربر: <?= htmlspecialchars($row['username']) ?></h5>
                                    <p class="card-text">ایمیل: <?= htmlspecialchars($row['email']) ?></p>
                                    <a href="?operation=delete&user_id=<?= intval($row['user_id']) ?>" class="btn btn-danger">حذف</a>
                                    <a href="?operation=export-user&user_id=<?= intval($row['user_id']) ?>" class="btn btn-info">جزئیات بیشتر</a>
                                </div>
                            </div>
                        <?php }
                    }
                    if (isset($export)) echo '<a href="?operation=import-user&obj=' . base64_encode(serialize($row)) . '" class="btn btn-success">صادر شده، آیا کاربر را بارگذاری کنیم؟</a>';
                    if (isset($import)) { echo "<pre>"; var_dump($import); echo "</pre>"; }
                } 
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 سیستم وبلاگ SP. تمامی حقوق محفوظ است.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
