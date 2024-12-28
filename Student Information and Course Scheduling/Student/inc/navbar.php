<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="../unilink_logo.png" width="40" alt="UNILINK Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="navLinks">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-home me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="student-profile.php">
                        <i class="fas fa-user me-1"></i>Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="schedule.php">
                        <i class="fas fa-calendar-alt me-1"></i>Schedule
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="result.php">
                        <i class="fas fa-chart-bar me-1"></i>Result
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pass.php">
                        <i class="fas fa-key me-1"></i>Change Password
                    </a>
                </li>
            </ul>
            <div class="d-flex">
                <a class="nav-link sign-out" href="../login.php">
                    <i class="fas fa-sign-out-alt me-1"></i>Sign Out
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
.navbar {
    background-color: #1B0E60;
    padding: 1rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.navbar-brand {
    display: flex;
    align-items: center;
    gap: 10px;
}

.navbar-toggler {
    border: none;
    color: white;
    padding: 0.5rem;
}

.navbar-toggler:focus {
    box-shadow: none;
}

.navbar-toggler i {
    color: #FF8C4C;
    font-size: 1.5rem;
}

.nav-link {
    color: rgba(255,255,255,0.8) !important;
    padding: 0.5rem 1rem !important;
    border-radius: 6px;
    transition: all 0.3s ease;
    margin: 0 2px;
}

.nav-link:hover, .nav-link.active {
    color: white !important;
    background-color: rgba(255,255,255,0.1);
}

.nav-link i {
    width: 20px;
    text-align: center;
}

.sign-out {
    color: #FF8C4C !important;
    font-weight: 500;
}

.sign-out:hover {
    background-color: #FF8C4C !important;
    color: white !important;
}

@media (max-width: 991.98px) {
    .navbar-collapse {
        background-color: #1B0E60;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
    }
    
    .nav-link {
        padding: 0.75rem 1rem !important;
    }
    
    .d-flex {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(255,255,255,0.1);
    }
}
</style>