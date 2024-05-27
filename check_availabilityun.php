<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["un"]);

    require 'connection.php';
    // Check if the username is already taken
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $usernameCount = $stmt->fetchColumn();

    if ($usernameCount > 0) {
        echo "taken";
    } else {
        echo "available";
    }
}
?>