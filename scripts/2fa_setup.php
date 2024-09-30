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

    try {
        // Fetch the secret from the database
        $stmt = $conn->prepare("SELECT totp_secret FROM faculty WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($secret);
        $stmt->fetch();
        $stmt->close();

        if ($secret) {
            $g = new GoogleAuthenticator();
            if ($g->checkCode($secret, $code)) {
                $success = "2FA setup complete. You can now log in.";

                // Clear the session email as it's no longer needed
                unset($_SESSION['email']);

                // Redirect to the sign-in page
                header("Location: faculty_signin.php?message=" . urlencode($success));
                exit();
            } else {
                $error = "Invalid code. Please try again.";
            }
        } else {
            $error = "No 2FA secret found.";
        }
    } catch (Exception $e) {
        $error = "Exception error: " . $e->getMessage();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA Setup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"] {
            width: calc(100% - 20px);
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
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .message {
            margin-top: 20px;
            padding: 15px;
            text-align: center;
            font-size: 18px;
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
        .qr-code {
            text-align: center;
            margin: 20px 0;
        }
        .qr-code img {
            max-width: 200px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        .button {
            text-align: center;
        }
        .button a {
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
        .button a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>2FA Setup</h1>

    <?php if (!empty($success)): ?>
        <div class="message success"><?php echo htmlspecialchars($success); ?></div>
        <div class="button">
            <a href="faculty_signin.php">Go to Sign In</a>
        </div>
    <?php elseif (!empty($error)): ?>
        <div class="message error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <h2>Please Scan The QR Code using Google Authenticator</h2>
    <div class="qr-code">
        <img src="<?php echo htmlspecialchars($_SESSION['qrCodeUrl']); ?>" alt="QR Code">
    </div>

    <form action="2fa_setup.php" method="post">
        <label for="code">Enter 2FA Code:</label>
        <input type="text" id="code" name="code" required>

        <input type="submit" value="Verify Code">
    </form>
</div>

</body>
</html>