<?php
session_start();
include 'header.php';
include 'db.php';

function author_id_to_name($conn, $id) {
    $result = mysqli_query($conn, "SELECT * FROM `users` where `user_id` = " . $id);
    $author = mysqli_fetch_assoc($result);
    return $author['username'];
}

function category_id_to_name($conn, $id) {
    $result = mysqli_query($conn, "SELECT * FROM `categories` where `category_id` = " . $id);
    $author = mysqli_fetch_assoc($result);
    return $author['category_name'];
}

if (array_key_exists('author_id', $_GET)) {
    $sql = "SELECT * FROM `posts` where author_id = " . intval($_GET['author_id']);
} else {
    $sql = "SELECT * FROM `posts`";
}

// Handling search functionality
if (isset($_POST['search'])) {
    $search = trim(mysqli_real_escape_string($conn, $_POST['search']));
    $sql = "SELECT * FROM `posts` 
            WHERE `title` LIKE '%$search%' 
            OR `publication_date` LIKE '%$search%' 
            OR `author_id` IN (SELECT `user_id` FROM `users` WHERE `username` LIKE '%$search%')
            ORDER BY `publication_date` DESC";
}

$result = mysqli_query($conn, $sql);

$rows = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
} else {
    echo 'Error executing query: ' . mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>همه پست‌های وبلاگ</title>
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
        }
        .post-list {
            list-style: none;
            padding: 0;
        }
        .post-list li {
            background: #f8f9fa;
            margin-bottom: 10px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .post-list li a {
            text-decoration: none;
            color: #007bff;
        }
        .post-list li a:hover {
            text-decoration: underline;
        }
        .search-form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">خانه</a></li>
                <li><a href="all_posts.php">همه پست‌ها</a></li>
                <li><a href="user_panel.php">پنل کاربری</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h1 class="mb-4">همه پست‌های وبلاگ</h1>

            <!-- Search Form -->
            <form action="" method="POST" class="search-form">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" name="search" placeholder="جستجو بر اساس عنوان، نویسنده یا تاریخ انتشار">
                    <button class="btn btn-primary" type="submit">جستجو</button>
                </div>
            </form>

            <ul class="post-list">
                <?php foreach ($rows as $row) { ?>
                    <li>
                        <p>
                            <a href="show.php?post_id=<?php echo $row['post_id']; ?>">
                                <strong><?php echo $row['title']; ?></strong>
                            </a>
                            <br>
                            <small>منتشر شده در تاریخ <?php echo $row['publication_date']; ?> در دسته <b><?php echo category_id_to_name($conn, $row['category_id']); ?></b> توسط 
                                <a href="all_posts.php?author_id=<?php echo $row['author_id']; ?>"><?php echo author_id_to_name($conn, $row['author_id']);?></a>
                            </small>
                        </p>
                    </li>
                <?php } ?>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 سیستم وبلاگ SP . تمامی حقوق محفوظ است.</p>
    </footer>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
