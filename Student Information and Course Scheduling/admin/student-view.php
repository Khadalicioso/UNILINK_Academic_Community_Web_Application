<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/student.php";

        if (isset($_GET['student_id'])) {
            $student_id = $_GET['student_id'];
            $student = getStudentById($student_id, $conn);
?>
            <?php include "inc/header.php"; ?>
            <style>
                body {
                    background: #f5f6fa;
                }

                .student-card {
                    background: white;
                    border-radius: 16px;
                    box-shadow: 0 8px 24px rgba(27, 14, 96, 0.05);
                    overflow: hidden;
                    max-width: 700px;
                    margin: 2rem auto;
                    transition: transform 0.2s ease;
                }

                .student-card:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 12px 32px rgba(27, 14, 96, 0.1);
                }

                .student-header {
                    background: linear-gradient(135deg, #1B0E60 0%, #2a1875 100%);
                    color: white;
                    padding: 2.5rem 2rem;
                    text-align: center;
                    position: relative;
                    overflow: hidden;
                }

                .student-header::before {
                    content: '';
                    position: absolute;
                    top: -50%;
                    left: -50%;
                    width: 200%;
                    height: 200%;
                    background: radial-gradient(circle, rgba(255, 140, 76, 0.1) 0%, rgba(255, 140, 76, 0) 70%);
                    animation: pulse 3s ease-in-out infinite;
                }

                @keyframes pulse {
                    0% {
                        transform: scale(1);
                        opacity: 0.5;
                    }

                    50% {
                        transform: scale(1.2);
                        opacity: 0.3;
                    }

                    100% {
                        transform: scale(1);
                        opacity: 0.5;
                    }
                }

                .student-img {
                    width: 140px;
                    height: 140px;
                    border-radius: 70px;
                    border: 4px solid rgba(255, 255, 255, 0.9);
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                    margin-bottom: 1.5rem;
                    transition: transform 0.3s ease;
                }

                .student-img:hover {
                    transform: scale(1.05);
                }

                .student-username {
                    font-size: 1.75rem;
                    font-weight: 600;
                    margin: 0;
                    color: white;
                    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }

                .student-info {
                    padding: 2rem;
                }

                .info-item {
                    padding: 1.25rem;
                    border-bottom: 1px solid rgba(27, 14, 96, 0.08);
                    display: flex;
                    align-items: center;
                    transition: background-color 0.2s ease;
                }

                .info-item:hover {
                    background-color: rgba(27, 14, 96, 0.02);
                }

                .info-item:last-child {
                    border-bottom: none;
                }

                .info-label {
                    font-weight: 600;
                    color: #1B0E60;
                    width: 160px;
                    flex-shrink: 0;
                    font-size: 0.95rem;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }

                .info-value {
                    color: #333;
                    font-size: 1rem;
                    flex-grow: 1;
                }

                .btn-back {
                    background: #FF8C4C;
                    color: white;
                    padding: 0.75rem 1.75rem;
                    border-radius: 8px;
                    text-decoration: none;
                    transition: all 0.3s ease;
                    display: inline-flex;
                    align-items: center;
                    gap: 0.75rem;
                    margin: 1.5rem;
                    font-weight: 500;
                    box-shadow: 0 2px 8px rgba(255, 140, 76, 0.3);
                }

                .btn-back:hover {
                    background: #ff7a33;
                    transform: translateY(-2px);
                    box-shadow: 0 4px 12px rgba(255, 140, 76, 0.4);
                    color: white;
                }

                .container {
                    padding: 1rem;
                }

                .alert {
                    border-radius: 12px;
                    padding: 1.25rem;
                    margin: 1rem 0;
                    border: none;
                    background-color: #e8f4ff;
                    color: #1B0E60;
                    box-shadow: 0 2px 8px rgba(27, 14, 96, 0.05);
                }
            </style>

            <body>
                <?php include "inc/navbar.php"; ?>

                <div class="container">
                    <a href="student.php" class="btn-back">
                        <i class="fa fa-arrow-left"></i> Back to Students
                    </a>

                    <?php if ($student != 0) { ?>
                        <div class="student-card">
                            <div class="student-header">
                                <img src="../img/student-<?= $student['gender'] ?>.png" class="student-img" alt="Student Image">
                                <h5 class="student-username">@<?= $student['username'] ?></h5>
                            </div>
                            <div class="student-info">
                                <?php
                                $fields = [
                                    'student_id' => 'LRN',
                                    'fname' => 'First Name',
                                    'lname' => 'Last Name',
                                    'username' => 'Username',
                                    'address' => 'Address',
                                    'date_of_birth' => 'Date of Birth',
                                    'email_address' => 'Email Address',
                                    'gender' => 'Gender',
                                    'section' => 'Section',
                                    'department' => 'Strand',
                                ];

                                foreach ($fields as $key => $label) {
                                    if (isset($student[$key]) && !empty($student[$key])) {
                                        echo '<div class="info-item">
                                                <div class="info-label">' . $label . '</div>
                                                <div class="info-value">' . htmlspecialchars($student[$key]) . '</div>
                                              </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="alert" role="alert">
                            <i class="fa fa-info-circle"></i> No student found.
                        </div>
                    <?php } ?>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
            </body>

            </html>
<?php
        } else {
            header("Location: student.php");
            exit;
        }
    } else {
        header("Location: ../login.php");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>