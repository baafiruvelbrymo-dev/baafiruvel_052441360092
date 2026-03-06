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
    <title>Upload Passport - KSTU Student Portal</title>
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
            <a href="upload_passport.php" class="active">Upload Passport</a>
            <a href="view_profile.php">View Profile</a>
            <a href="results.php">Statement of Results</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="main-content">
        <h2 class="page-title">Upload Passport Photo</h2>
        
        <?php
        // Check if form is submitted
        if (isset($_POST['submit'])) {
            
            // Check if file was uploaded without errors
            if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                
                // Get file details
                $file_name = $_FILES['image']['name'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_size = $_FILES['image']['size'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                
                // Variable to track errors
                $errors = array();
                
                // Define maximum file size (3MB = 3145728 bytes)
                // Using if statement to check file size
                $max_size = 3 * 1024 * 1024;
                if ($file_size > $max_size) {
                    $errors[] = "File size is too large! Maximum allowed size is 3MB.";
                }
                
                // Allow only jpg, jpeg, png - using if statement
                if ($file_ext !== 'jpg' && $file_ext !== 'jpeg' && $file_ext !== 'png') {
                    $errors[] = "Invalid file type! Only JPG, JPEG, and PNG files are allowed.";
                }
                
                // Display error messages if there are any
                if (count($errors) > 0) {
                    echo '<div class="alert alert-error">';
                    foreach ($errors as $error) {
                        echo "<p>Warning: $error</p>";
                    }
                    echo '</div>';
                } else {
                    // If everything is correct, upload the file
                    // Create unique filename to prevent overwriting
                    $new_file_name = time() . "_" . str_replace(" ", "_", $_SESSION['name']) . "." . $file_ext;
                    $upload_path = "uploads/" . $new_file_name;
                    
                    // Move uploaded file to uploads folder using move_uploaded_file()
                    if (move_uploaded_file($file_tmp, $upload_path)) {
                        // Save filename into session
                        $_SESSION['image'] = $new_file_name;
                        
                        // Show success message
                        echo '<div class="alert alert-success">';
                        echo '<p>Passport photo uploaded successfully!</p>';
                        echo '</div>';
                    } else {
                        echo '<div class="alert alert-error">';
                        echo '<p>Error uploading file! Please try again.</p>';
                        echo '</div>';
                    }
                }
                
            } else {
                // File was not uploaded - using if...else statement
                echo '<div class="alert alert-error">';
                echo '<p>Please select a file to upload!</p>';
                echo '</div>';
            }
        }
        ?>

        <!-- Upload Form -->
        <div class="profile-card">
            <div class="profile-header">
                <h2>Upload Your Passport Photo</h2>
            </div>
            
            <div class="profile-body">
                <form action="upload_passport.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="form-section">
                        <h3>Select Your Passport Photo:</h3>
                        
                        <div class="file-upload-group">
                            <p>Allowed file types: JPG, JPEG, PNG</p>
                            <p>Maximum file size: 3MB</p>
                            
                            <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png">
                            
                            <p class="file-info">Click the button above to select your passport photo</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="submit" class="btn-submit">Upload Passport</button>
                    
                </form>

                <!-- Quick Links -->
                <div style="text-align: center; margin-top: 30px;">
                    <a href="view_profile.php" class="btn-submit" style="width: auto; padding: 12px 30px; display: inline-block;">View My Profile</a>
                    <a href="dashboard.php" class="btn-submit" style="width: auto; padding: 12px 30px; display: inline-block;">Back to Dashboard</a>
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
