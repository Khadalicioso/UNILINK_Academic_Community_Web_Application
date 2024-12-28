<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/schedule.php";

        $id = $_GET['id'];
        $schedule = getScheduleById($conn, $id);

        if ($schedule == 0) {
            header("Location: schedule.php");
            exit;
        }
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Schedule</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
            <?php include "inc/header.php"; ?>
            <style>
                body {
                    background-color: #f5f6fa;
                }

                .form-container {
                    background: white;
                    border-radius: 16px;
                    box-shadow: 0 8px 24px rgba(27, 14, 96, 0.05);
                    padding: 2rem;
                    margin-top: 2rem;
                }

                .form-header {
                    background: linear-gradient(135deg, #1B0E60 0%, #2a1875 100%);
                    color: white;
                    padding: 1.5rem;
                    border-radius: 12px;
                    margin-bottom: 2rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .form-title {
                    margin: 0;
                    font-size: 1.5rem;
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                }

                .btn-back {
                    background: rgba(255, 255, 255, 0.1);
                    color: white;
                    border: none;
                    padding: 0.75rem 1.5rem;
                    border-radius: 8px;
                    font-weight: 500;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 0.5rem;
                    transition: all 0.3s ease;
                }

                .btn-back:hover {
                    background: rgba(255, 255, 255, 0.2);
                    color: white;
                    transform: translateY(-2px);
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
                <div class="form-container">
                    <div class="form-header">
                        <h4 class="form-title">
                            <i class="fas fa-calendar-edit"></i>
                            Edit Schedule
                        </h4>
                        <a href="schedule.php" class="btn-back">
                            <i class="fas fa-arrow-left"></i>
                            Go Back
                        </a>
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

                    <form method="post" action="req/schedule-edit.php">
                        <input type="text"
                            class="form-control"
                            value="<?= $schedule['id'] ?>"
                            name="id"
                            hidden>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Subject Code</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $schedule['subject_code'] ?>"
                                    name="subject_code"
                                    placeholder="Enter subject code">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Subject Description</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $schedule['subject_description'] ?>"
                                    name="subject_description"
                                    placeholder="Enter subject description">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Professor</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $schedule['professor'] ?>"
                                    name="professor"
                                    placeholder="Enter professor name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Schedule</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $schedule['schedule'] ?>"
                                    name="schedule"
                                    placeholder="Enter schedule (e.g., MWF 9:00-10:30 AM)">
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-save"></i>
                                Update Schedule
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