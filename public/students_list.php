<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['faculty_id'])) {
    header("Location: ../scripts/faculty_signin.php");
    exit();
}

// Fetch list of students
$students_stmt = $conn->prepare("SELECT first_name, last_name, email, mobile_number, whatsapp_number, school_name, city FROM students ORDER BY created_at DESC");
$students_stmt->execute();
$students_stmt->bind_result($student_first_name, $student_last_name, $student_email, $student_mobile_number, $student_whatsapp_number, $student_school_name, $student_city);

// HTML structure for student list
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <link rel="stylesheet" href="../static/css/dashboard.css">
</head>
<body>
    <h1>List of Students</h1>
    <table border="1">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>WhatsApp Number</th>
            <th>School Name</th>
            <th>City</th>
        </tr>
        <?php while ($students_stmt->fetch()): ?>
            <tr>
                <td><?php echo htmlspecialchars($student_first_name); ?></td>
                <td><?php echo htmlspecialchars($student_last_name); ?></td>
                <td><?php echo htmlspecialchars($student_email); ?></td>
                <td><?php echo htmlspecialchars($student_mobile_number); ?></td>
                <td><?php echo htmlspecialchars($student_whatsapp_number); ?></td>
                <td><?php echo htmlspecialchars($student_school_name); ?></td>
                <td><?php echo htmlspecialchars($student_city); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <?php $students_stmt->close(); ?>
    <a href="faculty_dashboard.php">Back to Dashboard</a>
</body>
</html>

<?php $conn->close(); ?>
