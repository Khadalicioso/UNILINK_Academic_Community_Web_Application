<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        $fname = '';
        $lname = '';
        $uname = '';
        $address = '';
        $email = '';
        $pfn = '';
        $pln = '';
        $ppn = '';
        $dep = '';
        $sem = '';
        $year = '';

        if (isset($_GET['fname'])) $fname = $_GET['fname'];
        if (isset($_GET['lname'])) $lname = $_GET['lname'];
        if (isset($_GET['uname'])) $uname = $_GET['uname'];
        if (isset($_GET['address'])) $address = $_GET['address'];
        if (isset($_GET['email'])) $email = $_GET['email'];
        if (isset($_GET['pfn'])) $pfn = $_GET['pfn'];
        if (isset($_GET['pln'])) $pln = $_GET['pln'];
        if (isset($_GET['ppn'])) $ppn = $_GET['ppn'];
        if (isset($_GET['dep'])) $dep = $_GET['dep'];
        if (isset($_GET['sem'])) $sem = $_GET['sem'];
        if (isset($_GET['year'])) $year = $_GET['year'];
        if (isset($_GET['sec'])) $sec = $_GET['sec'];
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Add New Student</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
            <?php include "inc/header.php"; ?>
            <style>
                body {
                    background-color: #f8f9fa;
                }

                .container {
                    max-width: 800px;
                }

                .form-w {
                    background: white;
                    border-radius: 8px;
                    border: 1px solid #e0e0e0;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                .form-w h3 {
                    color: #1B0E60;
                    font-weight: 600;
                    margin-bottom: 20px;
                }

                .form-label {
                    color: #1B0E60;
                    font-weight: 500;
                }

                .form-control {
                    border: 1px solid #e0e0e0;
                    padding: 10px 15px;
                    border-radius: 6px;
                }

                .form-control:focus {
                    border-color: #1B0E60;
                    box-shadow: 0 0 0 0.2rem rgba(27, 14, 96, 0.15);
                }

                .btn-primary {
                    background-color: #1B0E60;
                    border: none;
                    padding: 10px 24px;
                    font-weight: 500;
                }

                .btn-primary:hover {
                    background-color: #150b4d;
                }

                .btn-dark {
                    background-color: #FF8C4C;
                    border: none;
                    color: white;
                    padding: 8px 20px;
                }

                .btn-dark:hover {
                    background-color: #ff7a33;
                }

                .btn-secondary {
                    background-color: #FF8C4C;
                    border: none;
                }

                .btn-secondary:hover {
                    background-color: #ff7a33;
                }

                .alert {
                    border-radius: 6px;
                    font-weight: 500;
                }

                hr {
                    opacity: 0.1;
                    margin: 25px 0;
                }

                .input-group .btn {
                    padding: 8px 16px;
                }

                select.form-control {
                    cursor: pointer;
                }

                .radio-group {
                    display: flex;
                    gap: 20px;
                    align-items: center;
                }

                .radio-group input[type="radio"] {
                    margin-right: 5px;
                }

                .header {
                    background-color: #1B0E60;
                    color: white;
                    padding: 10px;
                    border-radius: 0 0 10px 10px;
                }

                .header h1 {
                    font-weight: 600;
                }
            </style>
        </head>

        <body>
            <?php include "inc/navbar.php"; ?>
            <div class="container mt-5">
                <a href="student.php" class="btn btn-dark">
                    <i class="fas fa-arrow-left me-2"></i>Back to Students
                </a>

                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user-plus me-2"></i>
                            Add New Student
                        </h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?=$_GET['error']?>
                            </div>
                        <?php } ?>
                        
                        <?php if (isset($_GET['success'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?=$_GET['success']?>
                            </div>
                        <?php } ?>
                        <form method="post" action="req/student-add.php">
                            <div class="mb-3">
                                <label class="form-label">LRN</label>
                                <input type="text"
                                    class="form-control"
                                    name="lrn"
                                    pattern="[0-9]{12}"
                                    title="LRN must be exactly 12 digits"
                                    required>
                                <small class="form-text text-muted">Enter 12-digit Learner Reference Number</small>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text"
                                        class="form-control"
                                        value="<?= $fname ?>"
                                        name="fname"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text"
                                        class="form-control"
                                        value="<?= $lname ?>"
                                        name="lname"
                                        required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $address ?>"
                                    name="address"
                                    required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email address</label>
                                        <input type="text"
                                            class="form-control"
                                            value="<?= $email ?>"
                                            name="email_address"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Date of birth</label>
                                        <input type="date"
                                            class="form-control"
                                            name="date_of_birth"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <div class="radio-group">
                                    <div>
                                        <input type="radio" value="Male" checked name="gender" id="male">
                                        <label for="male">Male</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="Female" name="gender" id="female">
                                        <label for="female">Female</label>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="text-primary mb-3">Login Information</h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text"
                                        class="form-control"
                                        value="<?= $uname ?>"
                                        name="username"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control"
                                            name="pass"
                                            id="passInput"
                                            required>
                                        <button class="btn btn-secondary" id="gBtn">
                                            <i class="fas fa-random me-1"></i>Generate
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="text-primary mb-3">Guardian Information</h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Guardian first name</label>
                                    <input type="text"
                                        class="form-control"
                                        value="<?= $pfn ?>"
                                        name="parent_fname"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Guardian last name</label>
                                    <input type="text"
                                        class="form-control"
                                        value="<?= $pln ?>"
                                        name="parent_lname"
                                        required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Guardian phone number</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $ppn ?>"
                                    name="parent_phone_number"
                                    required>
                            </div>

                            <hr>
                            <h5 class="text-primary mb-3">Academic Information</h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Department</label>
                                    <select class="form-control" name="department">
                                        <option value="ICT">ICT</option>
                                        <option value="ABM">ABM</option>
                                        <option value="STEM">STEM</option>
                                        <option value="HUMSS">HUMSS</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Quarter</label>
                                    <select class="form-control" name="semester">
                                        <option value="1st Quarter">1st Quarter</option>
                                        <option value="2nd Quarter">2nd Quarter</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year</label>
                                    <select class="form-control" name="year">
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Intake</label>
                                    <select class="form-control" name="intake">
                                        <?php for ($int = 1; $int <= 10; $int++) { ?>
                                            <option value="<?= $int ?>"><?= $int ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Section</label>
                                    <select class="form-control" name="section">
                                        <?php for ($int = 1; $int <= 10; $int++) { ?>
                                            <option value="<?= $int ?>"><?= $int ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Register Student
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(3) a").addClass('active');

                    // Password generator
                    function makePass(length) {
                        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                        let result = '';
                        for (let i = 0; i < length; i++) {
                            result += characters.charAt(Math.floor(Math.random() * characters.length));
                        }
                        $('#passInput').val(result);
                    }

                    $('#gBtn').on('click', function(e) {
                        e.preventDefault();
                        makePass(8);
                    });
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