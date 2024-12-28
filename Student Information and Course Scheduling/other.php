<?php
include "req/header.php";
?>
<style>
    body {
        min-height: 100vh;
        background: #f8f9fa;
    }

    .login-container {
        max-width: 400px;
        margin: 2rem auto;
        padding: 2.5rem;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .logo-container {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .logo-container img {
        width: 100px;
        height: auto;
        margin-bottom: 1rem;
    }

    .page-title {
        color: #1B0E60;
        font-size: 1.75rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-label {
        color: #1B0E60;
        font-weight: 500;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-control {
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }

    .form-control:focus {
        border-color: #1B0E60;
        box-shadow: 0 0 0 0.2rem rgba(27, 14, 96, 0.15);
        background-color: white;
    }

    .submit-btn {
        background-color: #FF8C4C;
        border: none;
        color: white;
        padding: 0.8rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        font-weight: 500;
        width: 100%;
        margin-top: 1.5rem;
    }

    .submit-btn:hover {
        background-color: #ff7a33;
    }

    .alert {
        border-radius: 8px;
        border: none;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .copyright {
        text-align: center;
        color: #666;
        font-size: 0.9rem;
        margin-top: 2rem;
    }

    .select-role {
        background-position: right 0.75rem center;
        background-size: 16px 12px;
        background-color: #f8f9fa;
    }

    .select-role:focus {
        background-color: white;
    }
</style>

<body>
    <div class="container">
        <div class="login-container">
            <div class="logo-container">
                <img src="unilink_logo.png" alt="UNILINK Logo">
            </div>
            <h2 class="page-title">Administrator Login</h2>

            <form method="post" action="req/other_login.php">
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?= $_GET['error'] ?>
                    </div>
                <?php } ?>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-user"></i>
                        Username
                    </label>
                    <input type="text" class="form-control" name="uname" placeholder="Enter your username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-lock"></i>
                        Password
                    </label>
                    <input type="password" class="form-control" name="pass" placeholder="Enter your password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-user-shield"></i>
                        Login As
                    </label>
                    <select class="form-control select-role" name="role">
                        <option value="1">Administrator</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>
            </form>
        </div>

        <div class="copyright">
            &copy; 2024 UNILINK. All Rights Reserved.
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>