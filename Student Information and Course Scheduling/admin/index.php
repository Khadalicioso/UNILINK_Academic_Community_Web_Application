<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
?>
        <?php include "req/header.php"; ?>
        <style>
            .dashboard-container {
                padding: 2rem 0;
            }

            .menu-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1.5rem;
                padding: 1rem;
            }

            .menu-item {
                background: white;
                border-radius: 12px;
                padding: 2rem 1.5rem;
                text-align: center;
                text-decoration: none;
                color: #1B0E60;
                transition: all 0.3s ease;
                border: 1px solid rgba(27, 14, 96, 0.1);
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }

            .menu-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 5px 15px rgba(27, 14, 96, 0.1);
                border-color: #1B0E60;
                color: #1B0E60;
            }

            .menu-item i {
                font-size: 2.5rem;
                color: #1B0E60;
                transition: all 0.3s ease;
            }

            .menu-item:hover i {
                color: #FF8C4C;
            }

            .menu-item span {
                font-size: 1.1rem;
                font-weight: 500;
            }

            .sign-out-item {
                background: #FF8C4C;
                color: white;
            }

            .sign-out-item i {
                color: white;
            }

            .sign-out-item:hover {
                background: #ff7a33;
                color: black;
                border-color: #ff7a33;
            }

            .sign-out-item:hover i {
                color: white;
            }

            .welcome-section {
                text-align: center;
                margin-bottom: 2rem;
                color: #1B0E60;
            }

            .welcome-section h1 {
                font-size: 2.5rem;
                font-weight: 600;
                margin-bottom: 1rem;
            }

            .welcome-section p {
                font-size: 1.1rem;
                opacity: 0.8;
            }
        </style>

        <body>
            <?php include "inc/navbar.php"; ?>

            <div class="container dashboard-container">
                <div class="welcome-section">
                    <h1>Welcome to Admin Dashboard</h1>
                    <p>Manage your student information system efficiently</p>
                </div>

                <div class="menu-grid">
                    <a href="student.php" class="menu-item">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Students</span>
                    </a>
                    <a href="schedule.php" class="menu-item">
                        <i class="fas fa-calendar"></i>
                        <span>Schedule</span>
                    </a>
                    <a href="input_grades.php" class="menu-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Input Grades</span>
                    </a>
                    <a href="settings.php" class="menu-item">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(1) a").addClass('active');
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