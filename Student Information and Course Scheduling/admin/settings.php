<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/setting.php";
        $setting = getSetting($conn);
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>System Settings</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
            <?php include "req/header.php"; ?>
            <style>
                body {
                    background-color: #f5f6fa;
                }

                .settings-container {
                    background: white;
                    border-radius: 16px;
                    box-shadow: 0 8px 24px rgba(27, 14, 96, 0.05);
                    padding: 2rem;
                    margin-top: 2rem;
                }

                .settings-header {
                    background: linear-gradient(135deg, #1B0E60 0%, #2a1875 100%);
                    color: white;
                    padding: 1.5rem;
                    border-radius: 12px;
                    margin-bottom: 2rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .settings-title {
                    margin: 0;
                    font-size: 1.5rem;
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
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

                .form-select {
                    border: 2px solid rgba(27, 14, 96, 0.1);
                    border-radius: 8px;
                    padding: 0.75rem 1rem;
                    transition: all 0.3s ease;
                }

                .form-select:focus {
                    border-color: #1B0E60;
                    box-shadow: 0 0 0 0.2rem rgba(27, 14, 96, 0.1);
                }

                .btn-submit {
                    background: #FF8C4C;
                    color: white;
                    border: none;
                    padding: 0.75rem 2rem;
                    border-radius: 8px;
                    font-weight: 500;
                    display: inline-flex;
                    align-items: center;
                    gap: 0.5rem;
                    transition: all 0.3s ease;
                }

                .btn-submit:hover {
                    background: #ff7a33;
                    transform: translateY(-2px);
                }

                .alert {
                    border: none;
                    border-radius: 12px;
                    padding: 1rem 1.5rem;
                    margin-bottom: 1.5rem;
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
                <div class="settings-container">
                    <div class="settings-header">
                        <h4 class="settings-title">
                            <i class="fas fa-cog"></i>
                            System Settings
                        </h4>
                    </div>

                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?= $_GET['error'] ?>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['success'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <?= $_GET['success'] ?>
                        </div>
                    <?php } ?>

                    <form method="post" action="req/setting-edit.php">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">School Name</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $setting['school_name'] ?>"
                                    name="school_name"
                                    placeholder="Enter school name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Slogan</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $setting['slogan'] ?>"
                                    name="slogan"
                                    placeholder="Enter school slogan">
                            </div>
                        </div>

                        <textarea type="hidden"
                            class="form-control"
                            name="about"
                            rows="4"
                            style="display:none;"><?= $setting['about'] ?></textarea>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Current Year</label>
                                <select class="form-select" name="year">
                                    <?php
                                    $current_year = $setting['current_year'];
                                    for ($int = 2024; $int <= 2028; $int++) {
                                        $selected = ($int == $current_year) ? 'selected' : '';
                                        echo "<option value='$int' $selected>$int</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Current Semester</label>
                                <select class="form-select" name="semester">
                                    <option value="1st Quarter" <?= $setting['current_semester'] == '1st Quarter' ? 'selected' : '' ?>>1st Quarter</option>
                                    <option value="2nd Quarter" <?= $setting['current_semester'] == '2nd Quarter' ? 'selected' : '' ?>>2nd Quarter</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-save"></i>
                                Update Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(8) a").addClass('active');
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