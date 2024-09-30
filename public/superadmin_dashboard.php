<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'superadmin') {
    header("Location: superadmin_login.php");
    exit();
}
?>

<h1>Welcome to Superadmin Dashboard</h1>
<p>Here you can manage admins, users, and all AR labs.</p>
<a href="manage_users.php">Manage Users</a><br>
<a href="manage_admins.php">Manage Admins</a><br>
<a href="manage_ar_labs.php">Manage AR Labs</a>
