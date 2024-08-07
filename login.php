<?php
session_start();
include 'header.php';
echo '<h1>Login</h1>';
include 'db.php';

// Initialize message variable
$message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['is_logged'] = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = $row['user_id'];
        header("Location: user_panel.php"); // Redirect to a welcome page or dashboard
        exit();
    } else {
        // Authentication failed
        $message = "Invalid username or password, Please try again. <br>If you cannot remember your password please <a href='forget_password.php?username=$username'>click here</a>";
        $username = $_POST["username"];
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            display: flex;
            height: 100vh;
        }
        .left {
            flex: 1;
            background: url('https://s8.uupload.ir/files/blue_and_white_modern_ui_login_page_deskstop_prototype_(1)_l7pb.png') no-repeat center center;
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
        <form action="login.php" method="post">
            <h2 class="text-center">Login</h2>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <div class="mt-3 text-center">
                <a href='register.php'>Need a registration?</a>
            </div>
            <?php
            if (!empty($message)) {
                echo "<p class='text-danger text-center'>$message</p>";
            }
            ?>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
