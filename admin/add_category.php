<?php
session_start();
include 'access.php'; // Check if user has admin access
include 'header.php';
include '../db.php';

// Initialize variables to hold form data
$categoryName = '';
$categoryDescription = '';
$error = '';

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    $categoryName = mysqli_real_escape_string($conn, $_POST['category_name']);
    $categoryDescription = mysqli_real_escape_string($conn, $_POST['category_description']);

    // Check if category name already exists
    $checkQuery = "SELECT * FROM `categories` WHERE `category_name` = '$categoryName'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $error = 'این نام دسته بندی قبلاً استفاده شده است.';
    } else {
        // Insert new category into database
        $insertQuery = "INSERT INTO `categories` (`category_name`, `category_description`) 
                        VALUES ('$categoryName', '$categoryDescription')";

        if (mysqli_query($conn, $insertQuery)) {
            // Category added successfully
            header('Location: all_categories.php'); // Redirect to manage categories page
            exit;
        } else {
            $error = 'خطا در افزودن دسته بندی: ' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>افزودن دسته بندی جدید</title>
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
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .form-container {
            width: 60%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
        <section class="form-container">
            <h1>افزودن دسته بندی جدید</h1>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-3">
                    <label for="category_name" class="form-label">نام دسته بندی</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" required value="<?php echo $categoryName; ?>">
                </div>
                <div class="mb-3">
                    <label for="category_description" class="form-label">توضیحات دسته بندی</label>
                    <textarea class="form-control" id="category_description" name="category_description" rows="3"><?php echo $categoryDescription; ?></textarea>
                </div>
                <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
                <?php } ?>
                <button type="submit" class="btn btn-primary">افزودن دسته بندی</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 سیستم وبلاگ SP. تمامی حقوق محفوظ است.</p>
    </footer>
</body>
</html>
