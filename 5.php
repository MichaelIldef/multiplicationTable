<?php
session_start();
include_once 'connection.php';


// Will check if the user is logged in

if(isset($_SESSION['firstName'])) {
    $welcomeMessage = "Welcome, " . $_SESSION['firstName'];
} else {
    // User is not logged in
    header("Location: login.php");
    exit();
}
// Toggle dark mode
if(isset($_POST['darkmode'])) {
    if(isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'enabled') {
        setcookie('darkMode', 'disabled', time() - 3600, '/');
    } else {
        setcookie('darkMode', 'enabled', time() + (3600), '/');
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Logout 
if(isset($_POST['Logout'])) {
    session_unset();
    session_destroy();  
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?php echo isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'enabled' ? 'dark-mode' : ''; ?>">
    <nav>
        <div class="navBar">
            <ul>
                <li id="WelcomMsg"><h3 ><?php echo $welcomeMessage; ?></h3></li>
                <li>

                    <form method="post">
                        <input type="hidden" name="darkmode" value="1">
                        <button type="submit"><?php echo isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'enabled' ? 'Light Mode' : 'Dark Mode'; ?></button>
                    </form>
                </li>
                <li><a href="index.php">Home</a></li>
                <li>
                    <form method="post">
                        <input type="submit" value="Logout" name="Logout">
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div>
        <h1>5x5 Multiplication Table</h1>
    </div>
    <div class="body">
        <?php include "multiplication.php";    //to access multiplication.php
            buildMultiplicationTable(5);
        ?>
    </div>


</body>
</html>
