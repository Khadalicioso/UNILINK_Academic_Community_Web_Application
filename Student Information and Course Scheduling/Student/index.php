<?php
session_start();
if (
    isset($_SESSION['student_id']) &&
    isset($_SESSION['role'])
) {

    if ($_SESSION['role'] == 'Student') {
        include "../DB_connection.php";
        include "data/student.php";
        include "data/subject.php";
        include "data/result.php";


        $student_id = $_SESSION['student_id'];

        $student = getStudentById($student_id, $conn);
?>

        <?php
        include "inc/header.php";
        ?>
        <style>
            :root {
                --primary-color: #1B0E60;
                --secondary-color: #FF8C4C;
            }
            
            body {
                background-color: #f8f9fa;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
            
            .main-container {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem 0;
            }
            
            .student-profile-card {
                background: #fff;
                border-radius: 15px;
                box-shadow: 0 8px 24px rgba(27, 14, 96, 0.12);
                overflow: hidden;
                transition: transform 0.3s ease;
            }
            
            .student-profile-card:hover {
                transform: translateY(-5px);
            }
            
            .profile-header {
                background: linear-gradient(135deg, #1B0E60 0%, #2D1B8C 100%);
                color: white;
                padding: 2rem 1.5rem;
                text-align: center;
            }
            
            .profile-img {
                width: 120px;
                height: 120px;
                border-radius: 60px;
                border: 4px solid rgba(255, 255, 255, 0.2);
                margin-bottom: 1rem;
            }
            
            .profile-info {
                padding: 1.5rem;
            }
            
            .info-item {
                padding: 0.8rem;
                border-bottom: 1px solid rgba(27, 14, 96, 0.1);
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .info-item:last-child {
                border-bottom: none;
            }
            
            .info-label {
                color: #1B0E60;
                font-weight: 600;
                font-size: 0.9rem;
            }
            
            .dashboard-card {
                background: white;
                border-radius: 15px;
                padding: 2rem;
                height: 100%;
                box-shadow: 0 8px 24px rgba(27, 14, 96, 0.12);
                transition: all 0.3s ease;
                border: 1px solid rgba(27, 14, 96, 0.1);
            }
            
            .dashboard-card:hover {
                transform: translateY(-5px);
                border-color: #FF8C4C;
            }
            
            .card-icon {
                background: linear-gradient(135deg, #FF8C4C 0%, #FFB088 100%);
                width: 60px;
                height: 60px;
                border-radius: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.2rem;
            }
            
            .card-icon i {
                color: white;
                font-size: 1.5rem;
            }
            
            .dashboard-card h5 {
                color: #1B0E60;
                margin-bottom: 0.5rem;
                font-weight: 600;
            }
            
            .dashboard-card p {
                color: #666;
                margin-bottom: 0;
                font-size: 0.9rem;
            }
            
            .action-button {
                background: white;
                color: #1B0E60;
                padding: 1rem;
                border-radius: 12px;
                font-weight: 500;
                box-shadow: 0 4px 12px rgba(27, 14, 96, 0.08);
                transition: all 0.3s ease;
                border: 1px solid rgba(27, 14, 96, 0.1);
            }
            
            .action-button:hover {
                background: #1B0E60;
                color: white;
                transform: translateY(-3px);
            }
            
            .action-button i {
                color: #FF8C4C;
            }
            
            .action-button:hover i {
                color: white;
            }
        </style>

        <body>
            <?php
            include "inc/navbar.php";
            if ($student != 0) {
            ?>
                <div class="main-container">
                    <div class="container">
                        <div class="row justify-content-center">
                            <!-- Student Profile Card -->
                            <div class="col-lg-4">
                                <div class="student-profile-card">
                                    <div class="profile-header">
                                        <img src="../img/student-<?= $student['gender'] ?>.png" class="profile-img" alt="Profile Image">
                                        <h4 class="mb-1">@<?= $student['username'] ?></h4>
                                        <p class="mb-0"><?= $student['fname'] . " " . $student['lname'] ?></p>
                                    </div>
                                    <div class="profile-info">
                                    <div class="info-item">
                                            <span class="info-label">LRN</span>
                                            <span><?= $student['lrn'] ?></span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Strand</span>
                                            <span><?= $student['department'] ?></span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Section</span>
                                            <span><?= $student['section'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dashboard Cards -->
                            <div class="col-lg-8">
                                <div class="row g-4 h-100">
                                    <div class="col-md-6 mb-4">
                                        <a href="student-profile.php" class="text-decoration-none">
                                            <div class="dashboard-card">
                                                <div class="card-icon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <h5>Profile</h5>
                                                <p>View and manage your profile</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <a href="schedule.php" class="text-decoration-none">
                                            <div class="dashboard-card">
                                                <div class="card-icon">
                                                    <i class="fa-solid fa-calendar"></i>
                                                </div>
                                                <h5>Schedule</h5>
                                                <p>View your class timetable</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <a href="result.php" class="text-decoration-none">
                                            <div class="dashboard-card">
                                                <div class="card-icon">
                                                    <i class="fa-solid fa-square-poll-vertical"></i>
                                                </div>
                                                <h5>Result</h5>
                                                <p>Check your academic results</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                header("Location: ../login.php");
                exit;
            }
            ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(1) a").addClass('active');
                });
            </script>
        </body>

        </html>
<?php

    } else {
        header("Location: ../login.php");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}

?>