<?php
session_start();
include 'header.php';
include 'db.php';
if (isset($_SESSION['is_logged']) === true) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_POST['user_id'];
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $bio = mysqli_real_escape_string($conn, $_POST['bio']);
        $password_change = false;
    
        if ($password === ""){
            $sql = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `bio` = '$bio' where `user_id` = " . intval($user_id);
        }else{
            $sql = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `bio` = '$bio', `password` = '$password' where `user_id` = " . intval($user_id);
            $password_change = true;
        }

        try {
            $result = mysqli_query($conn, $sql);
            if ($result === true){
                if ($password_change === true) header("Location: logout.php"); 
                else header("Location: settings.php");
            }
        } catch (mysqli_sql_exception $e) {
            $message = $e->getMessage();
            print($message);
        }
        exit;
    }

    try {
        $sql = "select * from `users` where user_id = " . $_SESSION['user_id'];
        $result = mysqli_query($conn, $sql);
        $user_information = mysqli_fetch_assoc($result);

        //print_r($user_informationow);

    } catch (mysqli_sql_exception $e) {
        $message = $e->getMessage();
    }

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تنظیمات</title>
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
        .form-container input[type="text"], .form-container textarea, .form-container select, .form-container input[type="email"], .form-container input[type="password"] {
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
        .form-container img {
            border-radius: 50%;
            margin-bottom: 20px;
        }
        #uploadProgress {
            width: 100%;
            height: 20px;
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
            <h1>تنظیمات</h1>
            <img src="<?='get_image.php?imgsrc=statics/images/' . md5($_SESSION['user_id']) . '.png';?>" onerror="this.src='statics/images/user.png'" width="200" height="200"><br>
            <input type="file" id="imageUpload" accept="image/*">
            <progress id="uploadProgress" max="100" value="0"></progress>
            <div id="message"></div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="statics/upload.js"></script>

            <br>

            <form action="" method="POST">
                <input type="hidden" name="user_id" value="<?=$user_information['user_id'];?>">

                <label for="username">نام کاربری:</label>
                <input type="text" id="username" name="username" value="<?=$user_information['username'];?>" disabled><br>

                <label for="email">ایمیل:</label>
                <input type="email" id="email" name="email" value="<?=$user_information['email'];?>" disabled><br>

                <label for="first_name">نام:</label>
                <input type="text" id="first_name" name="first_name" value="<?=$user_information['first_name'];?>"><br>

                <label for="last_name">نام خانوادگی:</label>
                <input type="text" id="last_name" name="last_name" value="<?=$user_information['last_name'];?>"><br>

                <label for="bio">بیوگرافی:</label>
                <textarea id="bio" name="bio"><?=$user_information['bio'];?></textarea><br>

                <label for="password">رمز عبور:</label>
                <input type="password" id="password" name="password" value=""><br>
                <input type="submit" value="به‌روزرسانی">
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
