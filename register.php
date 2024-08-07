<?php
include 'header.php';
include 'db.php';

echo '<h1>Registration</h1>';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    try {
        $sql = "INSERT INTO `users` (username, email, password) VALUES ('$username', '$email', '$password')";
        $result = mysqli_query($conn, $sql);

        if ($result === true) {
            header("Location: login.php?msg=You have registered successfully, please login");
        }
    } catch (mysqli_sql_exception $e) {
        $message = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            display: flex;
            height: 100vh;
        }
        .left {
            flex: 1;
            background: url('https://s8.uupload.ir/files/blue_flat_color_ui_login_page_desktop_prototype_(1)_zsd6.png') no-repeat center center;
            background-size: cover;
        }
        .right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        form {
            width: 100%;
            max-width: 400px;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="left"></div>
    <div class="right">
        <form action="register.php" method="post">
            <h2 class="text-center">Register</h2>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
            <div class="mt-3 text-center">
                <a href='login.php'>Already have an account? Login</a>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($message)) {
    echo "<p class='text-danger text-center'>$message</p>";
}
include 'footer.php';
?>

</body>
</html>
