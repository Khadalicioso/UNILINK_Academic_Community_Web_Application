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
            <title>Schedule Management</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
            <?php include "inc/header.php"; ?>
            <style>
                .schedule-container {
                    background: white;
                    border-radius: 8px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
                    margin-top: 2rem;
                }

                .schedule-header {
                    background: #f8f9fa;
                    padding: 1.25rem;
                    border-bottom: 1px solid #e0e0e0;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .schedule-title {
                    font-size: 1.25rem;
                    font-weight: 600;
                    color: #1B0E60;
                    margin: 0;
                }

                .btn-add-schedule {
                    background: #1B0E60;
                    color: white;
                    padding: 0.625rem 1.25rem;
                    border-radius: 4px;
                    font-size: 0.875rem;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 0.5rem;
                    transition: all 0.2s ease;
                }

                .btn-add-schedule:hover {
                    background: #2a1875;
                    color: white;
                    transform: translateY(-1px);
                }

                .schedule-table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .schedule-table th {
                    background: #f8f9fa;
                    font-weight: 600;
                    color: #495057;
                    padding: 0.75rem 1rem;
                    text-align: left;
                    border: 1px solid #e0e0e0;
                    position: sticky;
                    top: 0;
                    z-index: 1;
                    font-size: 0.875rem;
                    background: linear-gradient(180deg, #f8f9fa 0%, #e9ecef 100%);
                    border-bottom: 2px solid #dee2e6;
                }

                .schedule-table td {
                    padding: 0.75rem 1rem;
                    border: 1px solid #e0e0e0;
                    color: #212529;
                    font-size: 0.875rem;
                    background: white;
                }

                .schedule-table tbody tr:hover {
                    background-color: #f8f9fa;
                }

                .schedule-table tbody tr.selected {
                    background-color: #e8f0fe;
                }

                .action-buttons {
                    display: flex;
                    gap: 0.5rem;
                }

                .btn-action {
                    padding: 0.375rem 0.75rem;
                    border-radius: 4px;
                    font-size: 0.875rem;
                    text-decoration: none;
                    transition: all 0.2s ease;
                    display: inline-flex;
                    align-items: center;
                    gap: 0.375rem;
                    border: none;
                }

                .btn-edit {
                    background: #FF8C4C;
                    color: white;
                }

                .btn-delete {
                    background: #dc3545;
                    color: white;
                }

                .btn-action:hover {
                    transform: translateY(-1px);
                    color: white;
                }

                .btn-edit:hover {
                    background: #ff7a33;
                }

                .btn-delete:hover {
                    background: #c82333;
                }

                .empty-state {
                    padding: 3rem;
                    text-align: center;
                    color: #6c757d;
                }

                .empty-state i {
                    font-size: 2.5rem;
                    margin-bottom: 1rem;
                    color: #adb5bd;
                }

                .empty-state h5 {
                    font-weight: 500;
                    margin-bottom: 0.5rem;
                }

                .table-wrapper {
                    overflow-x: auto;
                    border-radius: 8px;
                    border: 1px solid #e0e0e0;
                }

                /* Excel-like cell selection effect */
                .schedule-table td.selected {
                    outline: 2px solid #1a73e8;
                    outline-offset: -2px;
                    position: relative;
                }

                /* Zebra striping for better readability */
                .schedule-table tbody tr:nth-child(even) {
                    background-color: #fbfbfb;
                }
            </style>
        </head>

        <body>
            <?php include "inc/navbar.php"; ?>
            <div class="container mt-5">
                <div class="schedule-container">
                    <div class="schedule-header">
                        <h3 class="schedule-title">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Schedule Management
                        </h3>
                        <div class="d-flex gap-2">
                            <select class="form-select" id="strandFilter" style="width: 300px;">
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
                            <a href="add_schedule.php" class="btn btn-add-schedule">
                                <i class="fas fa-plus"></i> Add Schedule
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table schedule-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Strand</th>
                                    <th>Subject Code</th>
                                    <th>Subject Description</th>
                                    <th>Professor</th>
                                    <th>Schedule</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $sql = "SELECT s.*, st.strand_name 
                               FROM schedule s 
                               LEFT JOIN strands st ON s.strand_id = st.strand_id 
                               ORDER BY st.strand_name, s.subject_code";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $schedules = $stmt->fetchAll();

                                if ($schedules) {
                                    foreach ($schedules as $schedule) { ?>
                                        <tr class="schedule-row" data-strand="<?= $schedule['strand_id'] ?>">
                                            <td><?= $i ?></td>
                                            <td><?= htmlspecialchars($schedule['strand_name'] ?? 'All Strands') ?></td>
                                            <td><?php echo htmlspecialchars($schedule['subject_code']); ?></td>
                                            <td><?php echo htmlspecialchars($schedule['subject_description']); ?></td>
                                            <td><?php echo htmlspecialchars($schedule['professor']); ?></td>
                                            <td><?php echo htmlspecialchars($schedule['schedule']); ?></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="schedule-edit.php?id=<?= $schedule['id'] ?>" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="schedule-delete.php?id=<?= $schedule['id'] ?>" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No schedules found</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script>
                document.getElementById('strandFilter').addEventListener('change', function() {
                    const selectedStrand = this.value;
                    const rows = document.querySelectorAll('.schedule-row');

                    rows.forEach(row => {
                        if (!selectedStrand || row.dataset.strand === selectedStrand) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            </script>
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