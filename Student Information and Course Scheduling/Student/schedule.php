<?php
session_start();
if (
    isset($_SESSION['student_id']) &&
    isset($_SESSION['role'])
) {

    if ($_SESSION['role'] == 'Student') {
        include "../DB_connection.php";
        include "data/student.php";
        include "data/schedule.php";


        $student_id = $_SESSION['student_id'];
        $schedule = getStudentSchedule($conn);


?>
        <?php
        include "inc/header.php";
        ?>
        <style>
            .schedule-container {
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0,0,0,0.1);
                padding: 2rem;
                margin-top: 2rem;
            }

            .page-title {
                color: #1B0E60;
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 1.5rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .schedule-table {
                border-radius: 8px;
                overflow: hidden;
                border: none;
            }

            .schedule-table thead th {
                background-color: #1B0E60 !important;
                color: white;
                font-weight: 500;
                text-transform: uppercase;
                font-size: 0.9rem;
                padding: 1rem;
                border: none;
            }

            .schedule-table tbody td {
                padding: 1rem;
                vertical-align: middle;
                border-color: #e9ecef;
                font-size: 0.95rem;
            }

            .schedule-table tbody tr:hover {
                background-color: rgba(27, 14, 96, 0.05);
            }

            .back-btn {
                background-color: #FF8C4C !important;
                border: none;
                padding: 0.5rem 1.5rem;
                border-radius: 6px;
                transition: all 0.3s ease;
                font-weight: 500;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                margin-top: 1.5rem;
            }

            .back-btn:hover {
                background-color: #ff7a33 !important;
                transform: translateY(-1px);
            }

            .alert {
                border-radius: 8px;
                border: none;
                padding: 1rem;
                margin-bottom: 1.5rem;
            }

            .empty-message {
                text-align: center;
                padding: 2rem;
                color: #6c757d;
                font-style: italic;
            }
        </style>

        <body>
            <?php
            include "inc/navbar.php"; ?>
            <div class="container">
                <div class="schedule-container">
                    <h2 class="page-title">
                        <i class="fas fa-calendar-alt"></i>
                        Class Schedule
                    </h2>

                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?= $_GET['error'] ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <?= $_GET['success'] ?>
                        </div>
                    <?php } ?>

                    <div class="table-responsive">
                        <table class="table schedule-table">
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject Description</th>
                                    <th>Professor</th>
                                    <th>Schedule</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($schedule && count($schedule) > 0) {
                                    foreach ($schedule as $s) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($s['subject_code']); ?></td>
                                            <td><?php echo htmlspecialchars($s['subject_description']); ?></td>
                                            <td><?php echo htmlspecialchars($s['professor']); ?></td>
                                            <td><?php echo htmlspecialchars($s['schedule']); ?></td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="4" class="empty-message">
                                            <i class="fas fa-calendar-times me-2"></i>
                                            No schedule information available.
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <a href="index.php" class="btn back-btn text-white">
                            <i class="fas fa-arrow-left"></i>
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(5) a").addClass('active');
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