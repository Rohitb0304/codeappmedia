<?php
session_start();

// Check if the user is authenticated
$isAuthenticated = isset($_SESSION['user_id']);
$userEmail = $isAuthenticated ? htmlspecialchars($_SESSION['email']) : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="../static/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo"><a href="">CodeAppMedia</a></div>
            <ul class="links">
                <li><a href="maze-game.php">Play Game</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="courses.php">Courses</a></li>
                <li class="dropdown-hover">
                    <a href="compilers.php" class="dropdown-toggle">Run Compilers</a>
                    <div class="dropdown-content">
                        <a href="#">Java</a>
                        <a href="#">Python</a>
                        <a href="#">JavaScript</a>
                        <!-- Add more compilers as needed -->
                    </div>
                </li>
                <li><a href="about.php">About</a></li>
                <li><a href="ar-lab.php" class="ghost-btn">Go to AR Lab</a></li>
            </ul>
            <div class="profile">
                <?php if ($isAuthenticated): ?>
                    <div class="profile-icon" id="profile-icon">
                        <i class="fa-solid fa-user"></i>
                        <div class="dropdown" id="profile-dropdown">
                            <ul>
                                <li><?php echo $userEmail; ?></li>
                                <li><a href="../pages/settings.php">Settings</a></li>
                                <li><a href="student_logout.php" id="logout">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="auth-links">
                        <!-- <a href="../scripts/student_signin.php" class="ghost-btn">Get Started</a> -->
                        <a href="../scripts/student_signin.php?redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" class="ghost-btn">Get Started</a>

                    </div>
                <?php endif; ?>
            </div>
            <div class="toggle_btn" id="toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="dropdown_menu" id="dropdown_menu">
            <ul>
                <li><a href="maze-game.php">Play Game</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="courses.php">Courses</a></li>
                <li class="dropdown-hover">
                    <a href="compilers.php" class="dropdown-toggle">Run Compilers</a>
                    <div class="dropdown-content">
                        <a href="#">Java</a>
                        <a href="#">Python</a>
                        <a href="#">JavaScript</a>
                    </div>
                </li>
                <li><a href="about.php">About</a></li>
                <li><a href="ar-lab.php" class="ghost-btn">Go to AR Lab</a></li>
            </ul>
        </div>
    </header>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('toggle_btn');
            const dropdownMenu = document.getElementById('dropdown_menu');
            const profileIcon = document.getElementById('profile-icon');
            const profileDropdown = document.getElementById('profile-dropdown');

            toggleBtn.addEventListener('click', () => {
                dropdownMenu.classList.toggle('open');
            });

            // Close dropdown if clicked outside
            document.addEventListener('click', (event) => {
                if (!toggleBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.remove('open');
                }
            });

            if (profileIcon) {
                profileIcon.addEventListener('click', () => {
                    profileDropdown.classList.toggle('open');
                });

                document.addEventListener('click', (event) => {
                    if (!profileIcon.contains(event.target) && !profileDropdown.contains(event.target)) {
                        profileDropdown.classList.remove('open');
                    }
                });
            }

            // Logout functionality
            const logout = document.getElementById('logout');
            if (logout) {
                logout.addEventListener('click', () => {
                    fetch('../pages/logout.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: ''
                    })
                    .then(response => response.text())
                    .then(data => {
                        window.location.href = '../scripts/student_signin.php';
                    })
                    .catch(error => console.error('Error:', error));
                });
            }
        });
    </script>
</body>
</html>
