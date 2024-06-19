<?php
// Start the session
session_start();
include_once 'connection.php';


// Check if the user is logged in
if(isset($_SESSION['firstName'])) {
    // User is logged in
    $welcomeMessage = "Welcome, " . $_SESSION['firstName'];
} else {
    // User is not logged in
    header("Location: login.php");
    exit(); 
}

if (isset($_POST['darkmode'])) {
    if (isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'enabled') {
        setcookie('darkMode', 'disabled', time() - 3600, '/');
    } else {
        setcookie('darkMode', 'enabled', time() + (86400 * 30), '/');
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


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
    <title>Multiplication Table</title>
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
        <script type="text/javascript">
            function redirectToMultiplicationTable(size)
            {
                window.location = './' + size + '.php';
            }
        </script>
        <button onclick="redirectToMultiplicationTable('5');">5x5 Table</button>
        <br><br>
        <button onclick="redirectToMultiplicationTable('10');">10x10 Table</button>
        <br><br>
        <button onclick="redirectToMultiplicationTable('12');">12x12 Table</button>
        <br><br>
        <button onclick="window.location.href='./custom.php'">Custom</button>
        
    </div>
</body>
</html>