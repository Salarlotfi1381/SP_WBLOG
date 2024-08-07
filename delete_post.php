<?php
session_start();
include 'header.php';
include 'db.php';

if (isset($_SESSION['is_logged']) === true && isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $user_id = $_SESSION['user_id'];

    // Check if the logged-in user is the author of the post
    $sql = "SELECT * FROM posts WHERE post_id = $post_id AND author_id = $user_id";
    $result = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($result);

    if (!$post) {
        echo "Post not found or you don't have permission to delete this post.";
        exit;
    }

    // Handle post deletion
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $sql = "DELETE FROM posts WHERE post_id = $post_id";
            $result = mysqli_query($conn, $sql);

            if ($result === true) {
                header("Location: my_posts.php?msg=Your post has been deleted successfully!");
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            $message = $e->getMessage();
        }
    }
} else {
    echo "Access denied.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Main</a></li>
                <li><a href="user_panel.php">Panel</a></li>
                <li><a href="wirte_post.php">Write</a></li>
                <li><a href="my_posts.php">Posts</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li>(<?php echo $_SESSION['username']?>) <a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h1>Delete Post</h1>
        </section>

        <p>Are you sure you want to delete the post "<?php echo htmlspecialchars($post['title']); ?>"?</p>

        <form action="" method="POST">
            <input type="submit" value="Delete">
        </form>

        <?php if (isset($message)) {
            echo "<p>$message</p>";
        } ?>
    </main>

    <footer>
        <p>&copy; 2023 SP  Weblog System. All rights reserved.</p>
    </footer>
</body>
</html>
