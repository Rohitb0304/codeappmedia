<?php
session_start();
include '../config/db.php';
require '../vendor/autoload.php';

use Sonata\GoogleAuthenticator\GoogleAuthenticator;

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = htmlspecialchars(trim($_POST['code']));
    $email = $_SESSION['email'];

    if (!$email) {
        header("Location: faculty_signup.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT totp_secret, email FROM faculty WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($secret, $storedEmail);
    $stmt->fetch();
    $stmt->close();

    if ($email !== $storedEmail) {
        $error = "Mismatch between registered email and the email used for scanning.";
    } elseif ($secret) {
        $g = new GoogleAuthenticator();
        if ($g->checkCode($secret, $code)) {
            $success = "2FA setup complete. You can now log in.";

            header("Location: faculty_signin.php?message=" . urlencode($success));
            exit();
        } else {
            $error = "Invalid code. Please try again.";
        }
    } else {
        $error = "No 2FA secret found.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .message {
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            border-radius: 5px;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
        form {
            margin-top: 20px;
        }
        label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>2FA Verification</h1>

        <?php if (!empty($success)): ?>
            <div class="message success"><?php echo htmlspecialchars($success); ?></div>
        <?php elseif (!empty($error)): ?>
            <div class="message error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <form action="2fa_setup.php" method="post">
                <label for="code">Please enter the code from your authenticator app:</label>
                <input type="text" id="code" name="code" required>
                <input type="submit" value="Verify Code">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>