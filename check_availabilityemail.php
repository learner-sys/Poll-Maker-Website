<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);

    require 'connection.php';
    // Check if the email is already taken
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE email= ?");
    $stmt->execute([$email]);
    $emailCount = $stmt->fetchColumn();

    if ($emailCount > 0) {
        echo "taken";
    } else {
        echo "available";
    }
}
?>