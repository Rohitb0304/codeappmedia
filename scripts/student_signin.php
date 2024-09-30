<?php
include '../config/db.php';
session_start();

$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : '../public/index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = htmlspecialchars(trim($_POST['password']));

    if (!$email) {
        $error = "Invalid email format.";
    } else {
        $stmt = $conn->prepare("SELECT student_id, password FROM students WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows === 1) {
                $stmt->bind_result($student_id, $hashed_password);
                $stmt->fetch();
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['user_id'] = $student_id;
                    $_SESSION['email'] = $email;
                    header("Location: $redirect");
                    exit();
                } else {
                    $error = "Invalid credentials.";
                }
            } else {
                $error = "No student user found.";
            }
            $stmt->close();
        } else {
            $error = "Failed to prepare statement: " . $conn->error;
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
    <title>Student Login</title>
    <link rel="stylesheet" href="../static/css/signup.css">
</head>
<body>
<div class="container">
        <div class="form-box">
            <h1 class="title">Sign In</h1>
            <div class="underline"></div>
            <form action="student_signin.php?redirect=<?php echo urlencode($redirect); ?>" method="post" id="signinForm" novalidate>
                
                <div class="input-field mailfield">
                    <input type="email" id="email" name="email" required placeholder="Email ID">
                    <label for="email">Email ID</label>
                </div>

                <div class="input-field">
                    <input type="password" id="password" name="password" required placeholder="Password">
                    <label for="password">Password</label>
                </div>

                <?php if (isset($error)): ?>
                    <p class="error"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>

                <div class="btn-field">
                    <button class="signupbtn" type="submit">Sign In</button>
                </div>

                <div class="form-footer">
                    <p>Don't have an account? <a href="student_signup.php?redirect=<?php echo urlencode($redirect); ?>" class="footer-link">Sign Up</a></p>
                </div>
            </form>
        </div>        
    </div> 
</body>
</html>