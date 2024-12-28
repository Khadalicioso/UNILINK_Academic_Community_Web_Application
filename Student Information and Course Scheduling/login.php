<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UNILINK</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        :root {
            --primary-color: #1B0E60;
            --accent-color: #FF8C4C;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color), #2d1d8f);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .login h3 {
            color: var(--primary-color);
            font-weight: 600;
            text-align: center;
            margin: 20px 0;
            font-size: 1.5rem;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            width: 100px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .logo-container img:hover {
            transform: scale(1.05);
        }

        .form-label {
            color: var(--primary-color);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(27, 14, 96, 0.15);
        }

        select.form-control {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%231B0E60' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 36px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px;
            font-weight: 500;
            border-radius: 8px;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #150b4d;
            transform: translateY(-1px);
        }

        .alert {
            border-radius: 8px;
            font-weight: 500;
            border: none;
        }

        .copyright {
            color: rgba(255, 255, 255, 0.8);
            margin-top: 30px;
            font-size: 0.9rem;
            text-align: center;
        }

        /* Animation for form elements */
        .login {
            animation: slideUp 0.5s ease forwards;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <form class="login" method="post" action="req/login.php">
            <div class="logo-container">
                <img src="unilink_logo.png" alt="UNILINK logo">
            </div>
            <h3>Welcome Back</h3>

            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_GET['error'] ?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="uname" placeholder="Enter your username">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="pass" placeholder="Enter your password">
            </div>

            <div class="mb-4">
                <label class="form-label">Login As</label>
                <select class="form-control" name="role">
                    <option value="3">Student</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-sign-in-alt me-2"></i>Login
            </button>
        </form>

        <div class="copyright">&copy; 2024 UNILINK. All Rights Reserved.</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>