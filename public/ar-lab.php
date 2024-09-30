<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start the session
include '../config/db.php'; // Include database configuration

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../scripts/student_signin.php');
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT first_name, last_name, photo_url FROM students WHERE student_id = ?";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    // Handle missing user data
    if (!$user) {
        $_SESSION = array(); // Clear session data
        session_destroy(); // Destroy session
        header('Location: ../scripts/student_signin.php');
        exit();
    }

    // Determine if photo URL exists
    $photo_url = !empty($user['photo_url']) ? $user['photo_url'] : 'default-profile-image.jpg';
} else {
    die("Query preparation failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AR Lab</title>
    <link rel="stylesheet" href="../static/css/ar-lab.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="greeting">Welcome, <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></div>
            <div class="profile-image-container">
                <img src="<?php echo htmlspecialchars($photo_url); ?>" alt="Profile Image" class="profile-image">
                <i class="fas fa-user profile-icon"></i>
            </div>
            <a href="#" class="menu-item">Syllabus</a>
            <a href="#" class="menu-item">Join Telegram Channel</a>
            <a href="#" class="menu-item">Join Whatsapp Group</a>
            <button class="logout-btn" id="logout">Logout</button>
        </div>
        <div class="main-content">
            <div class="quote">"The only limit to our realization of tomorrow is our doubts of today."</div>
            <div class="container-section">
                <div class="section-header">
                    <h2>10th Science Augmented Reality Lab</h2>
                    <div>Section 1</div>
                </div>
                <table class="topics-table">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Topic</th>
                            <th>Notes</th>
                            <th>Reference Book</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="../data/chapter-1.html">Gravitation</a></td>
                            <td>Download</td>
                            <td>AR Concepts</td>
                        </tr>
                        <!-- Add other rows here -->
                    </tbody>
                </table>
            </div>
            <div class="container-section">
                <div class="section-header">
                    <h2>10th Science Augmented Reality Lab</h2>
                    <div>Section 2</div>
                </div>
                <table class="topics-table">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Topic</th>
                            <th>Notes</th>
                            <th>Reference Book</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>9</td>
                            <td><a href="#">Introduction to Augmented Reality</a></td>
                            <td>Download</td>
                            <td>AR Concepts</td>
                        </tr>
                        <!-- Add other rows here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('logout').addEventListener('click', function() {
            window.location.href = 'student_logout.php';
        });
    </script>
</body>
</html>