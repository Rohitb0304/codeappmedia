<?php
include '../config/db.php';
session_start();
require '../vendor/autoload.php';

use Sonata\GoogleAuthenticator\GoogleAuthenticator;

$login_error = '';
$login_success = '';
$show_2fa = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['code'])) {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = htmlspecialchars(trim($_POST['password']));

    if (!$email) {
        $login_error = "Invalid email format.";
    } else {
        try {
            $stmt = $conn->prepare("SELECT faculty_id, password, totp_secret FROM faculty WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 1) {
                $stmt->bind_result($faculty_id, $hashed_password, $secret);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    if ($secret) {
                        $show_2fa = true;
                        $_SESSION['temp_email'] = $email;
                    } else {
                        login_user($faculty_id, $email, $conn);
                    }
                } else {
                    $login_error = "Invalid password.";
                }
            } else {
                $login_error = "No user found with this email.";
            }

            $stmt->close();
        } catch (Exception $e) {
            $login_error = "Error: " . $e->getMessage();
        }
    }

    $conn->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['code']) && isset($_SESSION['temp_email'])) {
    $email = $_SESSION['temp_email'];
    $code = htmlspecialchars(trim($_POST['code']));

    try {
        $stmt = $conn->prepare("SELECT faculty_id, totp_secret FROM faculty WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($faculty_id, $secret);
            $stmt->fetch();

            $g = new GoogleAuthenticator();
            if ($g->checkCode($secret, $code)) {
                login_user($faculty_id, $email, $conn);
                unset($_SESSION['temp_email']);
            } else {
                $login_error = "Invalid 2FA code.";
                $show_2fa = true;
            }
        } else {
            $login_error = "No user found with this email.";
        }

        $stmt->close();
    } catch (Exception $e) {
        $login_error = "Error: " . $e->getMessage();
    }

    $conn->close();
}

function login_user($faculty_id, $email, $conn) {
    $login_time = date("Y-m-d H:i:s");
    $ip_address = $_SERVER['REMOTE_ADDR'];

    $update_stmt = $conn->prepare("UPDATE faculty SET last_login=?, ip_address=? WHERE faculty_id=?");
    $update_stmt->bind_param("ssi", $login_time, $ip_address, $faculty_id);
    $update_stmt->execute();
    $update_stmt->close();

    $_SESSION['faculty_id'] = $faculty_id;
    $_SESSION['email'] = $email;

    header("Location: ../public/faculty_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Sign In</title>
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">Faculty Sign In</div>
                <div class="card-body">
                    <?php if (!empty($login_success)): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($login_success); ?></div>
                    <?php elseif (!empty($login_error)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($login_error); ?></div>
                    <?php endif; ?>

                    <form action="faculty_signin.php" method="post">
                        <?php if (!$show_2fa): ?>
                            <div class="form-group">
                                <label for="email">Email ID:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        <?php else: ?>
                            <div class="form-group">
                                <label for="code">2FA Code:</label>
                                <input type="text" class="form-control" id="code" name="code" required>
                            </div>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
