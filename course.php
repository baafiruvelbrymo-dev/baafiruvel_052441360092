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
    <title>Course Registration - KSTU Student Portal</title>
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
            <a href="course.php" class="active">Course Registration</a>
            <a href="upload_passport.php">Upload Passport</a>
            <a href="view_profile.php">View Profile</a>
            <a href="results.php">Statement of Results</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="main-content">
        <h2 class="page-title">Course Registration</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>! Please select your courses below. You can select maximum 10 courses.</p>

        <!-- Course Registration Form -->
        <div class="profile-card" style="margin-top: 20px;">
            <form action="course.php" method="POST">
                
                <?php
                // Check if form is submitted
                if (isset($_POST['submit'])) {
                    
                    // Get selected courses
                    $courses = isset($_POST['courses']) ? $_POST['courses'] : array();
                    
                    // Variable to track errors
                    $errors = array();

                    // Validate that at least one course is selected - using if statement
                    if (count($courses) === 0) {
                        $errors[] = "Please select at least one course!";
                    }

                    // Check if more than 10 courses are selected - using if statement
                    if (count($courses) > 10) {
                        $errors[] = "You can only select maximum 10 courses! You selected " . count($courses) . " courses.";
                    }

                    // Use switch statement to show message based on course count
                    $course_count = count($courses);
                    switch ($course_count) {
                        case 0:
                            // No courses selected - error already shown above
                            break;
                        case 1:
                        case 2:
                        case 3:
                            // Allow 1-3 courses - no special message
                            break;
                        case 4:
                        case 5:
                        case 6:
                            // Good selection
                            echo '<div class="alert alert-success"><p>Great! You have selected ' . $course_count . ' courses.</p></div>';
                            break;
                        case 7:
                        case 8:
                        case 9:
                            // Good selection
                            echo '<div class="alert alert-success"><p>Excellent! You have selected ' . $course_count . ' courses.</p></div>';
                            break;
                        case 10:
                            // Maximum allowed
                            echo '<div class="alert alert-success"><p>You have selected the maximum 10 courses allowed!</p></div>';
                            break;
                        default:
                            // More than 10 - error already shown above
                            break;
                    }

                    // Display error messages if there are any
                    if (count($errors) > 0) {
                        echo '<div class="alert alert-error">';
                        foreach ($errors as $error) {
                            echo "<p>Warning: $error</p>";
                        }
                        echo '</div>';
                    } else {
                        // If everything is correct, save courses into session
                        // Store courses as comma-separated string
                        $_SESSION['courses'] = implode(", ", $courses);

                        // Redirect to upload page
                        header("Location: upload_passport.php");
                        exit();
                    }
                    
                }
                ?>

                <div class="profile-body">
                    <h3>Select Your Courses (Choose 1-10 courses):</h3>
                    
                    <div class="checkbox-grid">
                        <div class="checkbox-item">
                            <input type="checkbox" name="courses[]" id="cs101" value="CS101 - Introduction to Programming">
                            <label for="cs101">CS101 - Advance Java Programming</label>
                        </div>
                        
                        <div class="checkbox-item">
                            <input type="checkbox" name="courses[]" id="cs102" value="CS102 - Data Structures">
                            <label for="cs102">CS102 - Backend Web Development</label>
                        </div>
                        
                        <div class="checkbox-item">
                            <input type="checkbox" name="courses[]" id="cs201" value="CS201 - Database Systems">
                            <label for="cs201">CS201 - Database Concepts and Systems</label>
                        </div>
                        
                        <div class="checkbox-item">
                            <input type="checkbox" name="courses[]" id="cs202" value="CS202 - Web Development">
                            <label for="cs202">CS202 -Frontend Web Development</label>
                        </div>
                        
                        <div class="checkbox-item">
                            <input type="checkbox" name="courses[]" id="cs301" value="CS301 - Algorithms">
                            <label for="cs301">CS301 - Discrete Mathematics</label>
                        </div>
                        
                        <div class="checkbox-item">
                            <input type="checkbox" name="courses[]" id="cs302" value="CS302 - Operating Systems">
                            <label for="cs302">CS302 - Operation Research</label>
                        </div>
                        
                        <div class="checkbox-item">
                            <input type="checkbox" name="courses[]" id="math101" value="MATH101 - Calculus I">
                            <label for="math101">SYS101 - System Analysis and Design</label>
                        </div>
                        
                        <div class="checkbox-item">
                            <input type="checkbox" name="courses[]" id="math201" value="MATH201 - Calculus II">
                            <label for="math201">OPS201 - Open Source</label>
                        </div>
                        
                        <div class="checkbox-item">
                            <input type="checkbox" name="courses[]" id="math301" value="MATH301 - Linear Algebra">
                            <label for="math301">COS301 - Communication Skills</label>
                        </div>
                        
                        <div class="checkbox-item">
                            <input type="checkbox" name="courses[]" id="phy101" value="PHY101 - Physics I">
                            <label for="phy101">AOS101 - African Studies</label>
                        </div>
                        
                        <div class="checkbox-item">
                            <input type="checkbox" name="courses[]" id="phy201" value="PHY201 - Physics II">
                            <label for="phy201">HCI201 - Human Computer Interaction</label>
                        </div>
                        
                        <div class="checkbox-item">
                            <input type="checkbox" name="courses[]" id="eng101" value="ENG101 - Technical Writing">
                            <label for="eng101">CRT101 - Critical Thinking</label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div style="padding: 20px;">
                    <button type="submit" name="submit" class="btn-submit">Continue to Upload Photo</button>
                </div>
                
            </form>
        </div>

    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <p>&copy; <?php echo date("Y"); ?> <span>Kumasi Technical University</span> | Student Portal System</p>
    </footer>

</body>
</html>
