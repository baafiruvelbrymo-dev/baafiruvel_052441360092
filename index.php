<?php
// Start session - This must be at the very top before any HTML output
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KSTU Student Portal - Home</title>
    <!-- Link external CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- ========================================
         HEADER SECTION
         Contains university name and navigation
    ======================================== -->
    <header class="top-header">
        <div class="university-name">
            KSTU Student Portal
        </div>
        <div class="header-right">
            <a href="index.php" style="color: white; text-decoration: none; margin-right: 20px;">Home</a>
            <!-- If user is NOT logged in, show Login link -->
            <?php
            // Check if user is logged in using if statement
            if (!isset($_SESSION['loggedin'])) {
                echo '<a href="login.php" style="color: var(--kstu-gold); text-decoration: none; font-weight: bold;">Login</a>';
            } else {
                // If user IS logged in, show dashboard link
                echo '<a href="dashboard.php" style="color: var(--kstu-gold); text-decoration: none; font-weight: bold;">Dashboard</a>';
            }
            ?>
        </div>
    </header>

    <!-- ========================================
         MAIN CONTENT SECTION
    ======================================== -->
    <main class="main-content" style="margin-left: 0; padding: 0;">
        
        <?php
        // Check if user is NOT logged in - show hero section
        // Using if statement to check session
        if (!isset($_SESSION['loggedin'])) {
        ?>
        
        <!-- HERO SECTION - For users NOT logged in -->
        <section class="hero-section">
            <!-- Hero content -->
            <div class="hero-content">
                <h1>Welcome to KSTU</h1>
                <h2>Student Course Registration Portal</h2>
                <p>Kumasi Technical University</p>
                <p>Manage your courses, upload your passport photo, and view your profile all in one place.</p>
                
                <!-- Login Button -->
                <a href="login.php" class="btn-hero">Student Login</a>
                
                <div class="hero-features">
                    <div class="hero-feature">
                        <p>Course Registration</p>
                    </div>
                    <div class="hero-feature">
                        <p>Passport Upload</p>
                    </div>
                    <div class="hero-feature">
                        <p>View Profile</p>
                    </div>
                </div>
            </div>
        </section>

        <?php
        // Using else statement for logged in users
        } else {
        ?>
        
        <!-- PROFILE CARD SECTION - For logged in users -->
        <section class="profile-hero-section">
            <div class="profile-welcome-card">
                <h2>Welcome Back!</h2>
                <p>You are logged in to KSTU Student Portal</p>
                
                <!-- Profile card -->
                <div class="profile-card" style="max-width: 400px; margin: 30px auto;">
                    <div class="profile-header">
                        <h2>My Profile</h2>
                    </div>
                    
                    <div class="profile-body">
                        <!-- Profile Picture -->
                        <div class="profile-image-container">
                            <?php
                            // Check if passport is uploaded - using if statement
                            if (isset($_SESSION['image']) && !empty($_SESSION['image'])) {
                                echo '<img src="uploads/' . htmlspecialchars($_SESSION['image']) . '" alt="Profile Photo">';
                            } else {
                                echo '<p style="font-size: 40px; color: var(--kstu-navy);">Student</p>';
                            }
                            ?>
                        </div>
                        
                        <!-- Student Name -->
                        <div class="profile-row">
                            <span class="profile-label">Name:</span>
                            <span class="profile-value"><?php echo htmlspecialchars($_SESSION['name']); ?></span>
                        </div>
                        
                        <!-- Student Email -->
                        <div class="profile-row">
                            <span class="profile-label">Email:</span>
                            <span class="profile-value"><?php echo htmlspecialchars($_SESSION['email']); ?></span>
                        </div>
                        
                        <!-- Dashboard Button -->
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="dashboard.php" class="btn-submit" style="width: auto; padding: 14px 40px; display: inline-block;">Go to Dashboard</a>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div style="margin-top: 20px;">
                    <a href="course.php" style="color: white; margin: 0 15px;">Register Courses</a>
                    <a href="upload_passport.php" style="color: white; margin: 0 15px;">Upload Photo</a>
                    <a href="view_profile.php" style="color: white; margin: 0 15px;">My Profile</a>
                </div>
            </div>
        </section>

        <?php
        // End of if...else statement
        }
        ?>

    </main>

    <!-- ========================================
         FOOTER SECTION
    ======================================== -->
    <footer class="main-footer">
        <p>&copy; <?php echo date("Y"); ?> <span>Kumasi Technical University</span> | Student Portal System</p>
    </footer>

</body>
</html>
