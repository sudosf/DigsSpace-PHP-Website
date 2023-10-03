
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your main styles.css file -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Add your navigation bar styles here */
        body {
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            height: 80px;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 14px;
        }

        .navbar a:hover {
            background-color: #C7C7C7;
            transition: 0.3s;
        }

        .navbar a.active {
            background-color: #4169E1;
        }

        .navbar input[type="text"] {
            padding: 10px;
            margin: 6px 8px;
            border: none;
            font-size: 14px;
        }

        .navbar button.search-btn {
            padding: 10px 20px;
            background-color: #4169E1;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        .navbar .menu {
            float: right;
        }

        .navbar .menu a {
            margin-left: 1px;
        }
    </style>
</head>

<body>
    <header>
        <nav align="center" class="navbar">
            <div class="menu">
                <p><img src="logo_transparent.png" alt="Logo" style="height: 75px; width: 60px;"></p>
                <a href="index.php" <?php if ($currentPage == 'index') echo 'class="active"'; ?>><i class="fas fa-home"></i> Home</a>
                <a href="faqs.php" <?php if ($currentPage == 'faqs') echo 'class="active"'; ?>><i class="fas fa-question-circle"></i> FAQ</a>
                <a href="login.html" <?php if ($currentPage == 'login') echo 'class="active"'; ?>><i class="fas fa-user"></i> Profile</a>
                <a href="Contact.php" <?php if ($currentPage == 'contact') echo 'class="active"'; ?>><i class="fas fa-phone"></i> Contact Us</a>
                <form method="POST" action="index.php">
                    <input type="text" name="search" placeholder="Enter Property type">
                    <button type="submit" class="search-btn" name="submit">Search</button>
                </form>
            </div>

            <div class="auth">
                <a href="login.html">
                    <button style="background-color: #4169E1;" class="btn">Login</button>
                </a>
            </div>
        </nav>
    </header> <br>
</body>

</html>
