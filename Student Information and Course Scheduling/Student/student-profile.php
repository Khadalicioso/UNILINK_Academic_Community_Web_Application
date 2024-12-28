<?php
session_start();
if (isset($_SESSION['student_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Student') {
        include "../DB_connection.php";
        include "../admin/data/student.php";
        include "../admin/data/res_std_course.php";
        include "data/result.php";

        if (isset($_SESSION['student_id'])) {
            $student_id = $_SESSION['student_id'];
            $student = getStudentById($student_id, $conn);
?>
            <?php include "inc/header.php"; ?>
            <style>
                :root {
                    --primary-color: #1B0E60;
                    --accent-color: #FF8C4C;
                }

                .info-section {
                    background: white;
                    border-radius: 10px;
                    padding: 20px;
                    margin-bottom: 20px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }

                .section-title {
                    color: var(--primary-color);
                    font-size: 1.2rem;
                    font-weight: 600;
                    margin-bottom: 15px;
                    padding-bottom: 10px;
                    border-bottom: 2px solid var(--accent-color);
                }

                .info-item {
                    margin-bottom: 15px;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;
                    gap: 10px;
                }

                .info-label {
                    font-weight: 500;
                    color: #666;
                    min-width: 150px;
                }

                .info-value {
                    flex: 1;
                    color: #333;
                }

                .highlight {
                    color: var(--accent-color);
                    font-weight: 600;
                }

                .edit-btn {
                    background-color: var(--accent-color);
                    color: white;
                    border: none;
                    padding: 8px 16px;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                }

                .edit-btn:hover {
                    background-color: #ff7a33;
                }

                .form-control {
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    padding: 8px;
                    width: 100%;
                }

                .form-control:focus {
                    border-color: var(--primary-color);
                    box-shadow: 0 0 0 0.2rem rgba(27, 14, 96, 0.15);
                }

                .alert {
                    border-radius: 5px;
                    margin-bottom: 20px;
                }
            </style>

            <body>
                <?php
                include "inc/navbar.php";
                if ($student != 0) {
                ?>
                    <div class="container mt-5">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $_GET['error'] ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_GET['success'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?= $_GET['success'] ?>
                            </div>
                        <?php } ?>

                        <form action="req/update-profile.php" method="post">
                            <!-- Personal Information -->
                            <div class="info-section">
                                <div class="section-title">Personal Information</div>
                                <div class="info-item">
                                    <span class="info-label">LRN</span>
                                    <span class="info-value"><?= htmlspecialchars($student['lrn']) ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Full Name</span>
                                    <span class="info-value"><?= htmlspecialchars($student['fname'] . ' ' . $student['lname']) ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Email</span>
                                    <input type="email" class="form-control" name="email_address"
                                        value="<?= htmlspecialchars($student['email_address']) ?>" required>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Address</span>
                                    <input type="text" class="form-control" name="address"
                                        value="<?= htmlspecialchars($student['address']) ?>" required>
                                </div>
                            </div>

                            <!-- Academic Information -->
                            <div class="info-section">
                                <div class="section-title">Academic Information</div>
                                <div class="info-item">
                                    <span class="info-label">Strand</span>
                                    <span class="info-value"><?= htmlspecialchars($student['department']) ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Year</span>
                                    <span class="info-value"><?= htmlspecialchars($student['year']) ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Semester</span>
                                    <span class="info-value"><?= htmlspecialchars($student['semester']) ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Section</span>
                                    <span class="info-value"><?= htmlspecialchars($student['section']) ?></span>
                                </div>
                            </div>

                            <!-- Guardian Information -->
                            <div class="info-section">
                                <div class="section-title">Guardian's Information</div>
                                <div class="info-item">
                                    <span class="info-label">Guardian Name</span>
                                    <input type="text" class="form-control" name="parent_fname"
                                        value="<?= htmlspecialchars($student['parent_fname']) ?>" required>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Guardian Phone</span>
                                    <input type="text" class="form-control" name="parent_phone_number"
                                        value="<?= htmlspecialchars($student['parent_phone_number']) ?>" required>
                                </div>
                            </div>

                            <div class="text-center mb-4">
                                <button type="submit" class="edit-btn">
                                    <i class="fas fa-save me-2"></i>Save Changes
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4 mb-5">
                            <a href="index.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                            </a>
                        </div>
                    </div>
                <?php
                } else {
                    header("Location: student.php");
                    exit;
                }
                ?>

                <script src="../js/bootstrap.bundle.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $("#navLinks li:nth-child(3) a").addClass('active');
                    });
                </script>
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