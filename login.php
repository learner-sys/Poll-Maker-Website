<?php
session_start();
require 'connection.php';

// Initialize variables
$email = '';
$password = '';
$loginError = '';

// Form submission
if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the entered username and password match the database records
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Successful login
        // Redirect to the dashboard or another page
        $_SESSION['activeUser']=$user['username'];
        $_SESSION['uid']=$user['uid'];
        //header("Location: homepage.php");
        header("Location: myhomepage2.php");
        exit();
    } else {
        // Invalid login credentials
        $loginError = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
    <div class="logo">
        <img id='logo1' src='logo2.png'>
        <img id='logo2' src='1x/Asset 10.png'>
        <img id='logo3' src='1x/logoOnly.png'> 
    </div>

    
    <div class="form_container">
    <h2>Login</h2>
        <form method="POST" action="login.php">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $email; ?>" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>

            <span style="color: red;"><?php echo $loginError; ?></span><br><br>

            <input type="submit" value="Login" id="submit">
        </form>
        don't have an account <a href="register.php">sign up</a>
    </div>
    
</body>
</html>