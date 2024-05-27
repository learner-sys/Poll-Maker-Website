<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
    <link rel="icon" href="logo1.png">
</head>
<body>
<?php


// Form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $lowerEmail = strtolower($email);
    $pass = trim($_POST["password"]);
    $untaken = $_POST["unAvailable"];
    $emailtaken = $_POST["EmailAvailable"];

    $reun = '/^(?=.*[^<>()\'\.,;:\s"])[\w]{3,20}$/';
    $reemail = '/^(?=.{8,64})(?=.*[^<>()\'\.,;:\s"])[\w]+@[a-z]+\.com$/';
    $repass = '/^(?=.*[!@#$%^&*])(?=.*[\d])(?=.*[A-Z])[^\s\'"]{8,30}$/';
    
    if (!preg_match($reun, $username)){
        echo "username is not correctly formated";
    } else if (!preg_match($reemail, $lowerEmail)) {
        echo "email is not correctly formated";
    } else if (!preg_match($repass, $pass)) {
        echo "password is not correctly formated";
    } else if ($untaken == "taken"){
        echo "username is already taken";
    } else if ($emailtaken == "taken"){
        echo "this email is already taken";
    } else {
        $hashedpass = password_hash($pass, PASSWORD_DEFAULT);

        // Inserting data into the database 
        require 'connection.php';
        try {
            $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $lowerEmail, $hashedpass]);
            echo "Registration successful!";
            header("Location: login.php");
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>


    <div class="container">
    <div class="logo">
        <img id='logo1' src='logo2.png'>
        <img id='logo2' src='1x/Asset 10.png'>
        <img id='logo3' src='1x/logoOnly.png'> 
    </div>
    <!-- form for registering the user -->
    
    <div class="form_container">
        <h2>Sign up</h2>
        <form id="form" action="register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" placeholder="enter username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" minlength="3" maxlength="20" onkeyup="IsAvailableUN()" required>
        <small id="unAvailable" style="display:none;"></small>
        <input type="hidden" id="unAvailableInput" name="unAvailable"></input><br><br>

        <label for="email">email:</label>
        <input type="email" name="email" id="email" placeholder="enter email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" minlength="8" maxlength="64" onkeyup="isAvailableEmail()" required>
        <small id="EmailAvailable" style="display:none;"></small>
        <input type="hidden" id="EmailAvailableInput" name="EmailAvailable"></input>
        <br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="enter password" minlength="8" maxlength="30" onkeyup="checkPass()" required>
        <small id="length" style="display:none;">at least 8 characters.</small>
        <small id="number" style="display:none;">at least one number.</small>
        <small id="capital" style="display:none;">at least one capital letter.</small>
        <small id="specialChar" style="display:none;">at least one special character.</small>
        <br><br>

        <input id="submit" type="submit" value="Register">
        </form>
        <p id='loginlink'>already have an account? <a href="login.php">login</a></p>
    </div>
</div>
</body>
</html>

<script src="validation.js"></script>