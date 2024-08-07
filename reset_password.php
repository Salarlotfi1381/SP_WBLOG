<?php
include 'header.php';
echo '<h1>Reset Password</h1>';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("ss", $password, $username);
        $result = $stmt->execute();

        if ($result) {
            $token_stmt = $conn->prepare("UPDATE users SET token = NULL WHERE username = ?");
            if ($token_stmt) {
                $token_stmt->bind_param("s", $username);
                $token_null = $token_stmt->execute();

                if ($token_null) {
                    header("Location: login.php?msg=The new password has been set successfully");
                    exit();
                } else {
                    echo "Failed to clear token: " . $conn->error;
                }

                $token_stmt->close();
            } else {
                echo "Failed to prepare statement for clearing token: " . $conn->error;
            }
        } else {
            echo "Failed to update password: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Failed to prepare statement for updating password: " . $conn->error;
    }
}

if (array_key_exists('token', $_GET)) {
    $token = $_GET['token'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE token = ?");
    if ($stmt) {
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $token_result = true;
        } else {
            $token_result = false;
        }

        $stmt->close();
    } else {
        echo "Failed to prepare statement: " . $conn->error;
    }
}

if (isset($token_result) && $token_result === true) { ?>
    <form action="reset_password.php" method="post">
        <label for="password">New password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="hidden" id="username" name="username" value="<?php echo $row['username']; ?>">
        <input type="submit" value="Reset the password"><br>
    </form>
<?php } else {
    echo 'The provided token is not valid or expired, <a href="login.php">go back</a>';
}

include 'footer.php';
?>
