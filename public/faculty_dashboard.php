<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['faculty_id'])) {
    header("Location: ../scripts/faculty_signin.php");
    exit();
}

$faculty_id = $_SESSION['faculty_id'];

$stmt = $conn->prepare("SELECT first_name, last_name, email, school_name, city, last_login, ip_address FROM faculty WHERE faculty_id = ?");
$stmt->bind_param("i", $faculty_id);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $email, $school_name, $city, $last_login, $ip_address);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="../static/css/dashboard.css">
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></h1>
    <p>Email: <?php echo htmlspecialchars($email); ?></p>
    <p>School: <?php echo htmlspecialchars($school_name); ?></p>
    <p>City: <?php echo htmlspecialchars($city); ?></p>
    <p>Last Login: <?php echo htmlspecialchars($last_login); ?></p>
    <a href="faculty_logout.php">Logout</a>

    <h2>Actions</h2>
    <a href="students_list.php">View Students</a>
</body>
</html>

<?php $conn->close(); ?>