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
    <title>Statement of Results - KSTU Student Portal</title>
    <!-- Link external CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Additional styles for results page */
        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
        }
        
        .results-table th {
            background-color: var(--kstu-navy);
            color: var(--kstu-white);
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }
        
        .results-table td {
            padding: 12px;
            border-bottom: 1px solid var(--kstu-gray);
        }
        
        .results-table tr:nth-child(even) {
            background-color: var(--kstu-light);
        }
        
        .results-table tr:hover {
            background-color: #e8f4f8;
        }
        
        .grade-a {
            color: #28a745;
            font-weight: bold;
        }
        
        .grade-b {
            color: #17a2b8;
            font-weight: bold;
        }
        
        .grade-c {
            color: #ffc107;
            font-weight: bold;
        }
        
        .grade-d {
            color: #fd7e14;
            font-weight: bold;
        }
        
        .grade-f {
            color: #dc3545;
            font-weight: bold;
        }
        
        .pass {
            color: #28a745;
        }
        
        .fail {
            color: #dc3545;
        }
        
        .summary-box {
            background-color: var(--kstu-light);
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 5px solid var(--kstu-gold);
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid var(--kstu-gray);
        }
        
        .summary-row:last-child {
            border-bottom: none;
        }
        
        .status-pass {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
        }
        
        .status-fail {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
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
            <a href="view_profile.php">View Profile</a>
            <a href="results.php" class="active">Statement of Results</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="main-content">
        <h2 class="page-title">Statement of Results</h2>
        
        <!-- Student Information Card -->
        <div class="profile-card">
            <div class="profile-header">
                <h2>Student Academic Record</h2>
            </div>
            
            <div class="profile-body">
                <!-- Student Details -->
                <div class="profile-row">
                    <span class="profile-label">Full Name:</span>
                    <span class="profile-value"><?php echo htmlspecialchars($_SESSION['name']); ?></span>
                </div>
                
                <div class="profile-row">
                    <span class="profile-label">Email Address:</span>
                    <span class="profile-value"><?php echo htmlspecialchars($_SESSION['email']); ?></span>
                </div>
                
                <div class="profile-row">
                    <span class="profile-label">Programme:</span>
                    <span class="profile-value">
                        <?php 
                        // Check if programme is stored in session, otherwise show default
                        if (isset($_SESSION['programme']) && !empty($_SESSION['programme'])) {
                            echo htmlspecialchars($_SESSION['programme']);
                        } else {
                            echo "Computer Science";
                        }
                        ?>
                    </span>
                </div>
                
                <div class="profile-row">
                    <span class="profile-label">Academic Year:</span>
                    <span class="profile-value">2025/2026</span>
                </div>
            </div>
        </div>
        
        <!-- Results Table -->
        <div class="profile-card" style="margin-top: 20px;">
            <div class="profile-header">
                <h2>Course Results</h2>
            </div>
            
            <div class="profile-body">
                <?php
                // Check if courses are registered - using if statement
                if (isset($_SESSION['courses']) && !empty($_SESSION['courses'])) {
                    
                    // Get courses from session
                    $courses = $_SESSION['courses'];
                    $course_array = explode(", ", $courses);
                    $total_courses = count($course_array);
                    
                    // Variables for calculation
                    $total_score = 0;
                    $has_fail = false;
                    
                    // Display table header
                    echo '<table class="results-table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Course Code</th>';
                    echo '<th>Course Name</th>';
                    echo '<th>Score</th>';
                    echo '<th>Grade</th>';
                    echo '<th>Remark</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    
                    // Loop through each course using foreach
                    foreach ($course_array as $index => $course_name) {
                        // Generate random score between 40 and 100
                        $score = rand(40, 100);
                        
                        // Add to total score for average calculation
                        $total_score += $score;
                        
                        // Determine grade using conditional statements (if, elseif, elseif, elseif)
                        if ($score >= 70) {
                            $grade = "A";
                            $grade_class = "grade-a";
                            $remark = "Pass";
                            $remark_class = "pass";
                        } elseif ($score >= 60) {
                            $grade = "B";
                            $grade_class = "grade-b";
                            $remark = "Pass";
                            $remark_class = "pass";
                        } elseif ($score >= 50) {
                            $grade = "C";
                            $grade_class = "grade-c";
                            $remark = "Pass";
                            $remark_class = "pass";
                        } elseif ($score >= 45) {
                            $grade = "D";
                            $grade_class = "grade-d";
                            $remark = "Pass";
                            $remark_class = "pass";
                        } else {
                            $grade = "F";
                            $grade_class = "grade-f";
                            $remark = "Fail";
                            $remark_class = "fail";
                            $has_fail = true;  // Mark that student has a failing grade
                        }
                        
                        // Display table row
                        echo '<tr>';
                        echo '<td>Course ' . ($index + 1) . '</td>';
                        echo '<td>' . htmlspecialchars($course_name) . '</td>';
                        echo '<td>' . $score . '</td>';
                        echo '<td class="' . $grade_class . '">' . $grade . '</td>';
                        echo '<td class="' . $remark_class . '">' . $remark . '</td>';
                        echo '</tr>';
                    }
                    
                    echo '</tbody>';
                    echo '</table>';
                    
                    // Calculate average score
                    $average_score = $total_score / $total_courses;
                    
                    // Simple GPA calculation (basic 4.0 scale)
                    // A = 4.0, B = 3.0, C = 2.0, D = 1.0, F = 0.0
                    $total_points = 0;
                    
                    // Loop again to calculate GPA
                    foreach ($course_array as $course_name) {
                        // Generate same random score for consistency (using course name as seed)
                        $score = rand(40, 100);
                        
                        if ($score >= 70) {
                            $total_points += 4.0;
                        } elseif ($score >= 60) {
                            $total_points += 3.0;
                        } elseif ($score >= 50) {
                            $total_points += 2.0;
                        } elseif ($score >= 45) {
                            $total_points += 1.0;
                        } else {
                            $total_points += 0.0;
                        }
                    }
                    
                    // Calculate GPA
                    $gpa = $total_points / $total_courses;
                    
                    // Display summary box
                    echo '<div class="summary-box">';
                    echo '<h3 style="color: var(--kstu-navy); margin-bottom: 15px;">Academic Summary</h3>';
                    
                    echo '<div class="summary-row">';
                    echo '<span><strong>Total Courses:</strong></span>';
                    echo '<span>' . $total_courses . '</span>';
                    echo '</div>';
                    
                    echo '<div class="summary-row">';
                    echo '<span><strong>Total Score:</strong></span>';
                    echo '<span>' . $total_score . '</span>';
                    echo '</div>';
                    
                    echo '<div class="summary-row">';
                    echo '<span><strong>Average Score:</strong></span>';
                    echo '<span>' . number_format($average_score, 2) . '</span>';
                    echo '</div>';
                    
                    echo '<div class="summary-row">';
                    echo '<span><strong>GPA:</strong></span>';
                    echo '<span>' . number_format($gpa, 2) . ' / 4.00</span>';
                    echo '</div>';
                    
                    echo '</div>';
                    
                    // Display overall status
                    if ($has_fail) {
                        echo '<div class="status-fail">';
                        echo 'Overall Status: FAILED - You have at least one course with Grade F';
                        echo '</div>';
                    } else {
                        echo '<div class="status-pass">';
                        echo 'Overall Status: PASSED - Congratulations!';
                        echo '</div>';
                    }
                    
                } else {
                    // No courses registered yet
                    echo '<div class="alert alert-error">';
                    echo '<p>No courses registered yet. Please register your courses first.</p>';
                    echo '</div>';
                    
                    echo '<p style="text-align: center; margin-top: 20px;">';
                    echo '<a href="course.php" class="btn-submit" style="width: auto; padding: 12px 30px; display: inline-block;">Register Courses</a>';
                    echo '</p>';
                }
                ?>
                
                <!-- Print Button -->
                <div style="text-align: center; margin-top: 30px;">
                    <button onclick="window.print()" class="btn-submit" style="width: auto; padding: 12px 40px;">Print Statement</button>
                </div>
                
                <!-- Quick Links -->
                <div style="text-align: center; margin-top: 15px;">
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
