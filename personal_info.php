<?php
// Start session - This must be at the very top before any HTML output
session_start();

// Protect the page - Check if user is logged in
// If not logged in, redirect to login page
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information - KSTU Student Portal</title>
    <!-- Link external CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Top Header Bar -->
    <header class="top-header">
        <div class="university-name">
            KSTU Student Portal
        </div>
        <div class="header-right">
            <span class="student-name">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></span>
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>
    </header>

    <!-- Left Sidebar Navigation -->
    <nav class="sidebar">
        <div class="sidebar-menu">
            <a href="dashboard.php">Dashboard</a>
            <a href="personal_info.php" class="active">Personal Information</a>
            <a href="course.php">Course Registration</a>
            <a href="upload_passport.php">Upload Passport</a>
            <a href="view_profile.php">View Profile</a>
            <a href="results.php">Statement of Results</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="main-content">
        <h2 class="page-title">Personal Information</h2>
        
        <!-- Profile Card -->
        <div class="profile-card">
            <div class="profile-header">
                <h2>Student Details</h2>
            </div>
            
            <div class="profile-body">
                <div class="profile-row">
                    <span class="profile-label">Email Address:</span>
                    <span class="profile-value"><?php echo htmlspecialchars($_SESSION['email']); ?></span>
                </div>
                
                <div class="profile-row">
                    <span class="profile-label">Full Name:</span>
                    <span class="profile-value"><?php echo htmlspecialchars($_SESSION['name']); ?></span>
                </div>
                
                <div class="profile-row">
                    <span class="profile-label">Date of Birth:</span>
                    <span class="profile-value"><?php echo htmlspecialchars($_SESSION['dob']); ?></span>
                </div>
                
                <div class="profile-row">
                    <span class="profile-label">Gender:</span>
                    <span class="profile-value"><?php echo htmlspecialchars($_SESSION['gender']); ?></span>
                </div>
                
                <div class="profile-row">
                    <span class="profile-label">Phone Number:</span>
                    <span class="profile-value"><?php echo htmlspecialchars($_SESSION['phone']); ?></span>
                </div>
            </div>
        </div>
        
        <!-- Quick Links -->
        <div style="margin-top: 30px; text-align: center;">
            <a href="dashboard.php" class="btn-submit" style="width: auto; padding: 12px 30px; display: inline-block;">Back to Dashboard</a>
            <a href="course.php" class="btn-submit" style="width: auto; padding: 12px 30px; display: inline-block;">Register Courses</a>
        </div>
        
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <p>&copy; <?php echo date("Y"); ?> <span>Kumasi Technical University</span> | Student Portal System</p>
    </footer>

</body>
</html>
