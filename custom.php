<?php
session_start();
include_once 'connection.php';
include 'multiplication.php';

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

if(isset($_POST['submit'])) {
    $value = isset($_POST['value']) ? $_POST['value'] : 0;

    if($value >= 1 && $value <= 12) {
        buildMultiplicationTable($value);
    } else {
        echo "Invalid input. Please enter a value between 1 and 12.";
    }
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
        <h1>Multiplication Table</h1>
    </div>
    <div class="body">
        <form method="post">
            <label for="xnumber">Enter custom value between 1-12</label>
            <br>
            <input type="number" name="value" max="12" min="1" class="custom" placeholder="Value">
            <br><br>
            <input type="submit" name="submit" value="Submit">
        </form>
        
    </div>
    <div class="multiplication-table">
        <!-- Multiplication table will be displayed here -->
    </div>
</body>
</html>