<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../scripts/student_signin.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT first_name, last_name, email, school_name, city FROM students WHERE student_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $email, $school_name, $city);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../static/css/dashboard.css">
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></h1>
    <p>Email: <?php echo htmlspecialchars($email); ?></p>
    <p>School: <?php echo htmlspecialchars($school_name); ?></p>
    <p>City: <?php echo htmlspecialchars($city); ?></p>
    <a href="student_logout.php">Logout</a>
</body>
</html>