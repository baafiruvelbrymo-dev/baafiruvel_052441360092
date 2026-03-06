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
    <title>Dashboard - KSTU Student Portal</title>
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
            <a href="dashboard.php" class="active">Dashboard</a>
            <a href="personal_info.php">Personal Information</a>
            <a href="course.php">Course Registration</a>
            <a href="upload_passport.php">Upload Passport</a>
            <a href="view_profile.php">View Profile</a>
            <a href="results.php">Statement of Results</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="main-content">
        <h2 class="page-title">Student Dashboard</h2>
        
        <!-- Welcome Message -->
        <div class="alert alert-success">
            <p>Welcome back, <strong><?php echo htmlspecialchars($_SESSION['name']); ?></strong>! 
            Complete your registration to get started.</p>
        </div>
        
        <!-- Dashboard Summary Cards -->
        <div class="dashboard-cards">
            
            <!-- Total Courses Card -->
            <div class="dashboard-card">
                <h3>Total Courses Selected</h3>
                <?php
                // Check if courses are registered
                if (isset($_SESSION['courses']) && !empty($_SESSION['courses'])) {
                    $course_array = explode(", ", $_SESSION['courses']);
                    $total_courses = count($course_array);
                    echo '<div class="number">' . $total_courses . '</div>';
                    echo '<div class="status">Courses Registered</div>';
                } else {
                    echo '<div class="number">0</div>';
                    echo '<div class="status pending">Not Registered</div>';
                }
                ?>
            </div>
            
            <!-- Profile Status Card -->
            <div class="dashboard-card">
                <h3>Profile Status</h3>
                <?php
                // Check if all profile information is complete
                $profile_complete = true;
                if (!isset($_SESSION['name']) || empty($_SESSION['name'])) {
                    $profile_complete = false;
                }
                if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
                    $profile_complete = false;
                }
                
                if ($profile_complete) {
                    echo '<div class="number">100%</div>';
                    echo '<div class="status">Profile Complete</div>';
                } else {
                    echo '<div class="number">0%</div>';
                    echo '<div class="status pending">Profile Incomplete</div>';
                }
                ?>
            </div>
            
            <!-- Passport Status Card -->
            <div class="dashboard-card">
                <h3>Passport Photo</h3>
                <?php
                // Check if passport is uploaded
                if (isset($_SESSION['image']) && !empty($_SESSION['image'])) {
                    echo '<div class="number">Yes</div>';
                    echo '<div class="status">Photo Uploaded</div>';
                } else {
                    echo '<div class="number">No</div>';
                    echo '<div class="status pending">Not Uploaded</div>';
                }
                ?>
            </div>
            
            <!-- Registration Status Card -->
            <div class="dashboard-card">
                <h3>Registration Status</h3>
                <?php
                // Use switch statement to determine status
                $status = 0;
                
                if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
                    $status++;
                }
                if (isset($_SESSION['courses']) && !empty($_SESSION['courses'])) {
                    $status++;
                }
                if (isset($_SESSION['image']) && !empty($_SESSION['image'])) {
                    $status++;
                }
                
                switch ($status) {
                    case 0:
                        echo '<div class="number">0/3</div>';
                        echo '<div class="status pending">Just Started</div>';
                        break;
                    case 1:
                        echo '<div class="number">1/3</div>';
                        echo '<div class="status pending">In Progress</div>';
                        break;
                    case 2:
                        echo '<div class="number">2/3</div>';
                        echo '<div class="status pending">Almost Done</div>';
                        break;
                    case 3:
                        echo '<div class="number">3/3</div>';
                        echo '<div class="status">Complete!</div>';
                        break;
                    default:
                        echo '<div class="number">0/3</div>';
                        echo '<div class="status pending">Not Started</div>';
                }
                ?>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="dashboard-card" style="margin-top: 20px;">
            <h3>Quick Actions</h3>
            <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-top: 15px;">
                <a href="personal_info.php" class="btn-submit" style="width: auto; padding: 12px 25px;">View Personal Info</a>
                <a href="course.php" class="btn-submit" style="width: auto; padding: 12px 25px;">Register Courses</a>
                <a href="upload_passport.php" class="btn-submit" style="width: auto; padding: 12px 25px;">Upload Passport</a>
                <a href="view_profile.php" class="btn-submit" style="width: auto; padding: 12px 25px;">View Full Profile</a>
            </div>
        </div>
        
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <p>&copy; <?php echo date("Y"); ?> <span>Kumasi Technical University</span> | Student Portal System</p>
    </footer>

</body>
</html>
