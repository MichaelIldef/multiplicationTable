<?php
include "connection.php";


session_start();
$errorMsg ="";
if(isset($_POST["signupBtn"])){
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    
    
    if($password === $password2){
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        
        $checkQuery = "SELECT userId FROM accounts WHERE email = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if($result->num_rows > 0){
        $errorMsg = "email already exist";
        }else {
            $signupQuery = "INSERT INTO accounts (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($signupQuery);
            $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);
            $stmt->execute();
            header("Location: login.php");
            exit();
        
        }
        }else{
            $errorMsg = "Password do not match";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?php echo isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'enabled' ? 'dark-mode' : ''; ?>">
    <div class="signupContainer">
        <h1>Signup</h1>
        <h5 style="color:red"><?php echo $errorMsg ?></h5>
        <form method="POST">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" placeholder="Enter First Name" autocomplete="off" required>
            <br><br>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" placeholder="Enter Last Name" autocomplete="off" required>
            <br><br>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="Must end with @math.com" autocomplete="off" required>
            <p id="email-error" style="color: red;"></p>
            <br>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Enter Password" autocomplete="off" required>
            <br>
            <p id="password-error">Password must have atleast 8 characters, 1 uppercase letter, 1 number, and 1 special character</p>
            
            <label for="password2">Confirm Password</label>
            <input id="password2" type="password" name="password2" placeholder="Confirm Password" autocomplete="off" required >
            <p id="confirm-password-error"></p>
            <br><br>
            <input type="submit" name="signupBtn" value="Register" id="signupBtn" disabled>
        </form> 
        <br><br><br>
        <div>
            <p>Already have an account?</p>
            <button onclick="window.location.href='./login.php'" name="Login">Login</button>
        </div>
    </div>
    <script src="validation.js"></script>

</body>
</html>