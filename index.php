<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SP  Blog</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
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
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .hero-section {
            background: url('https://images.pexels.com/photos/585752/pexels-photo-585752.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1') no-repeat center center/cover;
            color: white;
            padding: 150px 15px;
            text-align: center;
        }
        .features-section {
            padding: 50px 15px;
            text-align: center;
        }
        .features-section .feature {
            margin-bottom: 30px;
        }
        .feature img {
            width: 100%;
            height: auto;
            max-width: 300px;
            border-radius: 10px;
        }
        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: bold;
        }
        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }
        .hero-section .btn {
            font-size: 1.25rem;
            padding: 10px 30px;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="register.php"> ثبت نام </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">ورد    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">ثبت نام   </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="all_posts.php">همه پست ها</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_panel.php">کنترل پنل</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">خانه</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-section">
            <div class="container">
                <h1 class="display-4">خوش آمدید به وبلاگ اس پی</h1>
                <p class="lead">این وب سایت به کاربران این امکان را می دهد که پست های وبلاگ خود را بنویسند.</p>
                <button> <a href="all_posts.php" class="btn btn-primary btn-lg">دیدن همه پست ها</a></button>
                
            </div>
        </section>

        <section class="features-section">
            <div class="container">
                <h2 class="mb-4">امکانات</h2>
                <div class="row">
                    <div class="col-md-4 feature">
                        <img src="https://images.pexels.com/photos/5668851/pexels-photo-5668851.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Feature 1">
                        <h3>آسان برای استفاده</h3>
                        <p>پلتفرم ما کاربر پسند و آسان است </p>
                    </div>
                    <div class="col-md-4 feature">
                        <img src="https://images.pexels.com/photos/17188271/pexels-photo-17188271/free-photo-of-top-down-view-flat-lay-with-white-soft-cover-book-mockup-coffee-mug-glasses-and-blurred-plant-in-the-foreground-on-a-brown-wooden-table-customizable-template-with-concept-of-literature.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Feature 2">
                        <h3>قابل ویرایش </h3>
                        <p>وبلاگ خود را با تم ها و تنظیمات مختلف شخصی سازی کنید.</p>
                    </div>
                    <div class="col-md-4 feature">
                        <img src="https://images.pexels.com/photos/39584/censorship-limitations-freedom-of-expression-restricted-39584.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Feature 3">
                        <h3>امن است</h3>
                        <p>داده های شما با اقدامات امنیتی درجه یک ما ایمن هستند.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 SP Weblog System. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
