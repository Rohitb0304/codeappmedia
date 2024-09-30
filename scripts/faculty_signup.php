<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
include '../config/db.php';
session_start();

use Google\Authenticator\GoogleAuthenticator;

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $mobile_number = htmlspecialchars(trim($_POST['mobile_number']));
    $whatsapp_number = htmlspecialchars(trim($_POST['whatsapp_number']));
    $school_name = htmlspecialchars(trim($_POST['school_name']));
    $city = htmlspecialchars(trim($_POST['city']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (!$email) {
        $error = "Invalid email format.";
    } else {
        try {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Generate a secret for 2FA
            $g = new GoogleAuthenticator();
            $secret = $g->generateSecret();

            // Insert faculty data into the faculty table with 2FA secret
            $stmt = $conn->prepare("INSERT INTO faculty (first_name, last_name, email, mobile_number, whatsapp_number, school_name, city, password, totp_secret) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $first_name, $last_name, $email, $mobile_number, $whatsapp_number, $school_name, $city, $hashed_password, $secret);

            if ($stmt->execute()) {
                $success = "Faculty registered successfully. Please set up your 2FA.";

                // Generate a QR Code URL for the faculty to scan with Google Authenticator
                $qrCodeUrl = $g->getURL('CodeApp Media', $email, $secret);

                // Store the QR Code URL and email in the session
                $_SESSION['qrCodeUrl'] = $qrCodeUrl;
                $_SESSION['email'] = $email;

                // Redirect to the 2FA setup page
                header("Location: 2fa_setup.php");
                exit();
            } else {
                $error = "Database error: " . $stmt->error;
            }

            $stmt->close();
        } catch (Exception $e) {
            $error = "Exception error: " . $e->getMessage();
        }
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .form-group label {
            font-weight: bold;
        }
        .alert {
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Faculty Registration</div>
                <div class="card-body">
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                    <?php elseif (!empty($error)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>

                    <form action="faculty_signup.php" method="post">
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email ID:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile_number">Mobile Number:</label>
                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" required>
                        </div>
                        <div class="form-group">
                            <label for="whatsapp_number">WhatsApp Number:</label>
                            <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" required>
                        </div>
                        <div class="form-group">
                            <label for="school_name">School Name:</label>
                            <input type="text" class="form-control" id="school_name" name="school_name" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>