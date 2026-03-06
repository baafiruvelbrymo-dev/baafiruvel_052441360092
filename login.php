<?php
// Start session - This must be at the very top before any HTML output
session_start();

// Check if user is already logged in, redirect to dashboard
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KSTU Student Portal - Login</title>
    <!-- Link external CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-page">

    <!-- Top Header Bar -->
    <header class="top-header">
        <div class="university-name">
            KSTU Student Portal
        </div>
        <div class="header-right">
            <span class="student-name">Academic Year 2024-2025</span>
        </div>
    </header>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-box">
            <h2>Student Login</h2>
            
            <!-- Login and Personal Info Form -->
            <form action="login.php" method="POST">
                
                <!-- Login Credentials Section -->
                <div class="form-section">
                    <h3>Login Credentials</h3>
                    
                    <?php
                    // Check if form is submitted
                    if (isset($_POST['submit'])) {
                        
                        // Get form data
                        $email = trim($_POST['email']);
                        $password = $_POST['password'];
                        $name = trim($_POST['name']);
                        $dob = $_POST['dob'];
                        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
                        $phone = trim($_POST['phone']);
                        
                        // Variable to track errors
                        $errors = array();

                        // Validate email - using if statement
                        if (empty($email)) {
                            $errors[] = "Email is required!";
                        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $errors[] = "Please enter a valid email address!";
                        }

                        // Validate password - using if statement
                        if (empty($password)) {
                            $errors[] = "Password is required!";
                        } elseif (strlen($password) < 6) {
                            $errors[] = "Password must be at least 6 characters!";
                        }

                        // Validate name - using if...else statement
                        if (empty($name)) {
                            $errors[] = "Full Name is required!";
                        }

                        // Validate date of birth - using if...else statement
                        if (empty($dob)) {
                            $errors[] = "Date of Birth is required!";
                        }

                        // Validate gender - using elseif statement
                        if (empty($gender)) {
                            $errors[] = "Please select your gender!";
                        } elseif ($gender !== 'Male' && $gender !== 'Female' && $gender !== 'Other') {
                            $errors[] = "Please select a valid gender option!";
                        }

                        // Validate phone - using if statement
                        if (empty($phone)) {
                            $errors[] = "Phone Number is required!";
                        }

                        // Display error messages if there are any
                        if (count($errors) > 0) {
                            echo '<div class="alert alert-error">';
                            foreach ($errors as $error) {
                                echo "<p>Warning: $error</p>";
                            }
                            echo '</div>';
                        } else {
                            // If everything is correct, save data into session
                            $_SESSION['email'] = $email;
                            $_SESSION['password'] = $password;
                            $_SESSION['name'] = $name;
                            $_SESSION['dob'] = $dob;
                            $_SESSION['gender'] = $gender;
                            $_SESSION['phone'] = $phone;
                            $_SESSION['loggedin'] = true;

                            // Redirect to dashboard page
                            header("Location: dashboard.php");
                            exit();
                        }
                        
                    }
                    ?>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password">
                    </div>
                </div>

                <!-- Personal Information Section -->
                <div class="form-section">
                    <h3>Personal Information</h3>
                    
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter your full name">
                    </div>
                    
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" id="dob">
                    </div>
                    
                    <div class="form-group">
                        <label>Gender</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="gender" value="Male"> Male
                            </label>
                            <label>
                                <input type="radio" name="gender" value="Female"> Female
                            </label>
                            <label>
                                <input type="radio" name="gender" value="Other"> Other
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" id="phone" placeholder="Enter your phone number">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" name="submit" class="btn-submit">Login and Continue</button>
                
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <p>&copy; <?php echo date("Y"); ?> <span>Kumasi Technical University</span> | Student Portal System</p>
    </footer>

</body>
</html>
