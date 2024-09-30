<?php
session_start();
include '../config/db.php'; // Ensure this path is correct

// Check if the user is logged in and has admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../scripts/admin_login.php");
    exit();
}

// Fetch students
$students_query = "SELECT student_id, first_name, last_name, email, school_name, city FROM students";
$students_result = $conn->query($students_query);

// Fetch faculty
$faculty_query = "SELECT faculty_id, first_name, last_name, email, school_name, city FROM faculty";
$faculty_result = $conn->query($faculty_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Manage Users</h1>

        <h2 class="mt-4">Students</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>School Name</th>
                    <th>City</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($students_result->num_rows > 0): ?>
                    <?php while ($student = $students_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                            <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                            <td><?php echo htmlspecialchars($student['school_name']); ?></td>
                            <td><?php echo htmlspecialchars($student['city']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6">No students found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2 class="mt-4">Faculty</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Faculty ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>School Name</th>
                    <th>City</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($faculty_result->num_rows > 0): ?>
                    <?php while ($faculty = $faculty_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($faculty['faculty_id']); ?></td>
                            <td><?php echo htmlspecialchars($faculty['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($faculty['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($faculty['email']); ?></td>
                            <td><?php echo htmlspecialchars($faculty['school_name']); ?></td>
                            <td><?php echo htmlspecialchars($faculty['city']); ?></td>
                            <td>
                                <a href="edit_faculty.php?id=<?php echo $faculty['faculty_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_faculty.php?id=<?php echo $faculty['faculty_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this faculty?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="7">No faculty found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>