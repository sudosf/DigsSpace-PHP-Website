<style>
    /* Add your navigation bar styles here */
    body {
        margin: 0;
        padding: 0;
    }

    /* Add this CSS code for navigation bar styles */
    .navbar {
        background-color: #333; /* Navbar background color */
        display: flex;
        justify-content: space-between; /* Align items horizontally */
        align-items: center; /* Align items vertically */
        padding: 10px 20px; /* Adjust padding */
    }

    .navbar a {
        color: white;
        text-align: center;
        text-decoration: none;
        font-size: 14px; /* Reduce font size */
        margin: 0 20px; /* Adjust margin to fill the width */
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
    .search-form {
        display: flex;
        align-items: center;
    }

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

    /* Style the logo */
    .menu a:first-child img {
        height: 90px;
        width: 90px;
    }
</style>