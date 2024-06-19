<?php
include "connection.php";
session_start();
$errorMsg = "";

if(isset($_POST["loginBtn"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    
    $checkQuery = "SELECT userId, firstName, password, email FROM accounts WHERE email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
    
        if(password_verify($password, $hashedPassword)){
            $_SESSION["idSession"] = $row["userId"];
            $_SESSION['firstName'] = $row["firstName"];
            $_SESSION['email'] = $row["email"];
            header("Location: index.php");
            exit();
        }else{
            $errorMsg = "Incorrect email/password";
        }
    }else {
        $errorMsg = "User not found";
    }
    
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body class="<?php echo isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'enabled' ? 'dark-mode' : ''; ?>">
    <div class= "loginContainer">
        <h1>Login</h1>
        <h5 style="color:red"><?php echo $errorMsg ?></h5>
        <form method="POST" class="loginForm">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Enter email" class="login" autocomplete="off" required><br><br>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter Password" class="login" required><br>
            <input type="submit" name="loginBtn" value="Login" class="loginBtn">
        </form>
        <br><br><br><br>
        
        <button onclick="window.location.href='./signup.php'">Register</button>
        <!--<a href="signup.php">
        <button type="button">aaa</button> </a> -->
    </div>
</body>
</html>