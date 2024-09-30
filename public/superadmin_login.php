<?php
include '../config/db.php';
include '../vendor/autoload.php';  // Composer autoload for 2FA

use RobThree\Auth\TwoFactorAuth;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = htmlspecialchars(trim($_POST['password']));
    $tfa_code = htmlspecialchars(trim($_POST['tfa_code']));  // Two-factor code

    $sql = "SELECT * FROM users WHERE email='$email' AND role='superadmin'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $tfa = new TwoFactorAuth('CodeAppMedia');
            $isValidTfa = $tfa->verifyCode($row['tfa_secret'], $tfa_code);

            if ($isValidTfa) {
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['role'] = $row['role'];
                echo "Login successful";
                header("Location: superadmin_dashboard.php");
            } else {
                echo "Invalid 2FA code.";
            }
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "No user found.";
    }
    $conn->close();
}
?>

<form action="superadmin_login.php" method="post">
    <label for="email">Email ID:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="tfa_code">Two-Factor Code:</label>
    <input type="text" id="tfa_code" name="tfa_code" required><br><br>

    <input type="submit" value="Login">
</form>
