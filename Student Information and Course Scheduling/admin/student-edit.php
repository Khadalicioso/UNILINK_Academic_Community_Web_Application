<?php
session_start();
if (
    isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])     &&
    isset($_GET['student_id'])
) {

    if ($_SESSION['role'] == 'Admin') {

        include "../DB_connection.php";
        include "data/student.php";



        $student_id = $_GET['student_id'];
        $student = getStudentById($student_id, $conn);

        if ($student == 0) {
            header("Location: student.php");
            exit;
        }


?>
        <style>
            /* Modern styling */
            .container {
                max-width: 800px;
                margin: 0 auto;
                padding: 2rem;
            }

            .page-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 2rem;
            }

            .btn-back {
                background: #1B0E60;
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 6px;
                text-decoration: none;
                transition: all 0.3s;
                border: none;
            }

            .btn-back:hover {
                background: #150b4d;
                color: white;
                transform: translateY(-1px);
            }

            .form-container {
                background: white;
                border-radius: 10px;
                box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
                padding: 2rem;
                margin-bottom: 2rem;
            }

            .form-title {
                color: #1B0E60;
                margin-bottom: 1.5rem;
                font-size: 1.5rem;
                font-weight: 600;
            }

            .form-control {
                border: 1px solid #e0e0e0;
                border-radius: 6px;
                padding: 0.75rem;
                transition: all 0.3s;
            }

            .form-control:focus {
                border-color: #1B0E60;
                box-shadow: 0 0 0 3px rgba(27, 14, 96, 0.1);
            }

            .form-label {
                color: #444;
                font-weight: 500;
                margin-bottom: 0.5rem;
            }

            .btn-primary {
                background: #FF8C4C;
                border: none;
                padding: 0.75rem 1.5rem;
                border-radius: 6px;
                font-weight: 500;
                transition: all 0.3s;
            }

            .btn-primary:hover {
                background: #ff7a33;
                transform: translateY(-1px);
            }

            .btn-secondary {
                background: #1B0E60;
                border: none;
                color: white;
            }

            .btn-secondary:hover {
                background: #150b4d;
            }

            .alert {
                border-radius: 6px;
                padding: 1rem;
                margin-bottom: 1.5rem;
                border: none;
            }

            .alert-success {
                background: #e8f5e9;
                color: #2e7d32;
            }

            .alert-danger {
                background: #ffebee;
                color: #c62828;
            }

            .form-section {
                padding-bottom: 1.5rem;
                margin-bottom: 1.5rem;
                border-bottom: 1px solid #eee;
            }

            .radio-group {
                display: flex;
                gap: 2rem;
                margin-top: 0.5rem;
            }

            .radio-group label {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                cursor: pointer;
            }

            .password-group {
                display: flex;
                gap: 1rem;
            }
        </style>

        <body>
            <?php
            include "req/header.php";
            include "inc/navbar.php";
            ?>
            <div class="container">
                <div class="page-header">
                    <h2 class="form-title">Edit Student Information</h2>
                    <a href="student.php" class="btn-back">
                        <i class="fa fa-arrow-left me-2"></i>Back to List
                    </a>
                </div>

                <!-- Personal Information Form -->
                <div class="form-container">
                    <form method="post" action="req/student-edit.php">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger"><?= $_GET['error'] ?></div>
                        <?php } ?>
                        <?php if (isset($_GET['success'])) { ?>
                            <div class="alert alert-success"><?= $_GET['success'] ?></div>
                        <?php } ?>

                        <!-- Personal Details Section -->
                        <div class="form-section">
                            <h4 class="mb-4">Personal Details</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" value="<?= $student['fname'] ?>" name="fname">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" value="<?= $student['lname'] ?>" name="lname">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" value="<?= $student['address'] ?>" name="address">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" value="<?= $student['email_address'] ?>" name="email_address">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" value="<?= $student['date_of_birth'] ?>" name="date_of_birth">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <div class="radio-group">
                                    <label>
                                        <input type="radio" value="Male" <?php if ($student['gender'] == 'Male') echo 'checked'; ?> name="gender">
                                        Male
                                    </label>
                                    <label>
                                        <input type="radio" value="Female" <?php if ($student['gender'] == 'Female') echo 'checked'; ?> name="gender">
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Information Section -->
                        <div class="form-section">
                            <h4 class="mb-4">Academic Information</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">LRN</label>
                                    <input type="text"
                                        class="form-control"
                                        name="lrn"
                                        pattern="[0-9]{12}"
                                        title="LRN must be exactly 12 digits"
                                        value="<?= htmlspecialchars($student['lrn'] ?? str_pad($student['student_id'], 12, '0', STR_PAD_LEFT)) ?>"
                                        required>
                                    <small class="form-text text-muted">Enter 12-digit Learner Reference Number</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" value="<?= $student['username'] ?>" name="username">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Strand</label>
                                    <select class="form-control" name="department">
                                        <option <?php if ($student['department'] == "ICT") echo "selected"; ?>>ICT</option>
                                        <option <?php if ($student['department'] == "ABM") echo "selected"; ?>>ABM</option>
                                        <option <?php if ($student['department'] == "STEM") echo "selected"; ?>>STEM</option>
                                        <option <?php if ($student['department'] == "HUMSS") echo "selected"; ?>>HUMSS</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Semester</label>
                                    <select class="form-control" name="semester">
                                        <option <?php if ($student['semester'] == "1st Quarter") echo "selected"; ?>>1st Quarter</option>
                                        <option <?php if ($student['semester'] == "2nd Quarter") echo "selected"; ?>>2nd Quarter</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Section</label>
                                    <select class="form-control" name="section">
                                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                                            <option <?php if ($student['section'] == $i) echo "selected"; ?>><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Guardian Information Section -->
                        <div class="form-section">
                            <h4 class="mb-4">Guardian Information</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Guardian first name</label>
                                    <input type="text" class="form-control" value="<?= $student['parent_fname'] ?>" name="parent_fname">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Guardian last name</label>
                                    <input type="text" class="form-control" value="<?= $student['parent_lname'] ?>" name="parent_lname">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Guardian phone number</label>
                                <input type="text" class="form-control" value="<?= $student['parent_phone_number'] ?>" name="parent_phone_number">
                            </div>
                        </div>

                        <input type="hidden" value="<?= $student['student_id'] ?>" name="student_id">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Information
                        </button>
                    </form>
                </div>

                <!-- Password Change Form -->
                <div class="form-container">
                    <form method="post" action="req/student-change.php" id="change_password">
                        <h4 class="form-title">Change Password</h4>
                        <?php if (isset($_GET['perror'])) { ?>
                            <div class="alert alert-danger"><?= $_GET['perror'] ?></div>
                        <?php } ?>
                        <?php if (isset($_GET['psuccess'])) { ?>
                            <div class="alert alert-success"><?= $_GET['psuccess'] ?></div>
                        <?php } ?>

                        <div class="mb-3">
                            <label class="form-label">Admin password</label>
                            <input type="password" class="form-control" name="admin_pass">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New password</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="new_pass" id="passInput">
                                <button class="btn btn-secondary" id="gBtn">
                                    <i class="fas fa-key me-2"></i>Generate
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm new password</label>
                            <input type="text" class="form-control" name="c_new_pass" id="passInput2">
                        </div>

                        <input type="hidden" value="<?= $student['student_id'] ?>" name="student_id">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key me-2"></i>Change Password
                        </button>
                    </form>
                </div>
            </div>

            <script src="../js/bootstrap.bundle.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(3) a").addClass('active');
                });

                function makePass(length) {
                    var result = '';
                    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    var charactersLength = characters.length;
                    for (var i = 0; i < length; i++) {
                        result += characters.charAt(Math.floor(Math.random() *
                            charactersLength));

                    }
                    var passInput = document.getElementById('passInput');
                    var passInput2 = document.getElementById('passInput2');
                    passInput.value = result;
                    passInput2.value = result;
                }

                var gBtn = document.getElementById('gBtn');
                gBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    makePass(8);
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
    header("Location: student.php");
    exit;
}

?>