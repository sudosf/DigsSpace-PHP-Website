<style>
        /* Add your navigation bar styles here */
        body {
            margin: 0;
            padding: 0;
        }

       /* Add this CSS code for navigation bar styles */
       /* Add this CSS code for navigation bar styles */
       .navbar {
            background-color: #333; /* Navbar background color */
            overflow: hidden;
            height: 100px; /* Set a fixed height for the navbar */
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px; /* Adjust vertical padding */
            text-decoration: none;
            font-size: 14px; /* Reduce font size */
        }

        /* Add a subtle transition effect for smoother hover animations */
        .navbar a:hover {
            background-color: #C7C7C7;
            transition: 0.3s;
        }

        /* Highlight the current tab */
        .navbar a.active {
            background-color: #4169E1;
        }

        /* Style the search input and button */
        .navbar input[type="text"] {
            padding: 10px;
            margin: 6px 8px;
            border: none;
            font-size: 14px; /* Reduce font size */
        }

        .navbar button.search-btn {
            padding: 10px 20px;
            background-color: #4169E1;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 14px; /* Reduce font size */
        }

        /* Style the navbar menu items */
        .menu {
            float: right;
        }

        /* Add some space between the menu items */
        .menu a {
            margin-left: 1px; /* Reduce margin */
        }

        .active {
            background-color: blue;
        }
    </style>


<header>
    <nav class="navbar" >
        <div class="menu">
            <a href="index.php">
                <img src="images/logo_transparent.png" alt="Logo" style="height: 75px; width: 60px;">
            </a> 

            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href="faqs.php"><i class="fas fa-question-circle"></i> FAQ</a>
            <a href="login.php"><i class="fas fa-user"></i> Profile</a>
            <a href="Contact.php"><i class="fas fa-phone"></i> Contact Us</a>

            <form method="POST" action="index.php">
                <input type="text" name="search" placeholder="Enter Property type">
                <button type="submit" class="search-btn" name="submit">Search</button>
            </form>
        </div>

        <div class="auth ">
            <a href="login.php">
                <button style="background-color: #4169E1;" class="btn text-white">Login</button>
            </a>
        </div>
        </nav>
    </header>