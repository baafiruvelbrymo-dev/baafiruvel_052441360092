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
    <title>View Profile - KSTU Student Portal</title>
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
            <a href="personal_info.php">Personal Information</a>
            <a href="course.php">Course Registration</a>
            <a href="upload_passport.php">Upload Passport</a>
            <a href="view_profile.php" class="active">View Profile</a>
            <a href="results.php">Statement of Results</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="main-content">
        <h2 class="page-title">View Profile</h2>
        
        <!-- Profile Card -->
        <div class="profile-card">
            <div class="profile-header">
                <h2>Student Profile</h2>
            </div>
            
            <div class="profile-body">
                <!-- Personal Information -->
                <h3 style="color: var(--kstu-navy); margin-bottom: 15px;">Personal Information</h3>
                
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
                
                <!-- Passport Photo Section -->
                <h3 style="color: var(--kstu-navy); margin: 25px 0 15px 0;">Passport Photo</h3>
                
                <div class="profile-image-container">
                    <?php
                    // Check if passport photo is uploaded - using if statement
                    if (isset($_SESSION['image']) && !empty($_SESSION['image'])) {
                        echo '<img src="uploads/' . htmlspecialchars($_SESSION['image']) . '" alt="Passport Photo">';
                    } else {
                        echo '<p>No passport photo uploaded yet. <a href="upload_passport.php">Click here to upload</a></p>';
                    }
                    ?>
                </div>
                
                <!-- Courses Section -->
                <h3 style="color: var(--kstu-navy); margin: 25px 0 15px 0;">Registered Courses</h3>
                
                <?php
                // Check if courses are registered - using if statement
                if (isset($_SESSION['courses']) && !empty($_SESSION['courses'])) {
                    $courses = $_SESSION['courses'];
                    $course_array = explode(", ", $courses);
                    $total_courses = count($course_array);
                    
                    echo '<div class="profile-courses">';
                    echo '<p><strong>Total Courses: ' . $total_courses . '</strong></p>';
                    echo '<ul>';
                    
                    // Loop through courses using foreach
                    foreach ($course_array as $course) {
                        echo '<li>' . htmlspecialchars($course) . '</li>';
                    }
                    
                    echo '</ul>';
                    echo '</div>';
                } else {
                    echo '<p>No courses registered yet. <a href="course.php">Click here to register courses</a></p>';
                }
                ?>
                
                <!-- Quick Links -->
                <div style="text-align: center; margin-top: 30px;">
                    <a href="dashboard.php" class="btn-submit" style="width: auto; padding: 12px 30px; display: inline-block;">Back to Dashboard</a>
                    <a href="logout.php" class="btn-logout">Logout</a>
                </div>
            </div>
        </div>
        
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <p>&copy; <?php echo date("Y"); ?> <span>Kumasi Technical University</span> | Student Portal System</p>
    </footer>

</body>
</html>
