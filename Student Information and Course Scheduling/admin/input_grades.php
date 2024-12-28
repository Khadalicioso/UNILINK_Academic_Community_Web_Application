<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/student.php";
        include "../Student/data/quarterly_grades.php";

        if (isset($_POST['submit'])) {
            $student_id = $_POST['student_id'];
            $course_name = $_POST['course_name'];
            $first_quarter = $_POST['first_quarter'];
            $second_quarter = $_POST['second_quarter'];
            $overall = ($first_quarter + $second_quarter) / 2;
            $remarks = $_POST['remarks'];
            $academic_year = $_POST['academic_year'];

            if (empty($student_id) || empty($course_name) || empty($first_quarter) || empty($second_quarter)) {
                $error = "All fields are required";
            } else {
                if (addQuarterlyGrade($conn, $student_id, $course_name, $first_quarter, $second_quarter, $overall, $remarks, $academic_year)) {
                    $success = "Grade added/updated successfully!";
                } else {
                    $error = "Error adding/updating grade";
                }
            }
        }

        // Get all students for dropdown
        $students = getAllStudents($conn);
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Input Quarterly Grades</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
            <?php include "inc/header.php"; ?>
            <style>
                body {
                    background-color: #f5f6fa;
                }

                .grade-card {
                    background: white;
                    border-radius: 16px;
                    box-shadow: 0 8px 24px rgba(27, 14, 96, 0.05);
                    padding: 2rem;
                    margin-top: 2rem;
                }

                .grade-header {
                    background: linear-gradient(135deg, #1B0E60 0%, #2a1875 100%);
                    color: white;
                    padding: 1.5rem;
                    border-radius: 12px;
                    margin-bottom: 2rem;
                    text-align: center;
                }

                .form-label {
                    color: #1B0E60;
                    font-weight: 600;
                    margin-bottom: 0.5rem;
                }

                .form-control {
                    border: 2px solid rgba(27, 14, 96, 0.1);
                    border-radius: 8px;
                    padding: 0.75rem 1rem;
                    transition: all 0.3s ease;
                }

                .form-control:focus {
                    border-color: #1B0E60;
                    box-shadow: 0 0 0 0.2rem rgba(27, 14, 96, 0.1);
                }

                .btn-primary {
                    background: #1B0E60;
                    border: none;
                    padding: 0.75rem 2rem;
                    border-radius: 8px;
                    font-weight: 500;
                    transition: all 0.3s ease;
                }

                .btn-primary:hover {
                    background: #2a1875;
                    transform: translateY(-2px);
                }

                .btn-secondary {
                    background: #FF8C4C;
                    border: none;
                    padding: 0.75rem 2rem;
                    border-radius: 8px;
                    font-weight: 500;
                    transition: all 0.3s ease;
                }

                .btn-secondary:hover {
                    background: #ff7a33;
                    transform: translateY(-2px);
                }

                .alert {
                    border: none;
                    border-radius: 12px;
                    padding: 1rem 1.5rem;
                }

                .alert-success {
                    background-color: #e6fff0;
                    color: #00602b;
                }

                .alert-danger {
                    background-color: #ffe6e6;
                    color: #600000;
                }
            </style>
        </head>

        <body>
            <?php include "inc/navbar.php"; ?>

            <div class="container">
                <div class="grade-card">
                    <div class="grade-header">
                        <h4 class="mb-0">
                            <i class="fas fa-graduation-cap me-2"></i>
                            Input Student Quarterly Grades
                        </h4>
                    </div>

                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?= $error ?>
                        </div>
                    <?php } ?>
                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <?= $success ?>
                        </div>
                    <?php } ?>

                    <form method="post" action="">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Select Student</label>
                                <select class="form-control" name="student_id" required>
                                    <option value="">Select a student...</option>
                                    <?php if ($students != 0) {
                                        foreach ($students as $student) { ?>
                                            <option value="<?= $student['student_id'] ?>">
                                                <?= $student['fname'] ?> <?= $student['lname'] ?> (<?= $student['student_id'] ?>)
                                            </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Course Name</label>
                                <input type="text" class="form-control" name="course_name" placeholder="Enter course name" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Quarter Grade</label>
                                <input type="number" step="0.01" min="0" max="100"
                                    class="form-control" name="first_quarter"
                                    placeholder="Enter grade (0-100)" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Second Quarter Grade</label>
                                <input type="number" step="0.01" min="0" max="100"
                                    class="form-control" name="second_quarter"
                                    placeholder="Enter grade (0-100)" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Remarks</label>
                            <textarea class="form-control" name="remarks" rows="2"
                                placeholder="Enter any additional remarks"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Academic Year</label>
                            <input type="text" class="form-control" name="academic_year"
                                value="<?= date('Y') . '-' . (date('Y') + 1) ?>" required>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" name="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Submit Grade
                            </button>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Go Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
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