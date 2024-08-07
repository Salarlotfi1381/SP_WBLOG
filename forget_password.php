<?php
include 'header.php';
echo '<h1>Forget Password</h1>';
include 'db.php';
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            $random_string = md5(generateRandomString(10));
            $update_stmt = $conn->prepare("UPDATE users SET token = ? WHERE username = ?");
            if ($update_stmt) {
                $update_stmt->bind_param("ss", $random_string, $username);
                $update_result = $update_stmt->execute();

                if ($update_result) {
                    $message = "The reset link has been sent to your email address: " . $row['email'] . "<br>";
                    $message .= "http://" . $_SERVER['SERVER_NAME'] . "/salar/reset_password.php?token=$random_string";
                } else {
                    $message = "Failed to update token: " . $conn->error;
                }

                $update_stmt->close();
            } else {
                $message = "Failed to prepare statement: " . $conn->error;
            }
        } else {
            $message = "Username not found.";
        }

        $stmt->close();
    } else {
        $message = "Failed to prepare statement: " . $conn->error;
    }
}
?>

<form action="forget_password.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php if(array_key_exists('username', $_GET)) echo $_GET['username'];?>" required>
    <input type="submit" value="Reset"><br><br>
</form>

<?php
if (isset($message)) {
    echo "<p>$message</p>";
}
include 'footer.php';
?>
