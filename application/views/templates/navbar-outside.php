<!-- Adding navbar with custom styled buttons -->
<nav class="navbar navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <img src="assets/images/Logomain.png" class="img-fluid" style="height:45px">
        <form class="d-flex nav-form">
            <li class="nav-item">
                <a href="index.php/login" class="nav-button">Login</a>
            </li>
            <li class="nav-item">
                <a href="index.php/signup" class="nav-button">Signup</a>
            </li>
        </form>
    </div>
</nav>

<style>
    /* Navbar button styling */
    .nav-button {
        display: inline-block;
        padding: 8px 15px;
        margin-left: 10px; /* Spacing between buttons */
        background-color: #007bff; /* Bootstrap primary color */
        color: white;
        text-decoration: none;
        border-radius: 5px; /* Rounded corners for button */
        transition: background-color 0.3s ease; /* Smooth transition for hover effect */
        font-family: monospace;
    }

    .nav-button:hover {
        background-color: #0056b3; /* Darker shade on hover */
    }

    .navbar {
        display: flex;
        align-items: center; /* Center items vertically */
        justify-content: space-between; /* Space between logo and form */
        
    }

    .nav-form {
        display: flex;
        align-items: center; /* Align form contents vertically */
        
    }
</style>
