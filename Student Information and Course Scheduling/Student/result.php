<?php 
session_start();
if (isset($_SESSION['student_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Student') {
     include "../DB_connection.php";
     
     $student_id = $_SESSION['student_id'];
     $academic_year = date("Y")."-".(date("Y")+1);

     // Get quarterly grades
     $sql = "SELECT * FROM quarterly_grades WHERE student_id = ? AND academic_year = ?";
     $stmt = $conn->prepare($sql);
     $stmt->execute([$student_id, $academic_year]);
     $grades = $stmt->fetchAll();
?>
<?php 
    include "inc/header.php";
?>
<style>
    .result-container {
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

    .result-table {
        border-radius: 8px;
        overflow: hidden;
        border: none;
    }

    .result-table thead th {
        background-color: #1B0E60 !important;
        color: white;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.9rem;
        padding: 1rem;
        border: none;
    }

    .result-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-color: #e9ecef;
        font-size: 0.95rem;
    }

    .result-table tbody tr:hover {
        background-color: rgba(27, 14, 96, 0.05);
    }

    .gwa-row {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #1B0E60;
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

    .academic-year {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
</style>

<body>
    <?php 
        include "inc/navbar.php";
    ?>
    <div class="container">
        <div class="result-container">
            <h2 class="page-title">
                <i class="fas fa-chart-line"></i>
                Academic Performance
            </h2>
            <div class="academic-year">
                Academic Year: <?php echo htmlspecialchars($academic_year); ?>
            </div>

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
                <table class="table result-table">
                    <thead>
                        <tr>
                            <th>1st Quarter</th>
                            <th>2nd Quarter</th>
                            <th>Overall</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($grades && count($grades) > 0) {
                            $total_overall = 0;
                            foreach ($grades as $grade) { 
                                $total_overall += $grade['overall'];
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($grade['first_quarter']) ?></td>
                                <td><?= htmlspecialchars($grade['second_quarter']) ?></td>
                                <td><?= htmlspecialchars($grade['overall']) ?></td>
                                <td><?= htmlspecialchars($grade['remarks']) ?></td>
                            </tr>
                        <?php 
                            }
                            $gwa = round($total_overall / count($grades), 2);
                        ?>
                            <tr class="gwa-row">
                                <td colspan="4" class="text-center">
                                    <i class="fas fa-star me-2"></i>
                                    General Weighted Average (GWA): <?php echo $gwa; ?>
                                </td>
                            </tr>
                        <?php
                        } else { ?>
                            <tr>
                                <td colspan="4" class="empty-message">
                                    <i class="fas fa-file-alt me-2"></i>
                                    No grades available for this academic year.
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="text-center">
                    <a href="index.php" class="btn back-btn text-white">
                        <i class="fas fa-arrow-left"></i>
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#navLinks li:nth-child(6) a").addClass('active');
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