<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<style>
    .navbar {
        background-color: #1B0E60 !important;
        padding: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        padding: 0;
        margin-right: 2rem;
    }

    .navbar-brand img {
        width: 40px;
        height: auto;
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover img {
        transform: scale(1.05);
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        padding: 0.5rem 1rem !important;
        margin: 0 0.25rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .nav-link i {
        font-size: 1.1rem;
    }

    .nav-link:hover {
        color: #FF8C4C !important;
        background: rgba(255, 255, 255, 0.1);
    }

    .nav-link.active {
        color: #FF8C4C !important;
        background: rgba(255, 255, 255, 0.1);
    }

    .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.1);
        padding: 0.5rem;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .sign-out-btn {
        background: #FF8C4C;
        color: white !important;
        padding: 0.5rem 1.25rem !important;
        border-radius: 6px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .sign-out-btn:hover {
        background: #ff7a33;
        color: black !important;
        transform: translateY(-1px);
    }
</style>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="../unilink_logo.png" alt="UNILINK logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="navLinks">
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'index.php' ? 'active' : '' ?>" href="index.php">
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'student.php' ? 'active' : '' ?>" href="student.php">
                        <i class="fa fa-users"></i> Students
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'schedule.php' ? 'active' : '' ?>" href="schedule.php">
                        <i class="fa fa-calendar"></i> Schedule
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'input_grades.php' ? 'active' : '' ?>" href="input_grades.php">
                        <i class="fa fa-graduation-cap"></i> Input Grades
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'settings.php' ? 'active' : '' ?>" href="settings.php">
                        <i class="fa fa-cog"></i> Settings
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link sign-out-btn" href="../other.php">
                        <i class="fa fa-sign-out"></i> Sign Out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>