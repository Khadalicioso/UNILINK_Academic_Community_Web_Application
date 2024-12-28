<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/schedule.php";
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Add New Schedule</title>
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

            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-plus me-2"></i>
                            Add New Schedule
                        </h3>
                    </div>
                    <div class="card-body">
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
                        <form method="post" action="req/schedule-add.php">
                            <div class="mb-3">
                                <label class="form-label">Strand</label>
                                <select class="form-select" name="strand_id">
                                    <option value="">All Strands</option>
                                    <?php
                                    $sql = "SELECT * FROM strands ORDER BY strand_name";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $strands = $stmt->fetchAll();
                                    foreach ($strands as $strand) {
                                        echo "<option value=\"" . $strand['strand_id'] . "\">" . $strand['strand_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subject Code</label>
                                <input type="text" class="form-control" name="subject_code" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subject Description</label>
                                <input type="text" class="form-control" name="subject_description" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Professor</label>
                                <input type="text" class="form-control" name="professor" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Schedule</label>
                                <input type="text" class="form-control" name="schedule" required>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="schedule.php" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Add Schedule</button>
                            </div>
                        </form>
                    </div>
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