<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// If the session was propagated using a cookie, destroy that cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session
session_destroy();

// Redirect to login page or home page
header("Location: ../scripts/student_signin.php"); // Adjust the path as necessary
exit();